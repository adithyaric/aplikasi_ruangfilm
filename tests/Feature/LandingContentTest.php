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

    public function test_home_page_uses_submission_setting_and_previous_winner_data()
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
        ]);

        $previousSetting = SubmissionSetting::factory()->create([
            'name' => 'Periode 2025',
            'open_at' => now()->subMonths(3),
            'close_at' => now()->subMonths(2),
        ]);

        $participant = User::factory()->role('peserta')->create([
            'category_id' => $category->id,
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
            ->assertSee('Film Juara Sebelumnya')
            ->assertSee('Umum Nasional');
    }

    public function test_program_page_shows_dynamic_categories_and_jury_members()
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
            ->assertSee('Kompetisi film pelajar.')
            ->assertSee('Juri Pelajar');
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
