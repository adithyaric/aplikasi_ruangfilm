<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_peserta_and_return_to_author_index()
    {
        $admin = User::factory()->role('admin')->create();

        $this->actingAs($admin)
            ->post(route('users.store'), [
                'name' => 'Peserta Baru',
                'email' => 'peserta@example.com',
                'no_hp' => '081234567890',
                'password' => 'secret123',
                'role' => 'peserta',
            ])
            ->assertRedirect(route('users.index.author'));

        $user = User::where('email', 'peserta@example.com')->firstOrFail();

        $this->assertSame('peserta', $user->role);
        $this->assertSame('081234567890', $user->no_hp);
        $this->assertTrue(Hash::check('secret123', $user->password));
    }
}
