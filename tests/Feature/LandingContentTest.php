<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Film;
use App\Models\Merchandise;
use App\Models\SubmissionSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_uses_manual_featured_films_and_stats_from_submission_setting()
    {
        $category = Category::factory()->create([
            'name' => 'Umum Nasional',
            'slug' => 'umum-nasional',
            'landing_summary' => 'Kompetisi horor untuk sineas umum.',
        ]);

        $activeSetting = SubmissionSetting::factory()->create([
            'name' => 'Periode 2026',
            'hero_title' => "FFH\n2026",
            'about_title' => 'Tentang FFH 2026',
            'open_at' => now()->subDay(),
            'close_at' => now()->addDays(10),
            'festival_board' => [
                ['name' => 'Board Satu', 'title' => 'Ketua Festival', 'image' => 'landing/images/user.png'],
            ],
            'last_year_stat_film_submitted' => 321,
            'last_year_stat_special_films' => 88,
            'last_year_stat_audience' => 9900,
            'last_year_stat_participants' => 77,
        ]);

        $previousSetting = SubmissionSetting::factory()->create([
            'name' => 'Periode 2025',
            'open_at' => now()->subMonths(3),
            'close_at' => now()->subMonths(2),
        ]);

        $participant = User::factory()->role('peserta')->create([
            'category_id' => $category->id,
        ]);

        $featuredFilm = Film::factory()->create([
            'user_id' => $participant->id,
            'submission_setting_id' => $previousSetting->id,
            'category_id' => $category->id,
            'name' => 'Film Pilihan Admin',
            'winner_rank' => null,
            'curation_status' => Film::CURATION_APPROVED,
        ]);

        $activeSetting->update([
            'last_year_featured_film_ids' => [$featuredFilm->id],
        ]);

        Film::factory()->create([
            'user_id' => $participant->id,
            'submission_setting_id' => $previousSetting->id,
            'category_id' => $category->id,
            'name' => 'Film Juara Sebelumnya',
            'winner_rank' => 'Juara 1',
            'curation_status' => Film::CURATION_APPROVED,
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('FFH')
            ->assertSee('Tentang FFH 2026')
            ->assertSee('Board Satu')
            ->assertSee('Film Pilihan Admin')
            ->assertSee('Film Juara Sebelumnya')
            ->assertSee('Umum Nasional')
            ->assertSee('Special Films')
            ->assertSee('Audience')
            ->assertSee('Participants')
            ->assertSee('321')
            ->assertSee('9900');
    }

    public function test_home_page_competition_counter_falls_back_to_derived_last_year_stat()
    {
        $category = Category::factory()->create([
            'name' => 'Umum Nasional',
            'slug' => 'umum-nasional',
        ]);

        SubmissionSetting::factory()->create([
            'name' => 'Periode 2026',
            'open_at' => now()->subDay(),
            'close_at' => now()->addDays(10),
            'last_year_stat_film_submitted' => null,
        ]);

        $previousSetting = SubmissionSetting::factory()->create([
            'name' => 'Periode 2025',
            'open_at' => now()->subMonths(3),
            'close_at' => now()->subMonths(2),
        ]);

        $participant = User::factory()->role('peserta')->create([
            'category_id' => $category->id,
        ]);

        Film::factory()->count(2)->create([
            'user_id' => $participant->id,
            'submission_setting_id' => $previousSetting->id,
            'category_id' => $category->id,
        ]);

        $response = $this->get('/')
            ->assertOk();

        preg_match('/<section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 competition-section">.*?<\/section>/s', $response->getContent(), $matches);

        $this->assertNotEmpty($matches);
        $this->assertStringContainsString('data-target="2"', $matches[0]);
    }

    public function test_home_page_shows_program_highlight_and_partner_sections_when_submission_is_closed()
    {
        SubmissionSetting::factory()->create([
            'name' => 'Periode 2025',
            'theme_name' => 'INDIGO',
            'open_at' => now()->subMonths(2),
            'close_at' => now()->subMonth(),
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Program Highlight')
            ->assertSee('OFFICIAL COLLABORATOR')
            ->assertSee('OFFICIAL PARTNERS')
            ->assertDontSee('SPECIAL FEATURE PROGRAM')
            ->assertDontSee('Timeline Kompetisi Film')
            ->assertDontSee('Kategori Kompetisi Film');
    }

    public function test_program_page_shows_hardcoded_categories_jury_members_and_faq()
    {
        $category = Category::factory()->create([
            'name' => 'Pelajar Se - Jawa Timur',
            'slug' => 'pelajar-jawa-timur',
            'landing_summary' => 'Kompetisi film pelajar.',
        ]);

        SubmissionSetting::factory()->create([
            'open_at' => now()->subDay(),
            'close_at' => now()->addWeek(),
        ]);

        User::factory()->role('juri')->create([
            'name' => 'Juri Pelajar',
            'category_id' => $category->id,
        ]);

        $this->get('/program')
            ->assertOk()
            ->assertSee('Pelajar Se - Jawa Timur')
            ->assertSee('Kompetisi film horor bagi pelajar SMA/SMK wilayah provinsi Jawa Timur.')
            ->assertSee('Juri Pelajar')
            ->assertSee('Kapan pengumuman Official Selection dilakukan?');
    }

    public function test_authenticated_user_sees_total_cart_quantity_in_landing_badge()
    {
        $user = User::factory()->role('peserta')->create();
        $cart = Cart::factory()->create([
            'user_id' => $user->id,
        ]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'merchandise_id' => Merchandise::factory()->create()->id,
            'quantity' => 2,
        ]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'merchandise_id' => Merchandise::factory()->create()->id,
            'quantity' => 3,
        ]);

        $response = $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('id="cart-count"', false)
            ->assertSee('id="cart-count-mobile"', false);

        $content = $response->getContent();

        $this->assertMatchesRegularExpression('/<span id="cart-count"[\s\S]*?>\s*5\s*<\/span>/', $content);
        $this->assertMatchesRegularExpression('/<span id="cart-count-mobile"[\s\S]*?>\s*5\s*<\/span>/', $content);
    }
}
