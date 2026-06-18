<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Start User Seeder
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => 'Superadmin FFH',
            'email' => 'adminffh@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => 'Admin Submission FFH',
            'email' => 'adminsub@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'adminsub',
        ]);

        // $users = [
        //     [
        //         'name' => 'steven',
        //         'email' => 'steven@gmail.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'peserta',
        //         'no_hp' => '0895399259868',
        //     ],
        // ];

        // DB::table('users')->insert($users);
        // End User Seeder

        // Start Category Seeder
        $categories = [
            [
                'name' => 'Umum Nasional',
            ],
            [
                'name' => 'Pelajar Se - Jawa Timur',
            ],
            [
                'name' => 'Organisasi (PKK - PAUD & TK,  dan Karang Taruna) & Komunitas Lokal Pacitan)',
            ],
            [
                'name' => 'Pelajar SD - SMP Se- Pacitan',
            ],
        ];

        DB::table('categories')->insert($categories);
        // End Category Seeder

        // Start Submission Setting Seeder
        DB::table('submission_settings')->insert([
            'name'       => 'Submission Juni 2026',
            'open_at'    => '2026-06-08 23:35:00',
            'close_at'   => '2026-08-06 23:59:00',
            'created_at' => '2026-06-05 16:33:51',
            'updated_at' => '2026-06-08 13:56:49',
        ]);
        // End Submission Setting Seeder

        DB::table('app_settings')->insert([
            'key' => 'payment_due_hours',
            'value' => '24',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('merchandise_categories')->insert([
            [
                'name' => 'Apparel',
                'slug' => 'apparel',
                'description' => 'Merchandise pakaian resmi Ruang Film',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aksesoris',
                'slug' => 'aksesoris',
                'description' => 'Aksesoris resmi festival',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('merchandises')->insert([
            [
                'merchandise_category_id' => 1,
                'name' => 'Official Festival T-Shirt',
                'slug' => 'official-festival-t-shirt',
                'image' => null,
                'price' => 120000,
                'discount_price' => 100000,
                'weight' => 250,
                'qty_stock' => 20,
                'summary' => 'Kaos resmi festival Ruang Film',
                'description' => 'Kaos official dengan bahan cotton combed.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'merchandise_category_id' => 2,
                'name' => 'Festival Tote Bag',
                'slug' => 'festival-tote-bag',
                'image' => null,
                'price' => 85000,
                'discount_price' => null,
                'weight' => 150,
                'qty_stock' => 15,
                'summary' => 'Tote bag resmi festival',
                'description' => 'Tote bag koleksi untuk peserta dan penonton.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('expeditions')->insert([
            [
                'name' => 'JNE',
                'service_name' => 'REG',
                'fee' => 15000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'J&T',
                'service_name' => 'REG',
                'fee' => 18000,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('bank_accounts')->insert([
            [
                'rek_name' => 'Ruang Film Pacitan',
                'rek_bank_name' => 'BCA',
                'rek_bank_no' => '1234567890',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
