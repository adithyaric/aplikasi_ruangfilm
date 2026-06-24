<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\JuryScore;
use App\Models\SubmissionSetting;
use Illuminate\Http\Request;

class SubmissionReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Film::with(['user.category', 'category', 'submissionSetting', 'juryScores']);

        if ($request->filled('submission_setting_id')) {
            $query->where('submission_setting_id', $request->submission_setting_id);
        }

        if ($request->filled('curation_status')) {
            $query->where('curation_status', $request->curation_status);
        }

        if (auth()->user()->hasRole('juri')) {
            $query->where('curation_status', Film::CURATION_APPROVED);
        }

        return view('review.index', [
            'title' => 'Review Submission',
            'films' => $query->latest()->get(),
            'submissionPeriods' => SubmissionSetting::orderByDesc('open_at')->get(),
        ]);
    }

    public function updateCuration(Request $request, Film $film)
    {
        abort_unless(auth()->user()->hasRole(['admin', 'adminsub', 'kurator']), 403);

        $validated = $request->validate([
            'curation_status' => 'required|in:pending,approved,rejected',
            'curator_note' => 'nullable|string',
        ]);

        $film->update([
            'curation_status' => $validated['curation_status'],
            'curator_note' => $validated['curator_note'] ?? null,
            'winner_rank' => $validated['curation_status'] === Film::CURATION_APPROVED ? $film->winner_rank : null,
        ]);

        return back()->with('success', 'Status kurasi berhasil diperbarui.');
    }

    public function updateJuryScore(Request $request, Film $film)
    {
        abort_unless(auth()->user()->hasRole(['admin', 'adminsub', 'juri']), 403);

        if ($film->curation_status !== Film::CURATION_APPROVED) {
            return back()->with('warning', 'Hanya submission yang lolos kurasi yang dapat dinilai juri.');
        }

        $validated = $request->validate([
            'score' => 'nullable|numeric|min:0|max:100',
            'note' => 'nullable|string',
            'winner_rank' => 'nullable|string|max:255',
        ]);

        JuryScore::updateOrCreate(
            [
                'film_id' => $film->id,
                'jury_id' => auth()->id(),
            ],
            [
                'score' => $validated['score'] ?? null,
                'note' => $validated['note'] ?? null,
            ]
        );

        $winnerRank = $validated['winner_rank'] ?? null;

        if ($winnerRank) {
            $exists = Film::where('submission_setting_id', $film->submission_setting_id)
                ->where('id', '!=', $film->id)
                ->where('winner_rank', $winnerRank)
                ->exists();

            if ($exists) {
                return back()->withErrors([
                    'winner_rank' => 'Peringkat tersebut sudah dipakai di periode submission yang sama.',
                ]);
            }
        }

        $film->update([
            'winner_rank' => $winnerRank,
        ]);

        return back()->with('success', 'Penilaian juri berhasil disimpan.');
    }
}
