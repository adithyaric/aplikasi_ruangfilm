<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Film;
use App\Models\Merchandise;
use App\Models\MerchandiseCategory;
use App\Models\SubmissionSetting;
use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        $featuredMerchandises = Merchandise::with('category')
            ->active()
            ->latest()
            ->take(6)
            ->get();

        return view('landing.index', array_merge(
            $this->buildLandingData(),
            ['featuredMerchandises' => $featuredMerchandises]
        ));
    }

    public function program()
    {
        return view('landing.program', $this->buildLandingData());
    }

    public function merchandise(Request $request)
    {
        $query = Merchandise::with('category')->active();

        if ($request->filled('q')) {
            $search = trim($request->q);
            $query->where(function ($inner) use ($search) {
                $inner->where('name', 'like', '%' . $search . '%')
                    ->orWhere('summary', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($inner) use ($request) {
                $inner->where('slug', $request->category);
            });
        }

        if ($request->sort === 'price-asc') {
            $query->orderBy('price');
        } elseif ($request->sort === 'price-desc') {
            $query->orderByDesc('price');
        } else {
            $query->latest();
        }

        $merchandises = $query->paginate(12)->withQueryString();

        return view('landing.merchandise', [
            'merchandises' => $merchandises,
            'merchandiseCategories' => MerchandiseCategory::where('is_active', true)->orderBy('name')->get(),
            'filters' => $request->only(['q', 'category', 'sort']),
        ]);
    }

    protected function buildLandingData()
    {
        $setting = SubmissionSetting::current();
        $completedPeriod = SubmissionSetting::where('close_at', '<', now())
            ->orderByDesc('close_at')
            ->first();

        $competitionCategories = Category::query()
            ->where(function ($query) {
                $query->whereNull('is_active')->orWhere('is_active', true);
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $juryMembers = User::with('category')
            ->where('role', 'juri')
            ->orderBy('name')
            ->get();

        $lastYearFilms = collect();
        $winnerGroups = collect();
        $festivalStats = collect([
            ['label' => 'Film Submitted', 'value' => 0, 'suffix' => ''],
            ['label' => 'Official Selection', 'value' => 0, 'suffix' => ''],
            ['label' => 'Peserta/Kelompok', 'value' => 0, 'suffix' => ''],
            ['label' => 'Kategori Pemenang', 'value' => 0, 'suffix' => ''],
        ]);

        if ($completedPeriod) {
            $lastYearFilms = Film::with(['category', 'user.detail'])
                ->where('submission_setting_id', $completedPeriod->id)
                ->whereNotNull('poster')
                ->orderByRaw("CASE WHEN winner_rank IS NULL THEN 1 ELSE 0 END")
                ->orderBy('winner_rank')
                ->latest()
                ->take(6)
                ->get();

            $winnerFilms = Film::with(['category', 'user.detail'])
                ->where('submission_setting_id', $completedPeriod->id)
                ->whereNotNull('winner_rank')
                ->get()
                ->sortBy(function ($film) {
                    preg_match('/(\d+)/', (string) $film->winner_rank, $matches);

                    return (int) ($matches[1] ?? 999);
                })
                ->groupBy(function ($film) {
                    return optional($film->category)->name ?: 'Kategori Lainnya';
                });

            $winnerGroups = $competitionCategories
                ->map(function ($category) use ($winnerFilms) {
                    return [
                        'category' => $category,
                        'films' => $winnerFilms->get($category->name, collect())->take(3)->values(),
                    ];
                })
                ->filter(function ($group) {
                    return $group['films']->isNotEmpty();
                })
                ->values();

            $festivalStats = collect([
                [
                    'label' => 'Film Submitted',
                    'value' => Film::where('submission_setting_id', $completedPeriod->id)->count(),
                    'suffix' => '',
                ],
                [
                    'label' => 'Official Selection',
                    'value' => Film::where('submission_setting_id', $completedPeriod->id)
                        ->whereIn('curation_status', [Film::CURATION_APPROVED, Film::CURATION_REJECTED])
                        ->count(),
                    'suffix' => '',
                ],
                [
                    'label' => 'Peserta/Kelompok',
                    'value' => Film::where('submission_setting_id', $completedPeriod->id)
                        ->distinct()
                        ->count('user_id'),
                    'suffix' => '',
                ],
                [
                    'label' => 'Kategori Pemenang',
                    'value' => Film::where('submission_setting_id', $completedPeriod->id)
                        ->whereNotNull('winner_rank')
                        ->distinct()
                        ->count('category_id'),
                    'suffix' => '',
                ],
            ]);
        }

        return [
            'activeLandingSetting' => $setting,
            'competitionCategories' => $competitionCategories,
            'juryMembers' => $juryMembers,
            'timelineItems' => $this->buildTimelineItems($setting),
            'boardMembers' => collect(optional($setting)->festival_board ?: [])->filter(function ($member) {
                return filled(data_get($member, 'name')) || filled(data_get($member, 'title'));
            })->values(),
            'completedSubmissionPeriod' => $completedPeriod,
            'lastYearFilms' => $lastYearFilms,
            'winnerGroups' => $winnerGroups,
            'festivalStats' => $festivalStats,
        ];
    }

    protected function buildTimelineItems(SubmissionSetting $setting = null)
    {
        if (!$setting) {
            return collect();
        }

        $reviewStart = $setting->close_at->copy()->addDay();
        $reviewEnd = $setting->close_at->copy()->addDays(7);
        $officialSelection = $setting->close_at->copy()->addDays(8);
        $juryStart = $setting->close_at->copy()->addDays(9);
        $juryEnd = $setting->close_at->copy()->addDays(20);
        $awardingStart = $setting->close_at->copy()->addDays(22);
        $awardingEnd = $setting->close_at->copy()->addDays(25);

        return collect([
            [
                'period' => $setting->open_at->translatedFormat('d M Y') . ' - ' . $setting->close_at->translatedFormat('d M Y'),
                'title' => 'Open Submission',
                'description' => 'Publikasi dan penjaringan karya film untuk periode ' . $setting->display_name . '.',
                'icon' => 'fas fa-inbox',
            ],
            [
                'period' => $reviewStart->translatedFormat('d M Y') . ' - ' . $reviewEnd->translatedFormat('d M Y'),
                'title' => 'Kurasi & Seleksi',
                'description' => 'Kurator memeriksa kelengkapan dan kualitas karya dari tiap kategori.',
                'icon' => 'fas fa-search',
            ],
            [
                'period' => $officialSelection->translatedFormat('d M Y'),
                'title' => 'Official Selection',
                'description' => 'Pengumuman karya yang lolos ke tahap penjurian.',
                'icon' => 'fas fa-trophy',
            ],
            [
                'period' => $juryStart->translatedFormat('d M Y') . ' - ' . $juryEnd->translatedFormat('d M Y'),
                'title' => 'Proses Penjurian',
                'description' => 'Juri memberi nilai dan menentukan peringkat terbaik di periode ini.',
                'icon' => 'fas fa-film',
            ],
            [
                'period' => $awardingStart->translatedFormat('d M Y') . ' - ' . $awardingEnd->translatedFormat('d M Y'),
                'title' => 'Awarding ' . $setting->close_at->format('Y'),
                'description' => 'Pengumuman pemenang dan perayaan karya terbaik festival.',
                'icon' => 'fas fa-crown',
            ],
        ]);
    }
}
