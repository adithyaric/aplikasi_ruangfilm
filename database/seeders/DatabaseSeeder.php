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
            'open_at'    => '2026-06-08 23:35:00',
            'close_at'   => '2026-08-06 23:59:00',
            'created_at' => '2026-06-05 16:33:51',
            'updated_at' => '2026-06-08 13:56:49',
        ]);
        // Start Submission Setting Seeder
    }
}
