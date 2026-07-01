<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use App\Models\BankAccount;
use App\Models\Category;
use App\Models\Expedition;
use App\Models\Film;
use App\Models\JuryScore;
use App\Models\Merchandise;
use App\Models\MerchandiseCategory;
use App\Models\SubmissionSetting;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProgramCategorySeeder::class,
            ProgramSeeder::class,
        ]);

        $filmCategories = collect([
            [
                'name' => 'Umum Nasional',
                'slug' => 'umum-nasional',
                'description' => 'Kompetisi film horor terbuka bagi sineas Indonesia dari berbagai latar belakang.',
                'landing_summary' => 'Kompetisi film horor terbuka bagi sineas Indonesia dari berbagai latar belakang.',
                'image' => 'landing/images/kategori/UMUM.png',
                'detail_route' => '/umum',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Pelajar Se - Jawa Timur',
                'slug' => 'pelajar-jawa-timur',
                'description' => 'Kompetisi film horor bagi pelajar SMA/SMK wilayah Jawa Timur.',
                'landing_summary' => 'Kompetisi film horor bagi pelajar SMA/SMK wilayah Jawa Timur.',
                'image' => 'landing/images/kategori/PELAJAR REGIONAL.png',
                'detail_route' => '/pelajar',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Organisasi & Komunitas Lokal Pacitan',
                'slug' => 'organisasi-komunitas-pacitan',
                'description' => 'Kategori untuk organisasi lokal Pacitan seperti PKK, PAUD/TK, Karang Taruna, dan komunitas.',
                'landing_summary' => 'Kategori eksibisi untuk organisasi lokal Pacitan, PKK, PAUD/TK, Karang Taruna, dan komunitas.',
                'image' => 'landing/images/kategori/EKSIBISI.png',
                'detail_route' => '/ekshibisi/organisasi',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Pelajar SD - SMP Se-Pacitan',
                'slug' => 'pelajar-sd-smp-pacitan',
                'description' => 'Kategori eksibisi untuk pelajar SD hingga SMP di Pacitan.',
                'landing_summary' => 'Kategori eksibisi untuk pelajar SD hingga SMP di Pacitan.',
                'image' => 'landing/images/kategori/EKSIBISI.png',
                'detail_route' => '/ekshibisi/paud',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ])->mapWithKeys(function ($category) {
            return [
                $category['slug'] => Category::updateOrCreate(
                    ['slug' => $category['slug']],
                    $category
                ),
            ];
        });

        $previousPeriod = SubmissionSetting::updateOrCreate(
            ['name' => 'Periode Akhir 2025'],
            [
                'hero_title' => "FESTIVAL FILM\nHOROR 2025",
                'hero_description' => 'Periode perdana yang mempertemukan karya, komunitas, dan publik dalam satu panggung festival horor berbasis budaya lokal.',
                'hero_image' => 'landing/images/BACKGROUND FFH 2026.png',
                'about_title' => 'Festival Film Horor 2025',
                'about_description' => 'FFH 2025 menjadi langkah awal hadirnya ruang apresiasi dan pengembangan sinema horor yang bertumpu pada kekayaan cerita lokal Indonesia.',
                'about_description_secondary' => 'Melalui kompetisi, diskusi, pemutaran, dan kerja kolaboratif, festival ini membangun fondasi ekosistem yang mempertemukan sineas, komunitas, dan publik.',
                'about_image' => 'landing/images/Fest.jpg',
                'hashtag' => '#FestivalFilmHoror2025',
                'theme_title' => 'Tema Festival Film Horor 2025',
                'theme_name' => 'AKAR GELAP',
                'theme_quote' => '"Membaca ulang horor sebagai ingatan, warisan, dan suara dari ruang-ruang yang jarang diterangi."',
                'theme_description' => "Periode 2025 menjadi titik mula untuk membaca horor sebagai pengalaman sosial dan budaya.\n\nTema ini membuka jalan bagi karya yang merekam keresahan, kepercayaan, dan ketegangan yang hidup di sekitar kita.",
                'theme_image' => 'landing/images/BACKGROUND FFH 2026.png',
                'festival_board' => [
                    ['name' => 'Indrata Nur Bayuaji', 'title' => 'Bupati Pacitan', 'image' => 'landing/images/INB.png'],
                    ['name' => 'Garin Nugroho', 'title' => 'Produser, Sutradara & Penulis', 'image' => 'landing/images/GARIN.png'],
                    ['name' => 'Ong Harry Wahyu', 'title' => 'Penggerak Budaya & Komunitas', 'image' => 'landing/images/ONGGY.png'],
                ],
                'last_year_title' => 'A New Horror Experience',
                'last_year_description' => 'FFH 2025 menjadi fondasi awal festival: karya-karya terbaik lahir dari keberanian membaca horor sebagai pengalaman budaya, sosial, dan personal.',
                'last_year_catalog_label' => 'Download Katalog Festival Film Horor 2025',
                'last_year_catalog_url' => '/download/ekatalog',
                'open_at' => Carbon::parse('2025-07-01 00:00:00'),
                'close_at' => Carbon::parse('2025-08-31 23:59:00'),
            ]
        );

        $currentPeriod = SubmissionSetting::updateOrCreate(
            ['name' => 'Periode Awal 2026'],
            [
                'hero_title' => "FESTIVAL FILM\nHOROR 2026",
                'hero_description' => 'Horor tidak selalu hadir sebagai sosok yang menakutkan. Ia hidup dalam ingatan, kepercayaan, trauma, dan pengalaman yang diwariskan dari generasi ke generasi.',
                'hero_image' => 'landing/images/BACKGROUND FFH 2026.png',
                'about_title' => 'Festival Film Horor 2026',
                'about_description' => 'Festival Film Horor (FFH) merupakan apresiasi, edukasi, ruang, dan pengembangan ekosistem sinema horor di Indonesia. Festival ini hadir untuk membuka ruang diskusi yang lebih luas mengenai horor sebagai medium yang merekam pengalaman manusia, ingatan kolektif, budaya lokal, hingga berbagai persoalan sosial yang hidup di tengah masyarakat.',
                'about_description_secondary' => 'Melalui pemutaran film, kompetisi, diskusi, pameran, lokakarya, dan program publik lainnya, FFH berupaya mempertemukan pembuat film, akademisi, komunitas, pelajar, serta publik dalam satu ruang yang inklusif dan kolaboratif.',
                'about_image' => 'landing/images/Fest.jpg',
                'hashtag' => '#FestivalFilmHoror2026',
                'theme_title' => 'Tema Festival Film Horor 2026',
                'theme_name' => 'INDIGO',
                'theme_quote' => '"Melihat yang tak terlihat. Membaca yang terlupakan. Membangun yang akan datang."',
                'theme_description' => "Sebenarnya, apakah Indigo itu?\n\nIndigo, secara harfiah, merupakan warna nila atau ungu. Dalam budaya kekinian, indigo mulai mengalami perkembangan makna dan kerap dilekatkan pada sensitivitas, intuisi, dan pembacaan atas hal-hal yang tak kasatmata.\n\nDi Nusantara, cerita tentang dunia yang tak terindera tumbuh subur dalam legenda, mitos, dan pengalaman spiritual. Karena itu, INDIGO dipilih sebagai tema utama FFH 2026 untuk membaca ulang horor dari sudut pandang budaya, spiritualitas, psikologi, dan ingatan kolektif.\n\nFestival Film Horor 2026 mencoba menjadi titik temu antara pengetahuan tradisional berbasis pengalaman dengan pengetahuan modern yang menuntut pembuktian rasional, sehingga lahir ruang dialog yang lebih kaya dan terbuka.",
                'theme_image' => 'landing/images/BACKGROUND FFH 2026.png',
                'festival_board' => [
                    ['name' => 'Indrata Nur Bayuaji', 'title' => 'Bupati Pacitan', 'image' => 'landing/images/INB.png'],
                    ['name' => 'Garin Nugroho', 'title' => 'Produser, Sutradara & Penulis', 'image' => 'landing/images/GARIN.png'],
                    ['name' => 'Ong Harry Wahyu', 'title' => 'Penggerak Budaya & Komunitas', 'image' => 'landing/images/ONGGY.png'],
                ],
                'last_year_title' => 'A New Horror Experience',
                'last_year_description' => 'Festival Film Horor 2025 menjadi langkah awal hadirnya platform horor berbasis kelokalan di Indonesia. Edisi perdana ini membangun fondasi melalui antusiasme audiens, partisipasi sineas, serta terbentuknya ekosistem yang mempertemukan film, budaya, kolaborasi, dan potensi ekonomi lokal.',
                'last_year_catalog_label' => 'Download Katalog Festival Film Horor 2025',
                'last_year_catalog_url' => '/download/ekatalog',
                'open_at' => Carbon::parse('2026-06-08 23:35:00'),
                'close_at' => Carbon::parse('2026-08-06 23:59:00'),
            ]
        );

        SubmissionSetting::updateOrCreate(
            ['name' => 'Periode Akhir 2026'],
            [
                'hero_title' => "FESTIVAL FILM\nHOROR 2026",
                'hero_description' => 'Periode lanjutan yang tetap fleksibel lintas bulan hingga tahun berikutnya.',
                'theme_title' => 'Tema Festival Film Horor 2026',
                'theme_name' => 'INDIGO',
                'open_at' => Carbon::parse('2026-11-01 00:00:00'),
                'close_at' => Carbon::parse('2027-01-31 23:59:00'),
            ]
        );

        AppSetting::updateOrCreate(
            ['key' => 'payment_due_hours'],
            ['value' => '24']
        );

        $systemUsers = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'category_id' => null,
                'no_hp' => '081111111111',
            ],
            [
                'name' => 'Superadmin FFH',
                'email' => 'adminffh@gmail.com',
                'role' => 'admin',
                'category_id' => null,
                'no_hp' => '081111111112',
            ],
            [
                'name' => 'Admin Submission FFH',
                'email' => 'adminsub@gmail.com',
                'role' => 'adminsub',
                'category_id' => null,
                'no_hp' => '081111111113',
            ],
            [
                'name' => 'Kurator Festival',
                'email' => 'kurator@gmail.com',
                'role' => 'kurator',
                'category_id' => null,
                'no_hp' => '081111111114',
            ],
            [
                'name' => 'Juri Umum Nasional',
                'email' => 'juri.umum@gmail.com',
                'role' => 'juri',
                'category_id' => $filmCategories['umum-nasional']->id,
                'no_hp' => '081111111115',
            ],
            [
                'name' => 'Juri Pelajar Regional',
                'email' => 'juri.pelajar@gmail.com',
                'role' => 'juri',
                'category_id' => $filmCategories['pelajar-jawa-timur']->id,
                'no_hp' => '081111111116',
            ],
            [
                'name' => 'Juri Organisasi Pacitan',
                'email' => 'juri.organisasi@gmail.com',
                'role' => 'juri',
                'category_id' => $filmCategories['organisasi-komunitas-pacitan']->id,
                'no_hp' => '081111111117',
            ],
            [
                'name' => 'Juri Pelajar Pacitan',
                'email' => 'juri.paud@gmail.com',
                'role' => 'juri',
                'category_id' => $filmCategories['pelajar-sd-smp-pacitan']->id,
                'no_hp' => '081111111118',
            ],
        ];

        foreach ($systemUsers as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, [
                    'password' => Hash::make('password'),
                ])
            );
        }

        $participants = collect([
            [
                'name' => 'Kolong Sinema',
                'email' => 'peserta.umum@gmail.com',
                'role' => 'peserta',
                'category' => 'umum-nasional',
                'no_hp' => '082111111111',
                'community_name' => 'Kolong Sinema',
                'username_ig' => 'kolongsinema',
                'alamat_lengkap' => 'Jl. Mawar No. 10, Surabaya',
            ],
            [
                'name' => 'SMK Negeri 1 Sumenep',
                'email' => 'peserta.pelajar@gmail.com',
                'role' => 'peserta',
                'category' => 'pelajar-jawa-timur',
                'no_hp' => '082111111112',
                'community_name' => 'SMK Negeri 1 Sumenep',
                'username_ig' => 'smkn1sumenep',
                'alamat_lengkap' => 'Jl. Pendidikan No. 5, Sumenep',
            ],
            [
                'name' => 'Karang Taruna Kecamatan Bandar',
                'email' => 'peserta.organisasi@gmail.com',
                'role' => 'peserta',
                'category' => 'organisasi-komunitas-pacitan',
                'no_hp' => '082111111113',
                'community_name' => 'Karang Taruna Kecamatan Bandar',
                'username_ig' => 'ktbandar',
                'alamat_lengkap' => 'Jl. Raya Bandar No. 8, Pacitan',
            ],
            [
                'name' => 'SMP Negeri 1 Arjosari',
                'email' => 'peserta.pacitan@gmail.com',
                'role' => 'peserta',
                'category' => 'pelajar-sd-smp-pacitan',
                'no_hp' => '082111111114',
                'community_name' => 'SMP Negeri 1 Arjosari',
                'username_ig' => 'smpn1arjosari',
                'alamat_lengkap' => 'Jl. Arjosari No. 12, Pacitan',
            ],
        ])->map(function ($participant) use ($filmCategories) {
            $user = User::updateOrCreate(
                ['email' => $participant['email']],
                [
                    'name' => $participant['name'],
                    'email' => $participant['email'],
                    'password' => Hash::make('password'),
                    'role' => 'peserta',
                    'no_hp' => $participant['no_hp'],
                    'category_id' => $filmCategories[$participant['category']]->id,
                ]
            );

            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'community_name' => $participant['community_name'],
                    'provinsi_code' => '35',
                    'provinsi_name' => 'Jawa Timur',
                    'kabupaten_code' => '3501',
                    'kabupaten_name' => 'Pacitan',
                    'kecamatan_code' => '3501010',
                    'kecamatan_name' => 'Pacitan',
                    'desa_code' => '3501010001',
                    'desa_name' => 'Sidoharjo',
                    'username_ig' => $participant['username_ig'],
                    'posisi' => 'Perwakilan',
                    'alamat_lengkap' => $participant['alamat_lengkap'],
                    'tanggal_lahir' => '2000-01-01',
                ]
            );

            return $user;
        })->keyBy('email');

        $merchandiseCategories = collect([
            [
                'name' => 'Apparel',
                'slug' => 'apparel',
                'description' => 'Merchandise pakaian resmi Ruang Film',
                'is_active' => true,
            ],
            [
                'name' => 'Aksesoris',
                'slug' => 'aksesoris',
                'description' => 'Aksesoris resmi festival',
                'is_active' => true,
            ],
            [
                'name' => 'Collectibles',
                'slug' => 'collectibles',
                'description' => 'Koleksi festival dan item edisi terbatas',
                'is_active' => true,
            ],
        ])->mapWithKeys(function ($category) {
            return [
                $category['slug'] => MerchandiseCategory::updateOrCreate(
                    ['slug' => $category['slug']],
                    $category
                ),
            ];
        });

        $merchandises = [
            [
                'category' => 'apparel',
                'name' => 'Official Festival T-Shirt',
                'slug' => 'official-festival-t-shirt',
                'price' => 120000,
                'discount_price' => 100000,
                'weight' => 250,
                'qty_stock' => 20,
                'summary' => 'Kaos resmi festival Ruang Film',
                'description' => 'Kaos official dengan bahan cotton combed.',
                'image' => null,
                'is_active' => true,
            ],
            [
                'category' => 'aksesoris',
                'name' => 'Festival Tote Bag',
                'slug' => 'festival-tote-bag',
                'price' => 85000,
                'discount_price' => null,
                'weight' => 150,
                'qty_stock' => 15,
                'summary' => 'Tote bag resmi festival',
                'description' => 'Tote bag koleksi untuk peserta dan penonton.',
                'image' => null,
                'is_active' => true,
            ],
            [
                'category' => 'collectibles',
                'name' => 'Poster Festival Indigo',
                'slug' => 'poster-festival-indigo',
                'price' => 45000,
                'discount_price' => null,
                'weight' => 80,
                'qty_stock' => 30,
                'summary' => 'Poster resmi tema INDIGO',
                'description' => 'Poster festival ukuran A3 edisi 2026.',
                'image' => null,
                'is_active' => true,
            ],
        ];

        foreach ($merchandises as $item) {
            Merchandise::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'merchandise_category_id' => $merchandiseCategories[$item['category']]->id,
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'image' => $item['image'],
                    'price' => $item['price'],
                    'discount_price' => $item['discount_price'],
                    'weight' => $item['weight'],
                    'qty_stock' => $item['qty_stock'],
                    'summary' => $item['summary'],
                    'description' => $item['description'],
                    'is_active' => $item['is_active'],
                ]
            );
        }

        foreach ([
            ['name' => 'JNE', 'external_code' => 'jne', 'service_name' => 'REG', 'fee' => 15000, 'is_active' => true],
            ['name' => 'J&T', 'external_code' => 'jnt', 'service_name' => 'REG', 'fee' => 18000, 'is_active' => true],
            ['name' => 'SiCepat', 'external_code' => 'sicepat', 'service_name' => 'BEST', 'fee' => 20000, 'is_active' => true],
        ] as $expedition) {
            Expedition::updateOrCreate(
                ['name' => $expedition['name'], 'service_name' => $expedition['service_name']],
                $expedition
            );
        }

        foreach ([
            ['rek_name' => 'Ruang Film Pacitan', 'rek_bank_name' => 'BCA', 'rek_bank_no' => '1234567890', 'is_active' => true],
            ['rek_name' => 'Ruang Film Pacitan', 'rek_bank_name' => 'BRI', 'rek_bank_no' => '9988776655', 'is_active' => true],
        ] as $bankAccount) {
            BankAccount::updateOrCreate(
                ['rek_bank_name' => $bankAccount['rek_bank_name'], 'rek_bank_no' => $bankAccount['rek_bank_no']],
                $bankAccount
            );
        }

        $posterPaths = [
            'posters/Xie7FPSHQiMa582yEFQcRrRI8BBTjwNm9tCiXBFC.jpg',
            'posters/gIZx6qHtMn1yK5w5wm5n3lTiMOiwgVdXLddNhTvO.png',
        ];
        $kruPaths = [
            'kru/YiM2JowQxQaxIdPTxpKMk8MUlrLFZUCNm8vJqBqA.png',
            'kru/jSMGOtuF7Chvz2GpBp971rUTQcEe5Auu6nun8f3M.jpg',
        ];
        $gsmPaths = json_encode([
            'gsm/p4W7CJBDzd1q8M3axWESfg6AwM0wNhWOfEZnfttZ.jpg',
            'gsm/zuogn9UGh5nMXU1F7fqWkT2v25ASWGV0eMre2kSk.jpg',
            'gsm/3soiHTd1SQjaDi5GXuTAT0Tebkizkne7zsM8j33y.jpg',
        ]);

        $winnerDefinitions = [
            [
                'category' => 'umum-nasional',
                'user' => 'peserta.umum@gmail.com',
                'films' => [
                    ['name' => 'Mama Minta Hotspot', 'sutradara' => 'Panji Respati', 'produser' => 'Kolong Sinema', 'winner_rank' => 'Juara 1'],
                    ['name' => 'Terbang Terendam', 'sutradara' => 'Adamifa Sobirin', 'produser' => 'Ladamif Films', 'winner_rank' => 'Juara 2'],
                    ['name' => 'Diam-Diam Ingin Aku Melawan', 'sutradara' => 'Muhammad Ibrahim', 'produser' => 'Moro-Moro Production', 'winner_rank' => 'Juara 3'],
                ],
            ],
            [
                'category' => 'pelajar-jawa-timur',
                'user' => 'peserta.pelajar@gmail.com',
                'films' => [
                    ['name' => 'Sajhen', 'sutradara' => 'Apriliansyah Salman Al Farisi Jakfar', 'produser' => 'SMK Negeri 1 Sumenep', 'winner_rank' => 'Juara 1'],
                    ['name' => 'Pendakian Terakhir', 'sutradara' => 'Nanang Supriyono', 'produser' => 'MAN Pacitan', 'winner_rank' => 'Juara 2'],
                    ['name' => 'Rumah Paling Sunyi', 'sutradara' => 'Vina Salsabila', 'produser' => 'SMKN 2 Ponorogo', 'winner_rank' => 'Juara 3'],
                ],
            ],
            [
                'category' => 'organisasi-komunitas-pacitan',
                'user' => 'peserta.organisasi@gmail.com',
                'films' => [
                    ['name' => 'Wit Wiwit Kawit', 'sutradara' => 'Karang Taruna Kecamatan Bandar', 'produser' => 'Karang Taruna Kecamatan Bandar', 'winner_rank' => 'Juara 1'],
                    ['name' => 'Seribu Bayangan', 'sutradara' => 'PKK & Karang Taruna Desa Candi', 'produser' => 'PKK & Karang Taruna Desa Candi', 'winner_rank' => 'Juara 2'],
                    ['name' => 'Lorong Tengah Malam', 'sutradara' => 'Komunitas Srawung Pacitan', 'produser' => 'Komunitas Srawung Pacitan', 'winner_rank' => 'Juara 3'],
                ],
            ],
            [
                'category' => 'pelajar-sd-smp-pacitan',
                'user' => 'peserta.pacitan@gmail.com',
                'films' => [
                    ['name' => 'Sumpek', 'sutradara' => 'SMP Negeri 1 Arjosari', 'produser' => 'SMP Negeri 1 Arjosari', 'winner_rank' => 'Juara 1'],
                    ['name' => 'Lampu Terakhir', 'sutradara' => 'SMP Negeri 2 Pacitan', 'produser' => 'SMP Negeri 2 Pacitan', 'winner_rank' => 'Juara 2'],
                    ['name' => 'Lembayung di Kelas Tua', 'sutradara' => 'SDN Pacitan 3', 'produser' => 'SDN Pacitan 3', 'winner_rank' => 'Juara 3'],
                ],
            ],
        ];

        $filmCounter = 0;

        foreach ($winnerDefinitions as $definition) {
            foreach ($definition['films'] as $filmData) {
                $participant = $participants[$definition['user']];
                $category = $filmCategories[$definition['category']];

                Film::updateOrCreate(
                    [
                        'submission_setting_id' => $previousPeriod->id,
                        'name' => $filmData['name'],
                    ],
                    [
                        'user_id' => $participant->id,
                        'category_id' => $category->id,
                        'duration' => 900 + ($filmCounter * 10),
                        'tahun_produksi' => '2025',
                        'subtitle' => 'Ya',
                        'sinopsis' => 'Film ini mengeksplorasi horor sebagai pengalaman sosial, budaya, dan personal dalam konteks lokal yang kuat.',
                        'sutradara' => $filmData['sutradara'],
                        'produser' => $filmData['produser'],
                        'penulis' => $filmData['sutradara'],
                        'poster' => $posterPaths[$filmCounter % count($posterPaths)],
                        'gsm' => $gsmPaths,
                        'trailer' => 'https://example.com/trailer/' . Str::slug($filmData['name']),
                        'film' => 'https://example.com/film/' . Str::slug($filmData['name']),
                        'kru' => $kruPaths[$filmCounter % count($kruPaths)],
                        'other_1' => null,
                        'status' => Film::CURATION_APPROVED,
                        'curation_status' => Film::CURATION_APPROVED,
                        'winner_rank' => $filmData['winner_rank'],
                        'created_at' => Carbon::parse('2025-08-20 12:00:00')->addMinutes($filmCounter),
                        'updated_at' => Carbon::parse('2025-09-12 12:00:00')->addMinutes($filmCounter),
                    ]
                );

                $filmCounter++;
            }
        }

        $currentSubmissionDefinitions = [
            [
                'email' => 'peserta.umum@gmail.com',
                'category' => 'umum-nasional',
                'name' => 'Malam di Rumah Tua',
                'status' => Film::CURATION_UNDER_REVIEW,
            ],
            [
                'email' => 'peserta.pelajar@gmail.com',
                'category' => 'pelajar-jawa-timur',
                'name' => 'Bel Pukul Dua Belas',
                'status' => Film::CURATION_APPROVED,
            ],
            [
                'email' => 'peserta.organisasi@gmail.com',
                'category' => 'organisasi-komunitas-pacitan',
                'name' => 'Pintu yang Tidak Pernah Terkunci',
                'status' => Film::CURATION_UNDER_REVIEW,
            ],
            [
                'email' => 'peserta.pacitan@gmail.com',
                'category' => 'pelajar-sd-smp-pacitan',
                'name' => 'Jejak di Ruang Kelas',
                'status' => Film::CURATION_REJECTED,
            ],
        ];

        foreach ($currentSubmissionDefinitions as $index => $filmData) {
            $participant = $participants[$filmData['email']];
            $category = $filmCategories[$filmData['category']];

            $film = Film::updateOrCreate(
                [
                    'submission_setting_id' => $currentPeriod->id,
                    'name' => $filmData['name'],
                ],
                [
                    'user_id' => $participant->id,
                    'category_id' => $category->id,
                    'duration' => 780 + ($index * 15),
                    'tahun_produksi' => '2026',
                    'subtitle' => 'Ya',
                    'sinopsis' => 'Submission aktif untuk keperluan uji alur kurasi dan penjurian.',
                    'sutradara' => $participant->name,
                    'produser' => $participant->detail->community_name ?? $participant->name,
                    'penulis' => $participant->name,
                    'poster' => $posterPaths[$index % count($posterPaths)],
                    'gsm' => $gsmPaths,
                    'trailer' => 'https://example.com/trailer/current-' . ($index + 1),
                    'film' => 'https://example.com/film/current-' . ($index + 1),
                    'kru' => $kruPaths[$index % count($kruPaths)],
                    'other_1' => null,
                    'status' => $filmData['status'],
                    'curation_status' => $filmData['status'],
                    'winner_rank' => null,
                ]
            );

            if ($film->curation_status === Film::CURATION_APPROVED) {
                $jury = User::where('email', 'juri.pelajar@gmail.com')->first();

                if ($jury) {
                    JuryScore::updateOrCreate(
                        [
                            'film_id' => $film->id,
                            'jury_id' => $jury->id,
                        ],
                        [
                            'score' => 88,
                            'note' => 'Layak masuk shortlist.',
                        ]
                    );
                }
            }
        }
    }
}
