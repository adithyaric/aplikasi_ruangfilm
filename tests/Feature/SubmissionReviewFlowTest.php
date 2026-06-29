<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Film;
use App\Models\ReviewRubric;
use App\Models\SubmissionReview;
use App\Models\SubmissionSetting;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SubmissionReviewFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_participant_submission_uses_active_period_and_category()
    {
        Storage::fake('public');

        $category = Category::factory()->create();
        $period = SubmissionSetting::factory()->create([
            'open_at' => now()->subDay(),
            'close_at' => now()->addDay(),
        ]);
        $participant = User::factory()->create([
            'role' => 'peserta',
            'category_id' => $category->id,
        ]);
        UserDetail::factory()->create(['user_id' => $participant->id]);

        $this->actingAs($participant)
            ->post(route('film.store'), [
                'name' => 'Film Uji',
                'duration' => 600,
                'tahun_produksi' => '2026',
                'subtitle' => 'Ya',
                'sinopsis' => 'Sinopsis film',
                'sutradara' => 'Sutradara',
                'produser' => 'Produser',
                'penulis' => 'Penulis',
                'kru' => UploadedFile::fake()->create('kru.pdf', 100),
                'poster' => UploadedFile::fake()->image('poster.jpg'),
                'gsm' => [
                    UploadedFile::fake()->image('gsm-1.jpg'),
                ],
                'trailer' => 'https://example.com/trailer',
                'film' => 'https://example.com/film',
            ])
            ->assertRedirect(route('film.index'));

        $film = Film::first();

        $this->assertSame($period->id, $film->submission_setting_id);
        $this->assertSame($category->id, $film->category_id);
        $this->assertSame(Film::CURATION_PENDING, $film->curation_status);
    }

    public function test_admin_can_create_and_update_grouped_rubrics_manually()
    {
        $admin = User::factory()->role('admin')->create();

        $this->actingAs($admin)
            ->post(route('categories.store'), [
                'name' => 'Kategori Rubrik',
                'slug' => 'kategori-rubrik',
                'description' => 'Deskripsi',
                'landing_summary' => 'Ringkasan',
                'detail_route' => '/rubrik',
                'sort_order' => 1,
                'is_active' => 1,
                'rubrics' => [
                    ReviewRubric::STAGE_CURATION => [
                        'present' => 1,
                        'groups' => [
                            [
                                'title' => 'NARASI & SKENARIO',
                                'weight' => 50,
                                'sort_order' => 0,
                                'items' => [
                                    [
                                        'title' => 'Orisinalitas dan Tema',
                                        'description' => 'Keunikan ide.',
                                        'weight' => 15,
                                        'sort_order' => 0,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    ReviewRubric::STAGE_JURY => [
                        'present' => 1,
                        'groups' => [
                            [
                                'title' => 'Rasa Film',
                                'weight' => null,
                                'sort_order' => 0,
                                'items' => [
                                    [
                                        'title' => 'After Taste',
                                        'description' => 'Jejak emosional.',
                                        'weight' => '',
                                        'sort_order' => 0,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ])
            ->assertRedirect(route('categories.index'));

        $category = Category::where('slug', 'kategori-rubrik')->firstOrFail();

        $this->assertDatabaseHas('review_rubrics', [
            'category_id' => $category->id,
            'stage' => ReviewRubric::STAGE_CURATION,
        ]);
        $this->assertDatabaseHas('review_rubric_items', [
            'title' => 'Orisinalitas dan Tema',
            'weight' => 15,
        ]);
        $this->assertDatabaseHas('review_rubric_items', [
            'title' => 'After Taste',
            'weight' => 1,
        ]);

        $this->actingAs($admin)
            ->put(route('categories.update', $category), [
                'name' => 'Kategori Rubrik Updated',
                'slug' => 'kategori-rubrik',
                'description' => 'Deskripsi',
                'landing_summary' => 'Ringkasan',
                'detail_route' => '/rubrik',
                'sort_order' => 1,
                'is_active' => 1,
                'rubrics' => [
                    ReviewRubric::STAGE_CURATION => [
                        'present' => 1,
                        'groups' => [
                            [
                                'title' => 'TEKNIK',
                                'weight' => 30,
                                'sort_order' => 0,
                                'items' => [
                                    [
                                        'title' => 'Sinematografi',
                                        'description' => 'Framing dan kontinuitas visual.',
                                        'weight' => 5,
                                        'sort_order' => 0,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ])
            ->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('review_rubric_items', [
            'title' => 'Sinematografi',
            'weight' => 5,
        ]);
        $this->assertDatabaseMissing('review_rubric_items', [
            'title' => 'Orisinalitas dan Tema',
        ]);
    }

    public function test_raw_rubric_scoring_stores_item_snapshots_and_total()
    {
        $category = Category::factory()->create();
        $period = SubmissionSetting::factory()->create();
        $film = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_UNDER_REVIEW,
        ]);
        $rubric = $this->createRubric($category, ReviewRubric::STAGE_CURATION, [
            ['title' => 'Orisinalitas', 'weight' => 15],
            ['title' => 'Struktur Cerita', 'weight' => 10],
        ]);
        $items = $rubric->groups()->first()->items;
        $curator = User::factory()->role('kurator')->create();

        $this->actingAs($curator)
            ->patch(route('review.score.update', [$film, ReviewRubric::STAGE_CURATION]), [
                'scores' => [
                    $items[0]->id => 10,
                    $items[1]->id => 8,
                ],
                'note' => 'Layak lanjut',
            ])
            ->assertRedirect(route('review.index', [
                'submission_setting_id' => $film->submission_setting_id,
                'category_id' => $film->category_id,
                'stage' => ReviewRubric::STAGE_CURATION,
            ]));

        $review = SubmissionReview::with('scores')->firstOrFail();

        $this->assertSame(230.0, (float) $review->total_score);
        $this->assertSame('Layak lanjut', $review->note);
        $this->assertCount(2, $review->scores);
        $this->assertSame(150.0, (float) $review->scores->firstWhere('review_rubric_item_id', $items[0]->id)->weighted_score);
        $this->assertSame(10.0, (float) $review->scores->firstWhere('review_rubric_item_id', $items[1]->id)->item_weight);
    }

    public function test_multiple_curators_produce_average_curation_ranking()
    {
        $category = Category::factory()->create();
        $period = SubmissionSetting::factory()->create();
        $filmA = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_UNDER_REVIEW,
        ]);
        $filmB = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_UNDER_REVIEW,
        ]);
        $rubric = $this->createRubric($category, ReviewRubric::STAGE_CURATION, [
            ['title' => 'Total Kesan', 'weight' => 10],
        ]);
        $item = $rubric->groups()->first()->items()->first();
        $curatorA = User::factory()->role('kurator')->create();
        $curatorB = User::factory()->role('kurator')->create();

        $this->actingAs($curatorA)->patch(route('review.score.update', [$filmA, ReviewRubric::STAGE_CURATION]), [
            'scores' => [$item->id => 10],
        ]);
        $this->actingAs($curatorB)->patch(route('review.score.update', [$filmA, ReviewRubric::STAGE_CURATION]), [
            'scores' => [$item->id => 8],
        ]);
        $this->actingAs($curatorA)->patch(route('review.score.update', [$filmB, ReviewRubric::STAGE_CURATION]), [
            'scores' => [$item->id => 5],
        ]);

        $response = $this->actingAs(User::factory()->role('admin')->create())
            ->get(route('review.index', [
                'submission_setting_id' => $period->id,
                'category_id' => $category->id,
                'curation_status' => Film::CURATION_UNDER_REVIEW,
                'stage' => ReviewRubric::STAGE_CURATION,
            ]));

        $response->assertOk();

        $films = $response->viewData('films');

        $this->assertSame([$filmA->id, $filmB->id], $films->pluck('id')->all());
        $this->assertSame(90.0, (float) $films->first()->curation_average_score);
        $this->assertSame(2, $films->first()->curation_review_count);
    }

    public function test_only_under_review_films_can_be_scored_by_curators()
    {
        $category = Category::factory()->create();
        $film = Film::factory()->create([
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_PENDING,
        ]);
        $rubric = $this->createRubric($category, ReviewRubric::STAGE_CURATION, [
            ['title' => 'Narasi', 'weight' => 10],
        ]);
        $item = $rubric->groups()->first()->items()->first();
        $curator = User::factory()->role('kurator')->create();

        $this->actingAs($curator)
            ->patch(route('review.score.update', [$film, ReviewRubric::STAGE_CURATION]), [
                'scores' => [$item->id => 10],
            ])
            ->assertSessionHas('warning');

        $this->assertDatabaseCount('submission_reviews', 0);
    }

    public function test_official_selection_bulk_action_approves_checked_films_and_rejects_unchecked_films()
    {
        $admin = User::factory()->role('admin')->create();
        $category = Category::factory()->create();
        $period = SubmissionSetting::factory()->create();
        $selectedFilm = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_UNDER_REVIEW,
        ]);
        $rejectedFilm = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_UNDER_REVIEW,
        ]);

        $this->actingAs($admin)
            ->post(route('review.official-selection'), [
                'submission_setting_id' => $period->id,
                'category_id' => $category->id,
                'film_ids' => [$selectedFilm->id],
            ])
            ->assertRedirect();

        $this->assertSame(Film::CURATION_APPROVED, $selectedFilm->fresh()->curation_status);
        $this->assertSame(Film::CURATION_REJECTED, $rejectedFilm->fresh()->curation_status);
    }

    public function test_only_official_selection_films_can_be_scored_by_jury()
    {
        $category = Category::factory()->create();
        $film = Film::factory()->create([
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_UNDER_REVIEW,
        ]);
        $rubric = $this->createRubric($category, ReviewRubric::STAGE_JURY, [
            ['title' => 'After Taste', 'weight' => 1],
        ]);
        $item = $rubric->groups()->first()->items()->first();
        $jury = User::factory()->role('juri')->create();

        $this->actingAs($jury)
            ->patch(route('review.score.update', [$film, ReviewRubric::STAGE_JURY]), [
                'scores' => [$item->id => 9],
            ])
            ->assertSessionHas('warning');

        $this->assertDatabaseCount('submission_reviews', 0);

        $film->update(['curation_status' => Film::CURATION_APPROVED]);

        $this->actingAs($jury)
            ->patch(route('review.score.update', [$film, ReviewRubric::STAGE_JURY]), [
                'scores' => [$item->id => 9],
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('submission_reviews', [
            'film_id' => $film->id,
            'reviewer_id' => $jury->id,
            'stage' => ReviewRubric::STAGE_JURY,
        ]);
    }

    public function test_winner_rank_is_unique_per_submission_period_and_category()
    {
        $admin = User::factory()->role('admin')->create();
        $period = SubmissionSetting::factory()->create();
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create();
        $filmA = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $categoryA->id,
            'curation_status' => Film::CURATION_APPROVED,
        ]);
        $filmB = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $categoryA->id,
            'curation_status' => Film::CURATION_APPROVED,
        ]);
        $filmC = Film::factory()->create([
            'submission_setting_id' => $period->id,
            'category_id' => $categoryB->id,
            'curation_status' => Film::CURATION_APPROVED,
        ]);

        $this->actingAs($admin)
            ->patch(route('review.winner-rank', $filmA), ['winner_rank' => 'Juara 1'])
            ->assertRedirect();
        $this->actingAs($admin)
            ->patch(route('review.winner-rank', $filmC), ['winner_rank' => 'Juara 1'])
            ->assertRedirect();

        $response = $this->actingAs($admin)
            ->from(route('review.index'))
            ->patch(route('review.winner-rank', $filmB), ['winner_rank' => 'Juara 1']);

        $response->assertSessionHasErrors('winner_rank');
        $this->assertSame('Juara 1', $filmA->fresh()->winner_rank);
        $this->assertSame('Juara 1', $filmC->fresh()->winner_rank);
        $this->assertNull($filmB->fresh()->winner_rank);
    }

    private function createRubric(Category $category, $stage, array $items)
    {
        $rubric = ReviewRubric::create([
            'category_id' => $category->id,
            'stage' => $stage,
            'name' => $category->name . ' - ' . $stage,
            'is_active' => true,
        ]);

        $group = $rubric->groups()->create([
            'title' => 'Aspek Utama',
            'weight' => null,
            'sort_order' => 0,
        ]);

        foreach ($items as $index => $item) {
            $group->items()->create([
                'title' => $item['title'],
                'description' => $item['description'] ?? null,
                'weight' => $item['weight'] ?? 1,
                'sort_order' => $index,
            ]);
        }

        return $rubric->fresh('groups.items');
    }
}
