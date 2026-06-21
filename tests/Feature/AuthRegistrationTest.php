<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\SubmissionSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_general_buyer_can_register_when_submission_is_closed()
    {
        $response = $this->post(route('registStore'), [
            'role' => 'umum',
            'name' => 'Pembeli Umum',
            'no_hp' => '081234567890',
            'email' => 'pembeli-umum@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseHas('users', [
            'email' => 'pembeli-umum@gmail.com',
            'role' => 'umum',
            'category_id' => null,
        ]);
    }

    public function test_participant_registration_requires_active_submission_and_category()
    {
        $category = Category::factory()->create();

        $this->post(route('registStore'), [
            'role' => 'peserta',
            'name' => 'Peserta Tutup',
            'no_hp' => '081234567890',
            'email' => 'peserta-tutup@gmail.com',
            'password' => 'password123',
            'category_id' => $category->id,
        ])->assertSessionHasErrors(['role']);

        SubmissionSetting::factory()->create([
            'open_at' => now()->subDay(),
            'close_at' => now()->addDay(),
        ]);

        $this->post(route('registStore'), [
            'role' => 'peserta',
            'name' => 'Peserta Aktif',
            'no_hp' => '081234567891',
            'email' => 'peserta-aktif@gmail.com',
            'password' => 'password123',
        ])->assertSessionHasErrors(['category_id']);
    }

    public function test_general_buyer_is_redirected_to_orders_when_visiting_dashboard()
    {
        User::create([
            'name' => 'Pembeli',
            'email' => 'buyer@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'umum',
            'no_hp' => '081234567890',
            'category_id' => null,
        ]);

        $this->actingAs(User::where('email', 'buyer@gmail.com')->first())
            ->get(route('dashboard'))
            ->assertRedirect(route('orders.index'));
    }
}
