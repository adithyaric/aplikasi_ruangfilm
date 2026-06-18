<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Film;
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

    public function test_curator_can_approve_and_jury_cannot_duplicate_winner_rank_in_same_period()
    {
        $category = Category::factory()->create();
        $period = SubmissionSetting::factory()->create();
        $participant = User::factory()->create([
            'role' => 'peserta',
            'category_id' => $category->id,
        ]);

        $filmA = Film::factory()->create([
            'user_id' => $participant->id,
            'submission_setting_id' => $period->id,
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_PENDING,
        ]);
        $filmB = Film::factory()->create([
            'user_id' => $participant->id,
            'submission_setting_id' => $period->id,
            'category_id' => $category->id,
            'curation_status' => Film::CURATION_APPROVED,
        ]);

        $curator = User::factory()->role('kurator')->create();
        $jury = User::factory()->role('juri')->create();

        $this->actingAs($curator)
            ->patch(route('review.curation', $filmA), [
                'curation_status' => 'approved',
                'curator_note' => 'Layak lanjut',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('films', [
            'id' => $filmA->id,
            'curation_status' => Film::CURATION_APPROVED,
        ]);

        $this->actingAs($jury)
            ->patch(route('review.jury-score', $filmA), [
                'score' => 95,
                'winner_rank' => 'Juara 1',
                'note' => 'Sangat baik',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('jury_scores', [
            'film_id' => $filmA->id,
            'jury_id' => $jury->id,
        ]);
        $this->assertSame('Juara 1', $filmA->fresh()->winner_rank);

        $response = $this->actingAs($jury)
            ->from(route('review.index'))
            ->patch(route('review.jury-score', $filmB), [
                'score' => 90,
                'winner_rank' => 'Juara 1',
                'note' => 'Bagus',
            ]);

        $response->assertSessionHasErrors('winner_rank');
        $this->assertNull($filmB->fresh()->winner_rank);
    }
}
