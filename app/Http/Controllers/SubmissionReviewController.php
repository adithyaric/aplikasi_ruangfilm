<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Film;
use App\Models\ReviewRubric;
use App\Models\SubmissionReview;
use App\Models\SubmissionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SubmissionReviewController extends Controller
{
    public function index(Request $request)
    {
        $stage = $this->resolveStage($request->input('stage'));
        $query = Film::with([
            'user.category',
            'category.rubrics',
            'submissionSetting',
            'juryScores',
            'submissionReviews.reviewer',
            'submissionReviews.scores',
        ]);

        if ($request->filled('submission_setting_id')) {
            $query->where('submission_setting_id', $request->submission_setting_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('curation_status')) {
            $query->where('curation_status', $request->curation_status);
        }

        if (auth()->user()->hasRole('kurator') && !$request->filled('curation_status')) {
            $query->where('curation_status', Film::CURATION_UNDER_REVIEW);
        }

        if (auth()->user()->hasRole('juri')) {
            $query->where('curation_status', Film::CURATION_APPROVED);
        }

        $films = $this->sortFilmsByStage(
            $this->attachReviewMetrics($query->latest()->get()),
            $stage
        );

        return view('review.index', [
            'title' => 'Review Submission',
            'films' => $films,
            'selectionFilms' => $this->officialSelectionFilms($request),
            'submissionPeriods' => SubmissionSetting::orderByDesc('open_at')->get(),
            'categories' => Category::orderBy('sort_order')->orderBy('name')->get(),
            'stage' => $stage,
            'stageLabels' => ReviewRubric::stageLabels(),
        ]);
    }

    public function startCuration(Request $request)
    {
        abort_unless(auth()->user()->hasRole(['admin', 'adminsub']), 403);

        $validated = $request->validate([
            'submission_setting_id' => 'required|exists:submission_settings,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $period = SubmissionSetting::findOrFail($validated['submission_setting_id']);

        if ($period->close_at && $period->close_at->isFuture()) {
            return back()->with('warning', 'Kurasi hanya bisa dimulai setelah periode submission ditutup.');
        }

        $query = Film::where('submission_setting_id', $period->id)
            ->where('curation_status', Film::CURATION_PENDING);

        if (!empty($validated['category_id'])) {
            $query->where('category_id', $validated['category_id']);
        }

        $count = $query->update(['curation_status' => Film::CURATION_UNDER_REVIEW]);

        return back()->with('success', $count . ' film dipindahkan ke status Dalam Kurasi.');
    }

    public function setOfficialSelection(Request $request)
    {
        abort_unless(auth()->user()->hasRole(['admin', 'adminsub']), 403);

        $validated = $request->validate([
            'submission_setting_id' => 'required|exists:submission_settings,id',
            'category_id' => 'required|exists:categories,id',
            'film_ids' => 'nullable|array',
            'film_ids.*' => 'integer|exists:films,id',
        ]);

        $eligibleIds = Film::where('submission_setting_id', $validated['submission_setting_id'])
            ->where('category_id', $validated['category_id'])
            ->whereIn('curation_status', [Film::CURATION_UNDER_REVIEW, Film::CURATION_APPROVED])
            ->pluck('id');

        $selectedIds = collect($validated['film_ids'] ?? [])
            ->map(function ($id) {
                return (int) $id;
            })
            ->intersect($eligibleIds)
            ->values();

        Film::whereIn('id', $selectedIds)->update([
            'curation_status' => Film::CURATION_APPROVED,
        ]);

        Film::whereIn('id', $eligibleIds->diff($selectedIds))->update([
            'curation_status' => Film::CURATION_REJECTED,
            'winner_rank' => null,
        ]);

        return back()->with('success', 'Official Selection berhasil diperbarui.');
    }

    public function score(Film $film, $stage)
    {
        $stage = $this->resolveStage($stage);
        $this->authorizeScoringRole($stage);

        if ($message = $this->scoreBlockReason($film, $stage)) {
            return redirect()->route('review.index')->with('warning', $message);
        }

        $rubric = $this->resolveRubric($film, $stage);

        if (!$rubric) {
            return redirect()->route('review.index')->with('warning', 'Rubrik penilaian kategori ini belum tersedia.');
        }

        $review = SubmissionReview::with('scores')
            ->where('film_id', $film->id)
            ->where('reviewer_id', auth()->id())
            ->where('stage', $stage)
            ->first();

        return view('review.score', [
            'title' => 'Form Penilaian',
            'film' => $film->loadMissing(['category', 'submissionSetting']),
            'stage' => $stage,
            'stageLabel' => ReviewRubric::stageLabels()[$stage] ?? ucfirst($stage),
            'rubric' => $rubric,
            'review' => $review,
        ]);
    }

    public function storeScore(Request $request, Film $film, $stage)
    {
        $stage = $this->resolveStage($stage);
        $this->authorizeScoringRole($stage);

        if ($message = $this->scoreBlockReason($film, $stage)) {
            return back()->with('warning', $message);
        }

        $rubric = $this->resolveRubric($film, $stage);

        if (!$rubric) {
            return back()->with('warning', 'Rubrik penilaian kategori ini belum tersedia.');
        }

        $items = $rubric->groups->flatMap(function ($group) {
            return $group->items;
        })->values();

        $allowedScoreKeys = $items->pluck('id')->map(function ($id) {
            return (string) $id;
        })->all();

        $scoreInput = $request->input('scores', []);
        $submittedScoreKeys = array_map('strval', array_keys(is_array($scoreInput) ? $scoreInput : []));
        $unknownScoreKeys = array_diff($submittedScoreKeys, $allowedScoreKeys);

        if ($unknownScoreKeys) {
            throw ValidationException::withMessages([
                'scores' => 'Item rubrik tidak valid.',
            ]);
        }

        $rules = [
            'note' => 'nullable|string',
            'scores' => 'required|array',
        ];

        foreach ($allowedScoreKeys as $itemId) {
            $rules['scores.' . $itemId] = 'required|numeric|min:1|max:10';
        }

        $validated = $request->validate($rules);
        $totalScore = 0;

        DB::transaction(function () use ($film, $stage, $rubric, $items, $validated, &$totalScore) {
            $review = SubmissionReview::updateOrCreate(
                [
                    'film_id' => $film->id,
                    'reviewer_id' => auth()->id(),
                    'stage' => $stage,
                ],
                [
                    'review_rubric_id' => $rubric->id,
                    'note' => $validated['note'] ?? null,
                    'submitted_at' => now(),
                ]
            );

            $review->scores()->delete();

            foreach ($items as $item) {
                $score = (float) $validated['scores'][$item->id];
                $weight = (float) $item->weight;
                $weightedScore = round($score * $weight, 2);
                $totalScore += $weightedScore;

                $review->scores()->create([
                    'review_rubric_item_id' => $item->id,
                    'item_title' => $item->title,
                    'item_weight' => $weight,
                    'score' => $score,
                    'weighted_score' => $weightedScore,
                ]);
            }

            $review->update(['total_score' => $totalScore]);
        });

        return redirect()
            ->route('review.index', [
                'submission_setting_id' => $film->submission_setting_id,
                'category_id' => $film->category_id,
                'stage' => $stage,
            ])
            ->with('success', 'Penilaian berhasil disimpan. Total nilai: ' . number_format($totalScore, 2));
    }

    public function updateWinnerRank(Request $request, Film $film)
    {
        abort_unless(auth()->user()->hasRole(['admin', 'adminsub']), 403);

        if ($film->curation_status !== Film::CURATION_APPROVED) {
            return back()->with('warning', 'Peringkat hanya bisa ditetapkan untuk film Official Selection.');
        }

        $validated = $request->validate([
            'winner_rank' => 'nullable|string|max:255',
        ]);

        $winnerRank = $validated['winner_rank'] ?? null;

        if ($winnerRank) {
            $exists = Film::where('submission_setting_id', $film->submission_setting_id)
                ->where('category_id', $film->category_id)
                ->where('id', '!=', $film->id)
                ->where('winner_rank', $winnerRank)
                ->exists();

            if ($exists) {
                return back()->withErrors([
                    'winner_rank' => 'Peringkat tersebut sudah dipakai di periode dan kategori yang sama.',
                ]);
            }
        }

        $film->update(['winner_rank' => $winnerRank]);

        return back()->with('success', 'Peringkat pemenang berhasil diperbarui.');
    }

    protected function resolveStage($stage)
    {
        if (!$stage) {
            return auth()->user()->hasRole('juri')
                ? ReviewRubric::STAGE_JURY
                : ReviewRubric::STAGE_CURATION;
        }

        abort_unless(in_array($stage, ReviewRubric::stages(), true), 404);

        return $stage;
    }

    protected function authorizeScoringRole($stage)
    {
        if ($stage === ReviewRubric::STAGE_CURATION) {
            abort_unless(auth()->user()->hasRole(['admin', 'adminsub', 'kurator']), 403);
            return;
        }

        abort_unless(auth()->user()->hasRole(['admin', 'adminsub', 'juri']), 403);
    }

    protected function scoreBlockReason(Film $film, $stage)
    {
        if ($stage === ReviewRubric::STAGE_CURATION && $film->curation_status !== Film::CURATION_UNDER_REVIEW) {
            return 'Hanya film berstatus Dalam Kurasi yang dapat dinilai kurator.';
        }

        if ($stage === ReviewRubric::STAGE_JURY && $film->curation_status !== Film::CURATION_APPROVED) {
            return 'Hanya film Official Selection yang dapat dinilai juri.';
        }

        return null;
    }

    protected function resolveRubric(Film $film, $stage)
    {
        $film->loadMissing('category');

        if (!$film->category) {
            return null;
        }

        return $film->category->activeRubric($stage);
    }

    protected function attachReviewMetrics($films)
    {
        return $films->map(function ($film) {
            $curationReviews = $film->submissionReviews->where('stage', ReviewRubric::STAGE_CURATION);
            $juryReviews = $film->submissionReviews->where('stage', ReviewRubric::STAGE_JURY);

            $film->curation_average_score = round((float) $curationReviews->avg('total_score'), 2);
            $film->curation_review_count = $curationReviews->count();
            $film->jury_average_score = $juryReviews->count()
                ? round((float) $juryReviews->avg('total_score'), 2)
                : round((float) $film->juryScores->avg('score'), 2);
            $film->jury_review_count = $juryReviews->count() ?: $film->juryScores->count();

            return $film;
        });
    }

    protected function sortFilmsByStage($films, $stage)
    {
        $scoreKey = $stage === ReviewRubric::STAGE_JURY
            ? 'jury_average_score'
            : 'curation_average_score';

        return $films->sortByDesc(function ($film) use ($scoreKey) {
            return $film->{$scoreKey};
        })->values();
    }

    protected function officialSelectionFilms(Request $request)
    {
        if (!auth()->user()->hasRole(['admin', 'adminsub'])
            || !$request->filled('submission_setting_id')
            || !$request->filled('category_id')) {
            return collect();
        }

        $films = Film::with([
            'user.category',
            'category',
            'submissionReviews.reviewer',
            'submissionReviews.scores',
            'juryScores',
        ])
            ->where('submission_setting_id', $request->submission_setting_id)
            ->where('category_id', $request->category_id)
            ->whereIn('curation_status', [Film::CURATION_UNDER_REVIEW, Film::CURATION_APPROVED])
            ->get();

        return $this->sortFilmsByStage(
            $this->attachReviewMetrics($films),
            ReviewRubric::STAGE_CURATION
        );
    }
}
