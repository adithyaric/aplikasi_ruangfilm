<?php

namespace Tests\Feature;

use App\Models\SubmissionSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmissionSettingManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_period_inherits_current_landing_content()
    {
        $admin = User::factory()->role('admin')->create();
        $currentSetting = SubmissionSetting::factory()->create([
            'name' => 'Periode Sekarang',
            'hero_title' => 'Hero Saat Ini',
            'about_title' => 'Tentang Saat Ini',
            'theme_name' => 'INDIGO',
            'festival_board' => [
                ['name' => 'Board Satu', 'title' => 'Ketua Festival', 'image' => 'landing/images/user.png'],
            ],
            'open_at' => now()->subDay(),
            'close_at' => now()->addDays(5),
        ]);

        $this->actingAs($admin)
            ->post(route('settingStore'), [
                'name' => 'Periode Baru',
                'open_at' => now()->addDays(10)->format('Y-m-d H:i:s'),
                'close_at' => now()->addDays(20)->format('Y-m-d H:i:s'),
            ])
            ->assertRedirect(route('settingIndex'));

        $newSetting = SubmissionSetting::where('name', 'Periode Baru')->firstOrFail();

        $this->assertSame($currentSetting->hero_title, $newSetting->hero_title);
        $this->assertSame($currentSetting->about_title, $newSetting->about_title);
        $this->assertSame($currentSetting->theme_name, $newSetting->theme_name);
        $this->assertSame($currentSetting->festival_board, $newSetting->festival_board);
    }

    public function test_admin_can_update_landing_content_separately_from_period_dates()
    {
        $admin = User::factory()->role('admin')->create();
        $setting = SubmissionSetting::factory()->create([
            'name' => 'Periode 2026',
            'open_at' => now()->subDay(),
            'close_at' => now()->addDays(7),
        ]);
        $originalOpenAt = $setting->open_at->toDateTimeString();
        $originalCloseAt = $setting->close_at->toDateTimeString();

        $this->actingAs($admin)
            ->put(route('settingLandingUpdate', $setting), [
                'hero_title' => 'Hero Baru',
                'hero_description' => 'Deskripsi hero baru',
                'about_title' => 'Tentang Baru',
                'theme_title' => 'Tema Baru',
                'theme_name' => 'NOCTURNE',
                'festival_board' => [
                    ['name' => 'Anggota Satu', 'title' => 'Direktur'],
                    ['name' => 'Anggota Dua', 'title' => 'Programmer'],
                ],
                'last_year_title' => 'Highlight Baru',
                'last_year_catalog_label' => 'Lihat Katalog',
                'last_year_catalog_url' => '/download/ekatalog',
            ])
            ->assertRedirect(route('settingIndex'));

        $setting->refresh();

        $this->assertSame('Periode 2026', $setting->name);
        $this->assertSame($originalOpenAt, $setting->open_at->toDateTimeString());
        $this->assertSame($originalCloseAt, $setting->close_at->toDateTimeString());
        $this->assertSame('Hero Baru', $setting->hero_title);
        $this->assertSame('NOCTURNE', $setting->theme_name);
        $this->assertCount(2, $setting->festival_board);
        $this->assertSame('Anggota Dua', data_get($setting->festival_board, '1.name'));
    }
}
