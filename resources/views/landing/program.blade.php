<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Festival Ruang Film Horor 2026</title>

    <!-- Tailwind CSS v4 -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Font Awesome Icons (untuk sentuhan premium) -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Google Fonts: Inter & Space Grotesk untuk nuansa cinematic -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}" />
</head>

<body class="text-white overflow-x-hidden">
    <!-- ================================================== -->
    <!-- BACKGROUBD BG -->
    <!-- ================================================== -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div
            class="absolute top-[-20%] left-[-10%] w-[60%] h-[60%] bg-purple-700/20 rounded-full blur-[120px]"></div>
        <div
            class="absolute bottom-0 right-0 w-[70%] h-[50%] bg-violet-800/20 blur-[130px]"></div>
    </div>

    <!-- ================================================== -->
    <!-- NAVBAR STICKY dengan glassmorphism -->
    <!-- ================================================== -->
    <nav
        class="sticky top-0 z-50 w-full transition-all duration-300 backdrop-blur-xl bg-[#0f0f23]/70 border-b border-purple-500/20 shadow-md">
        <div
            class="max-w-7xl mx-auto px-6 md:px-10 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#home" class="flex items-center">
                <img
                    src="{{ asset('landing/images/RUANG FILM - GREEN.png') }}"
                    alt="Festival Ruang Film Horor 2026"
                    class="h-12 md:h-14 w-auto object-contain transition duration-300 hover:scale-105" />
            </a>
            <!-- Menu kanan (Desktop) -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a
                    href="/"
                    class="nav-link text-gray-200 hover:text-purple-300 transition">Home</a>
                <a
                    href="/program"
                    class="nav-link text-purple-300 font-semibold hover:text-purple-300 transition">Program</a>
                <a
                    href="/merchandise"
                    class="nav-link text-gray-200 hover:text-purple-300 transition">Merchandise</a>
                <a
                    href="{{ route('login') }}"
                    class="btn-gradient px-5 py-2 rounded-full text-white text-sm font-semibold tracking-wide shadow-lg transition-all">Login</a>
            </div>
            <!-- Mobile menu icon + dropdown sederhana (responsive) -->
            <div class="md:hidden flex items-center">
                <button
                    id="mobile-menu-btn"
                    class="text-purple-300 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <!-- Mobile dropdown menu (hidden by default) -->
        <div
            id="mobile-menu"
            class="md:hidden hidden flex-col bg-[#0f0f23]/90 backdrop-blur-xl border-t border-purple-500/20 px-6 pb-5 space-y-4 text-base font-medium">
            <a
                href="/"
                class="nav-link block py-2 text-gray-200 hover:text-purple-300">Home</a>
            <a
                href="/program"
                class="nav-link block py-2 text-gray-200 hover:text-purple-300">Program</a>
            <a
                href="#"
                class="nav-link block py-2 text-gray-200 hover:text-purple-300">Merchandise</a>
            <a
                href="{{ route('login') }}"
                class="btn-gradient inline-block text-center px-4 py-2 rounded-full text-white font-semibold">Login</a>
        </div>
    </nav>

    <main class="relative z-10">
        <!-- ================================================== -->
        <!-- SECTION 1: HERO (90vh) -->
        <!-- ================================================== -->
        <section
            id="program"
            class="relative min-h-[90vh] flex items-center justify-center px-6 py-20 overflow-hidden bg-cover bg-center"
            style="background-image: url({{ asset('landing/images/BACKGROUND FFH 2026.png') }});">
            <!-- Background blur abstract -->
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 premium-glow opacity-40"></div>
            <div class="bg-glow-abstract"></div>
            <div class="relative max-w-6xl w-full mx-auto fade-up">
                <!-- Banner glassmorphism card besar -->
                <div
                    class="glass-card p-8 md:p-12 lg:p-16 text-center shadow-2xl border border-purple-400/30">
                    <div class="space-y-6 md:space-y-8">
                        <h1
                            class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter leading-[1.1] bg-gradient-to-r from-white via-purple-200 to-purple-300 bg-clip-text text-transparent drop-shadow-2xl">
                            KOMPETISI FILM
                        </h1>
                        <p
                            class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                            Ruang Apresiasi dan Kurasi Karya Film.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: TIMELINE KOMPETISI FILM -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 timeline-section">
            <!-- Header Section dengan fade-up -->
            <div class="fade-up">
                <p
                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    COMPETITION JOURNEY
                </p>
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    Timeline Kompetisi Film
                </h2>
            </div>

            <!-- Timeline Container -->
            <div class="relative mt-16 md:mt-20 fade-up">
                <!-- Timeline Grid: 5 Cards -->
                <div
                    class="relative grid grid-cols-1 md:grid-cols-5 gap-8 md:gap-4 lg:gap-6 z-10">
                    <!-- CARD 1: OPEN SUBMISSION -->
                    <div
                        class="timeline-card-wrapper relative fade-up stagger-1"
                        style="transition-delay: 0.1s">
                        <!-- Indicator dot di atas card (desktop) -->
                        <div
                            class="hidden md:flex absolute -top-10 left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-purple-500 shadow-[0_0_12px_#8B5CF6] z-20"></div>
                        <div
                            class="glass-card-light rounded-2xl p-6 transition-all duration-300 hover:scale-[1.03] hover:shadow-[0_0_25px_#6D28D9] group h-full">
                            <div class="space-y-4">
                                <!-- Tanggal -->
                                <div class="text-center md:text-left">
                                    <p
                                        class="text-purple-300 text-xs md:text-sm font-semibold uppercase tracking-widest">
                                        8 Juni - 6 Agustus 2026
                                    </p>
                                </div>
                                <!-- Garis Pemisah -->
                                <div class="border-t border-purple-500/20 my-2"></div>
                                <!-- Judul Tahapan -->
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white text-center md:text-left">
                                    Open Submission
                                </h3>
                                <!-- Deskripsi -->
                                <p
                                    class="text-gray-300 text-sm leading-relaxed text-center md:text-left">
                                    Publikasi dan Penjaringan Karya.
                                </p>
                                <!-- Icon dekoratif -->
                                <div class="flex justify-center md:justify-start pt-2">
                                    <i
                                        class="fas fa-inbox text-purple-400/50 text-lg group-hover:text-purple-400 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: CURATION PROCESS -->
                    <div
                        class="timeline-card-wrapper relative fade-up stagger-2"
                        style="transition-delay: 0.2s">
                        <div
                            class="hidden md:flex absolute -top-10 left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-purple-500 shadow-[0_0_12px_#8B5CF6] z-20"></div>
                        <div
                            class="glass-card-light rounded-2xl p-6 transition-all duration-300 hover:scale-[1.03] hover:shadow-[0_0_25px_#6D28D9] group h-full">
                            <div class="space-y-4">
                                <p
                                    class="text-purple-300 text-xs md:text-sm font-semibold uppercase tracking-widest text-center md:text-left">
                                    13 Agustus - 25 Agustus 2026
                                </p>
                                <div class="border-t border-purple-500/20 my-2"></div>
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white text-center md:text-left">
                                    Kurasi & Seleksi
                                </h3>
                                <p
                                    class="text-gray-300 text-sm leading-relaxed text-center md:text-left">
                                    Proses Pemilihan Karya Film Terbaik dari Setiap Kategori.
                                </p>
                                <div class="flex justify-center md:justify-start pt-2">
                                    <i
                                        class="fas fa-search text-purple-400/50 text-lg group-hover:text-purple-400 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: OFFICIAL SELECTION -->
                    <div
                        class="timeline-card-wrapper relative fade-up stagger-3"
                        style="transition-delay: 0.3s">
                        <div
                            class="hidden md:flex absolute -top-10 left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-purple-500 shadow-[0_0_12px_#8B5CF6] z-20"></div>
                        <div
                            class="glass-card-light rounded-2xl p-6 transition-all duration-300 hover:scale-[1.03] hover:shadow-[0_0_25px_#6D28D9] group h-full">
                            <div class="space-y-4">
                                <p
                                    class="text-purple-300 text-xs md:text-sm font-semibold uppercase tracking-widest text-center md:text-left">
                                    26 Agustus 2026
                                </p>
                                <div class="border-t border-purple-500/20 my-2"></div>
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white text-center md:text-left">
                                    Pengumuman Official Selection
                                </h3>
                                <p
                                    class="text-gray-300 text-sm leading-relaxed text-center md:text-left">
                                    Pengumuman Karya Film Terbaik Yang Akan Masuk ke Proses
                                    Penjurian.
                                </p>
                                <div class="flex justify-center md:justify-start pt-2">
                                    <i
                                        class="fas fa-trophy text-purple-400/50 text-lg group-hover:text-purple-400 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 4: SCREENING WEEK -->
                    <div
                        class="timeline-card-wrapper relative fade-up stagger-4"
                        style="transition-delay: 0.4s">
                        <div
                            class="hidden md:flex absolute -top-10 left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-purple-500 shadow-[0_0_12px_#8B5CF6] z-20"></div>
                        <div
                            class="glass-card-light rounded-2xl p-6 transition-all duration-300 hover:scale-[1.03] hover:shadow-[0_0_25px_#6D28D9] group h-full">
                            <div class="space-y-4">
                                <p
                                    class="text-purple-300 text-xs md:text-sm font-semibold uppercase tracking-widest text-center md:text-left">
                                    26 Agustus - 7 September 2026
                                </p>
                                <div class="border-t border-purple-500/20 my-2"></div>
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white text-center md:text-left">
                                    Proses Penjurian
                                </h3>
                                <p
                                    class="text-gray-300 text-sm leading-relaxed text-center md:text-left">
                                    Penentuan Juara Oleh TIm Juri Profesional & Kompeten.
                                </p>
                                <div class="flex justify-center md:justify-start pt-2">
                                    <i
                                        class="fas fa-film text-purple-400/50 text-lg group-hover:text-purple-400 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 5: AWARDING NIGHT -->
                    <div
                        class="timeline-card-wrapper relative fade-up stagger-5"
                        style="transition-delay: 0.5s">
                        <div
                            class="hidden md:flex absolute -top-10 left-1/2 transform -translate-x-1/2 w-4 h-4 rounded-full bg-purple-500 shadow-[0_0_12px_#8B5CF6] z-20"></div>
                        <div
                            class="glass-card-light rounded-2xl p-6 transition-all duration-300 hover:scale-[1.03] hover:shadow-[0_0_25px_#6D28D9] group h-full">
                            <div class="space-y-4">
                                <p
                                    class="text-purple-300 text-xs md:text-sm font-semibold uppercase tracking-widest text-center md:text-left">
                                    9 - 12 September 2026
                                </p>
                                <div class="border-t border-purple-500/20 my-2"></div>
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white text-center md:text-left">
                                    Awarding FFH 2026
                                </h3>
                                <p
                                    class="text-gray-300 text-sm leading-relaxed text-center md:text-left">
                                    Malam Penganugerahan.
                                </p>
                                <div class="flex justify-center md:justify-start pt-2">
                                    <i
                                        class="fas fa-crown text-purple-400/50 text-lg group-hover:text-purple-400 transition-colors duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Garis timeline alternatif untuk mobile (vertical) dengan titik indikator samping -->
                <div
                    class="md:hidden absolute left-6 top-0 bottom-0 w-[2px] bg-gradient-to-b from-purple-500/20 via-purple-500/60 to-purple-500/20"></div>
            </div>

            <!-- Subtle footer note: connect to competition -->
            <!-- <div class="mt-16 text-center fade-up">
                <div
                    class="inline-flex items-center gap-3 glass-card-light px-6 py-3 rounded-full">
                    <i class="fas fa-calendar-alt text-purple-400 text-sm"></i>
                    <span class="text-gray-300 text-xs md:text-sm tracking-wide">5 tahapan menuju puncak Festival Film Horor 2026</span>
                    <i class="fas fa-arrow-right text-purple-400 text-xs"></i>
                </div>
            </div> -->
        </section>

        <!-- ================================================== -->
        <!-- SECTION: KOMPETISI FILM -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 competition-section">
            <!-- Header Section dengan fade-up -->
            <div class="fade-up">
                <p
                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    FILM COMPETITION
                </p>
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    Kategori Kompetisi Film
                </h2>
            </div>

            <!-- Glassmorphism Container Utama -->
            <div
                class="glass-card mt-12 rounded-3xl p-6 md:p-8 lg:p-10 fade-up transition-all duration-500 hover:shadow-[0_0_30px_rgba(109,40,217,0.2)]">
                <!-- Grid Kompetisi (3 kolom desktop, 2 tablet, 1 mobile) -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <!-- CARD 1: Kompetisi Film Pendek Horor -->
                    <div class="group competition-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9] h-full flex flex-col">
                            <!-- Gambar dengan fallback placeholder -->
                            <div
                                class="relative w-full h-56 overflow-hidden bg-gradient-to-br from-purple-900/50 to-black/50">
                                <img
                                    src="{{ asset('landing/images/kategori/UMUM.png') }}"
                                    alt="Kompetisi Film Pendek Horor"
                                    class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/600x400/2D1B69/8B5CF6?text=SHORT+FILM&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                                <!-- badge kecil -->
                                <div
                                    class="absolute top-4 right-4 bg-purple-600/80 backdrop-blur-sm px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                    Umum Nasional
                                </div>
                            </div>
                            <!-- Konten Card -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white mb-2 group-hover:text-purple-300 transition-colors duration-300">
                                    Umum Nasional
                                </h3>
                                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                                    Kompetisi film horor terbuka bagi sineas Indonesia dari
                                    berbagai latar belakang.
                                </p>
                                <div class="mt-auto">
                                    <a href="/umum"
                                        class="competition-btn inline-flex items-center gap-2 text-purple-400 font-semibold text-sm group-hover:text-purple-300 transition-all duration-300 group-hover:gap-3">
                                        Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: Kompetisi Film Pelajar -->
                    <div class="group competition-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9] h-full flex flex-col">
                            <div
                                class="relative w-full h-56 overflow-hidden bg-gradient-to-br from-purple-900/50 to-black/50">
                                <img
                                    src="{{ asset('landing/images/kategori/PELAJAR REGIONAL.png') }}"
                                    alt="Kompetisi Film Pelajar"
                                    class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/600x400/2D1B69/8B5CF6?text=STUDENT+FILM&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                                <div
                                    class="absolute top-4 right-4 bg-purple-600/80 backdrop-blur-sm px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                    Pelajar Se - Jawa Timur
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white mb-2 group-hover:text-purple-300 transition-colors duration-300">
                                    Pelajar Se - Jawa Timur
                                </h3>
                                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                                    Kompetisi film horor bagi pelajar SMA/SMK wilayah provinsi
                                    Jawa Timur.
                                </p>
                                <div class="mt-auto">
                                    <a href="/pelajar"
                                        class="competition-btn inline-flex items-center gap-2 text-purple-400 font-semibold text-sm group-hover:text-purple-300 transition-all duration-300 group-hover:gap-3">
                                        Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: Kompetisi Cerita Lokal Horor -->
                    <div class="group competition-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9] h-full flex flex-col">
                            <div
                                class="relative w-full h-56 overflow-hidden bg-gradient-to-br from-purple-900/50 to-black/50">
                                <img
                                    src="{{ asset('landing/images/kategori/EKSIBISI.png') }}"
                                    alt="Kompetisi Cerita Lokal Horor"
                                    class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/600x400/2D1B69/8B5CF6?text=LOCAL+STORY&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                                <div
                                    class="absolute top-4 right-4 bg-purple-600/80 backdrop-blur-sm px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                    Ekshibisi Lokal Pacitan
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl md:text-2xl font-bold text-white mb-2 group-hover:text-purple-300 transition-colors duration-300">
                                    Ekshibisi Lokal Pacitan
                                </h3>
                                <p class="text-gray-300 text-sm leading-relaxed mb-6">
                                    Kompetisi film horor bagi : <br />
                                    - Organisasi (PKK - PAUD & TK, dan Karang Taruna) & Komunitas Lokal Pacitan <br />
                                    - Pelajar SD - SMP Pacitan
                                </p>
                                <div class="mt-auto">
                                    <a href="/ekshibisi"
                                        class="competition-btn inline-flex items-center gap-2 text-purple-400 font-semibold text-sm group-hover:text-purple-300 transition-all duration-300 group-hover:gap-3">
                                        Lihat Detail <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: JURI-->
        <!-- ================================================== -->
        <section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28">
            <div class="fade-up">
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 mb-16 tracking-tight">
                    Juri
                </h2>
            </div>
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                <!-- Card 1 -->
                <div
                    class="board-card glass-card-light rounded-2xl overflow-hidden transition-all text-center duration-300 group">
                    <div class="overflow-hidden">
                        <img
                            src="{{ asset('landing/images/user.png') }}"
                            alt="To be Announce"
                            class="w-full h-120 object-cover transition duration-500 group-hover:scale-110" />
                    </div>
                    <div
                        class="absolute top-4 right-4 bg-purple-600/80 backdrop-blur-sm px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                        Umum Nasional
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-2xl font-bold tracking-tight text-white">
                            Umum Nasional
                        </h3>
                        <p
                            class="text-purple-300 text-sm uppercase tracking-wider font-semibold">
                            To be Announce
                        </p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div
                    class="board-card glass-card-light rounded-2xl overflow-hidden transition-all text-center duration-300 group">
                    <div class="overflow-hidden">
                        <img
                            src="{{ asset('landing/images/user.png') }}"
                            class="w-full h-120 object-cover transition duration-500 group-hover:scale-110" />
                    </div>
                    <div
                        class="absolute top-4 right-4 bg-purple-600/80 backdrop-blur-sm px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                        Pelajar Se - Jawa Timur
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-2xl font-bold tracking-tight text-white">
                            Pelajar Se - Jawa Timur
                        </h3>
                        <p
                            class="text-purple-300 text-sm uppercase tracking-wider font-semibold">
                            To be Announce
                        </p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div
                    class="board-card glass-card-light rounded-2xl overflow-hidden transition-all text-center duration-300 group">
                    <div class="overflow-hidden">
                        <img
                            src="{{ asset('landing/images/user.png') }}"
                            class="w-full h-120 object-cover transition duration-500 group-hover:scale-110" />
                    </div>
                    <div
                        class="absolute top-4 right-4 bg-purple-600/80 backdrop-blur-sm px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                        Ekshibisi Lokal Pacitan
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-2xl font-bold tracking-tight text-white">
                            Ekshibisi Lokal Pacitan
                        </h3>
                        <p
                            class="text-purple-300 text-sm uppercase tracking-wider font-semibold">
                            To be Announce
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: EDUKASI -->
        <!-- ================================================== -->
        <section
            class="relative min-h-[90vh] flex items-center justify-center px-6 py-20 overflow-hidden bg-cover bg-center">
            <!-- Background blur abstract -->
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 premium-glow opacity-40"></div>
            <div class="bg-glow-abstract"></div>
            <div class="relative max-w-6xl w-full mx-auto fade-up">
                <!-- Banner glassmorphism card besar -->
                <div
                    class="glass-card p-8 md:p-12 lg:p-16 text-center shadow-2xl border border-purple-400/30">
                    <div class="space-y-6 md:space-y-8">
                        <h1
                            class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter leading-[1.1] bg-gradient-to-r from-white via-purple-200 to-purple-300 bg-clip-text text-transparent drop-shadow-2xl">
                            EDUKASI
                        </h1>
                        <p
                            class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                            Workshop, Diskusi, dan Pengembangan Talenta.
                        </p>
                    </div>
                </div>
                <!-- Tombol Panah Bawah (belum aktif) -->
                <div class="mt-10 flex justify-center">
                    <button
                        class="group w-14 h-14 rounded-full glass-card-light flex items-center justify-center border border-purple-500/30 cursor-default"
                        aria-label="Lihat detail program">
                        <i
                            class="fas fa-chevron-down text-purple-400 text-xl animate-bounce group-hover:text-purple-300 transition-all duration-300"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: EKSPERIENS -->
        <!-- ================================================== -->
        <section
            class="relative min-h-[90vh] flex items-center justify-center px-6 py-20 overflow-hidden bg-cover bg-center">
            <!-- Background blur abstract -->
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 premium-glow opacity-40"></div>
            <div class="bg-glow-abstract"></div>
            <div class="relative max-w-6xl w-full mx-auto fade-up">
                <!-- Banner glassmorphism card besar -->
                <div
                    class="glass-card p-8 md:p-12 lg:p-16 text-center shadow-2xl border border-purple-400/30">
                    <div class="space-y-6 md:space-y-8">
                        <h1
                            class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter leading-[1.1] bg-gradient-to-r from-white via-purple-200 to-purple-300 bg-clip-text text-transparent drop-shadow-2xl">
                            EKSPERIENS
                        </h1>
                        <p
                            class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                            Pengalaman Imersif Berbasis Budaya & Ruang.
                        </p>
                    </div>
                </div>
                <!-- Tombol Panah Bawah (belum aktif) -->
                <div class="mt-10 flex justify-center">
                    <button
                        class="group w-14 h-14 rounded-full glass-card-light flex items-center justify-center border border-purple-500/30 cursor-default"
                        aria-label="Lihat detail program">
                        <i
                            class="fas fa-chevron-down text-purple-400 text-xl animate-bounce group-hover:text-purple-300 transition-all duration-300"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: EKOSISTEM -->
        <!-- ================================================== -->
        <section
            class="relative min-h-[90vh] flex items-center justify-center px-6 py-20 overflow-hidden bg-cover bg-center">
            <!-- Background blur abstract -->
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 premium-glow opacity-40"></div>
            <div class="bg-glow-abstract"></div>
            <div class="relative max-w-6xl w-full mx-auto fade-up">
                <!-- Banner glassmorphism card besar -->
                <div
                    class="glass-card p-8 md:p-12 lg:p-16 text-center shadow-2xl border border-purple-400/30">
                    <div class="space-y-6 md:space-y-8">
                        <h1
                            class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter leading-[1.1] bg-gradient-to-r from-white via-purple-200 to-purple-300 bg-clip-text text-transparent drop-shadow-2xl">
                            EKOSISTEM
                        </h1>
                        <p
                            class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                            Kolaborasi, Jaringan, dan Keberlanjutan Industri.
                        </p>
                    </div>
                </div>
                <!-- Tombol Panah Bawah (belum aktif) -->
                <div class="mt-10 flex justify-center">
                    <button
                        class="group w-14 h-14 rounded-full glass-card-light flex items-center justify-center border border-purple-500/30 cursor-default"
                        aria-label="Lihat detail program">
                        <i
                            class="fas fa-chevron-down text-purple-400 text-xl animate-bounce group-hover:text-purple-300 transition-all duration-300"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: FAQ (FREQUENTLY ASKED QUESTIONS) -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 faq-section">
            <!-- HEADER SECTION -->
            <div class="fade-up">
                <p
                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    PERTANYAAN UMUM
                </p>
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    FAQ
                </h2>
            </div>

            <!-- GLASSMORPHISM INTRODUCTION BOX -->
            <div
                class="glass-card mt-8 rounded-3xl p-6 md:p-8 fade-up transition-all duration-500 hover:shadow-[0_0_30px_rgba(109,40,217,0.2)]">
                <div class="max-w-3xl">
                    <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                        Temukan jawaban atas berbagai pertanyaan seputar Festival Film
                        Horor 2026. Panduan lengkap tentang pendaftaran, seleksi, kategori
                        kompetisi, dan pengalaman festival disediakan untuk memudahkan
                        partisipasi Anda.
                    </p>
                    <p class="text-gray-400 text-sm mt-4">
                        Informasi lebih detail tersedia dalam buku panduan resmi festival.
                    </p>
                </div>
            </div>

            <!-- FAQ ACCORDION AREA (Glass Card Besar) -->
            <div
                class="glass-card mt-10 rounded-3xl p-6 md:p-8 fade-up transition-all duration-500">
                <div class="space-y-4" id="faqContainer">
                    <!-- FAQ Item 1 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Siapa saja yang dapat mengikuti festival ini?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Festival ini terbuka bagi filmmaker independen, pelajar,
                                        mahasiswa, komunitas film, rumah produksi, dan masyarakat
                                        umum sesuai dengan ketentuan kategori yang berlaku.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Apakah saya bisa mendaftarkan lebih dari satu karya film?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Ya, Anda dapat mendaftarkan lebih dari satu karya film,
                                        selama memenuhi persyaratan masing-masing kategori.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Bagaimana mekanisme proses seleksi film?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Setelah film tersubmit akan masuk tahap kurasi oleh tim
                                        kurator berdasarkan kualitas cerita, teknis, dan
                                        originalitas karya.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Apakah ada biaya pendaftaran?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Proses submission tidak dikenakan biaya.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Apakah film yang pernah dipublikasikan sebelumnya dapat
                                didaftarkan?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Film yang telah dipublikasikan secara umum, termasuk
                                        melalui platform digital atau pemutaran komersial, dapat
                                        didaftarkan sesuai dengan ketentuan festival yang berlaku.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Kapan pengumuman Official Selection dilakukan?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Pengumuman karya yang lolos seleksi resmi akan disampaikan
                                        melalui website dan media sosial resmi festival sesuai
                                        jadwal yang telah ditentukan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 7 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Apakah peserta akan memperoleh sertifikat?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Peserta yang karyanya masuk dalam Official Selection akan
                                        memperoleh sertifikat partisipasi dalam bentuk digital
                                        atau fisik sesuai kebijakan panitia.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 8 -->
                    <div
                        class="faq-item glass-card-light rounded-2xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(109,40,217,0.3)]">
                        <button
                            class="faq-question w-full text-left p-5 md:p-6 flex justify-between items-center gap-4 cursor-pointer group">
                            <span
                                class="text-white font-semibold text-base md:text-lg tracking-wide group-hover:text-purple-300 transition-colors duration-300">
                                Bagaimana jika mengalami kendala teknis saat submission?
                            </span>
                            <div
                                class="faq-icon w-8 h-8 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 group-hover:shadow-[0_0_10px_#6D28D9] flex-shrink-0">
                                <i
                                    class="fas fa-plus text-purple-400 text-sm transition-all duration-300"></i>
                            </div>
                        </button>
                        <div
                            class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">
                            <div class="px-5 pb-5 md:px-6 md:pb-6">
                                <div class="border-t border-purple-500/20 pt-4">
                                    <p
                                        class="text-gray-300 leading-relaxed text-sm md:text-base">
                                        Peserta dapat menghubungi panitia melalui email atau
                                        kontak resmi yang tercantum pada website festival untuk
                                        mendapatkan bantuan lebih lanjut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER KECIL DI BAWAH ACCORDION -->
                <div class="mt-8 pt-6 border-t border-purple-500/20 text-center">
                    <p class="text-gray-400 text-sm tracking-wide">
                        <i class="fas fa-envelope mr-2 text-purple-400"></i>
                        Masih memiliki pertanyaan lain? Hubungi tim festival melalui
                        kontak resmi kami.
                    </p>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- FOOTER: RUANG FILM HOROR FESTIVAL 2026 -->
        <!-- ================================================== -->
        <footer class="w-full mt-24 md:mt-0 footer-section fade-up">
            <!-- Container Utama Footer dengan Glassmorphism -->
            <div
                class="w-full bg-gradient-to-b from-[#0f0f23]/80 to-[#0a0718]/90 backdrop-blur-xl border-t border-purple-500/20">
                <div class="max-w-7xl mx-auto px-6 md:px-10 py-16 md:py-20">
                    <!-- ROW 1: 5 Kolom Responsive -->
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 md:gap-10 lg:gap-12">
                        <!-- KOLOM 1: BRAND -->
                        <div class="space-y-4">
                            <!-- Logo Placeholder + Brand -->
                            <div class="flex items-center gap-3 group">
                                <!-- <img
                                    src="{{ asset('landing/images/RUANG FILM - GREEN.png') }}"
                                    alt="Logo Ruang Film Horor"
                                    class="h-14 w-auto object-contain transition-all duration-300 group-hover:scale-105 group-hover:drop-shadow-[0_0_10px_rgba(139,92,246,0.8)]" /> -->

                                <div>
                                    <h3
                                        class="text-2xl font-bold bg-gradient-to-r from-white to-purple-300 bg-clip-text text-transparent tracking-tight">
                                        FESTIVAL FILM HOROR 2026 <br>"INDIGO"
                                    </h3>
                                    <!-- <p class="text-purple-400 text-xs uppercase tracking-wider">
                                        Cerita Film Horor Ruang Film
                                    </p> -->
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <!-- <p class="text-gray-400 text-sm leading-relaxed">
                                Festival film horor yang menghadirkan karya sineas, komunitas
                                kreatif, dan pengalaman wisata budaya Pacitan dalam satu
                                perayaan sinema yang unik.
                            </p> -->

                            <!-- Glow accent -->
                            <div
                                class="w-12 h-[2px] bg-gradient-to-r from-purple-500 to-transparent"></div>
                        </div>

                        <!-- KOLOM 2: NAVIGASI -->
                        <div class="space-y-4">
                            <h4
                                class="text-white font-semibold text-lg tracking-wide border-l-3 border-purple-500 pl-3">
                                Navigasi
                            </h4>
                            <ul class="space-y-3">
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Beranda</a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Tentang Festival</a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Jadwal Acara</a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Merchandise</a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Sponsor</a>
                                </li>
                            </ul>
                        </div>

                        <!-- KOLOM 3: INFORMASI -->
                        <div class="space-y-4">
                            <h4
                                class="text-white font-semibold text-lg tracking-wide border-l-3 border-purple-500 pl-3">
                                Informasi
                            </h4>
                            <ul class="space-y-3">
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Registrasi</a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>FAQ</a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Syarat & Ketentuan</a>
                                </li>
                                <li>
                                    <a
                                        href="#"
                                        class="nav-footer-link text-gray-400 hover:text-purple-400 transition-all duration-300 inline-flex items-center gap-2 group"><i
                                            class="fas fa-chevron-right text-purple-500/50 text-xs group-hover:translate-x-1 transition-transform"></i>Kebijakan Privasi</a>
                                </li>
                            </ul>
                        </div>

                        <!-- KOLOM 4: HUBUNGI KAMI -->
                        <div class="space-y-4">
                            <h4
                                class="text-white font-semibold text-lg tracking-wide border-l-3 border-purple-500 pl-3">
                                Hubungi Kami
                            </h4>
                            <ul class="space-y-3">
                                <li
                                    class="contact-item group flex items-center gap-3 text-gray-400 hover:text-purple-400 transition-all duration-300">
                                    <i
                                        class="fas fa-envelope w-4 text-purple-400 group-hover:scale-110 transition-transform"></i>
                                    <a
                                        href="mailto:festival@ruangfilmhoror.id"
                                        class="text-sm hover:text-purple-400 transition-colors">pacitanruangfilm@gmail.com</a>
                                </li>
                                <li
                                    class="contact-item group flex items-center gap-3 text-gray-400 hover:text-purple-400 transition-all duration-300">
                                    <i
                                        class="fas fa-phone-alt w-4 text-purple-400 group-hover:scale-110 transition-transform"></i>
                                    <a href="https://wa.me/6282264112652" class="text-sm">+62 822 6411 2652</a>
                                </li>
                                <li
                                    class="contact-item group flex items-center gap-3 text-gray-400 hover:text-purple-400 transition-all duration-300">
                                    <i
                                        class="fas fa-map-marker-alt w-4 text-purple-400 group-hover:scale-110 transition-transform"></i>
                                    <span class="text-sm">Jl. AES Nasution No.2, Kuwarasan, Baleharjo, Pacitan, Jawa Timur</span>
                                </li>
                            </ul>
                        </div>

                        <!-- KOLOM 5: IKUTI KAMI (Social Media) -->
                        <div class="space-y-4">
                            <h4
                                class="text-white font-semibold text-lg tracking-wide border-l-3 border-purple-500 pl-3">
                                Ikuti Kami
                            </h4>
                            <div class="flex flex-wrap gap-3">
                                <a
                                    href="https://www.instagram.com/festivalfilmhoror"
                                    class="social-icon w-10 h-10 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_0_20px_#6D28D9] hover:-translate-y-1 group">
                                    <i
                                        class="fab fa-instagram text-purple-400 text-lg group-hover:text-purple-300 transition-colors"></i>
                                </a>
                                <a
                                    href="https://www.tiktok.com/@festivalfilmhoror"
                                    class="social-icon w-10 h-10 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_0_20px_#6D28D9] hover:-translate-y-1 group">
                                    <i
                                        class="fab fa-tiktok text-purple-400 text-lg group-hover:text-purple-300 transition-colors"></i>
                                </a>
                                <a
                                    href="https://www.youtube.com/@FestivalFilmHoror"
                                    class="social-icon w-10 h-10 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_0_20px_#6D28D9] hover:-translate-y-1 group">
                                    <i
                                        class="fab fa-youtube text-purple-400 text-lg group-hover:text-purple-300 transition-colors"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ROW 2: BOTTOM FOOTER dengan Garis Pemisah dan Back To Top -->
                    <div class="mt-12 pt-8 border-t border-purple-500/20">
                        <div
                            class="flex flex-col md:flex-row justify-between items-center gap-4">
                            <!-- Copyright Kiri -->
                            <div
                                class="text-gray-500 text-xs md:text-sm text-center md:text-left">
                                <i class="far fa-copyright mr-1"></i> 2026 RUANG FILM HOROR
                                FESTIVAL — ALL RIGHTS RESERVED | DEVELOPED BY <a href="https://decaa.id/">DECAA.ID</a>
                            </div>

                            <!-- Back To Top Button Kanan -->
                            <button
                                id="backToTopBtn"
                                class="back-to-top w-10 h-10 rounded-full glass-card-light flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-[0_0_20px_#6D28D9] hover:-translate-y-1 group cursor-pointer">
                                <i
                                    class="fas fa-arrow-up text-purple-400 text-lg group-hover:text-purple-300 transition-colors"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Custom JS -->
    <script src="{{ asset('landing/js/script.js') }}"></script>
    <!-- Vanilla JavaScript: Smooth Scroll, Mobile Menu, Intersection Observer (fade-up) -->
    <script src="{{ asset('landing/js/vanila1.js') }}"></script>
    <!-- Footer -->
    <script src="{{ asset('landing/js/footer.js') }}"></script>
</body>

</html>