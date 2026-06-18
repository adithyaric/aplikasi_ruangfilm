@extends('layouts.landing.master')
@section('main')
        <main class="relative z-10">
        <!-- ================================================== -->
        <!-- SECTION 1: HERO (90vh) -->
        <!-- ================================================== -->
        <section
            id="home"
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
                            FESTIVAL FILM<br />HOROR 2026
                        </h1>
                        <p
                            class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                            Horor tidak selalu hadir sebagai sosok yang menakutkan. la hidup
                            dalam ingatan, kepercayaan, trauma, dan pengalaman yang
                            diwariskan dari generasi ke generasi.
                        </p>
                        <!-- <div
                            class="flex flex-wrap items-center justify-center gap-5 pt-4"> -->
                        <!-- <a
                                href="/program"
                                class="btn-gradient px-8 py-3 md:px-10 md:py-4 rounded-full text-white font-semibold tracking-wide text-base transition-all shadow-purple-500/30">Explore Program</a> -->
                        <!-- </div> -->
                        <!-- Tombol Submit Utama -->
                        @php
                        // $setting = \App\Models\SubmissionSetting::current();
                        // $submissionOpen = \App\Models\SubmissionSetting::isOpen();
                        @endphp

                        <div>
                            @if($submissionOpen)
                            <a href="{{ route('register') }}"
                                class="btn-gradient px-8 md:px-10 py-3 md:py-4 rounded-full text-white font-semibold text-base md:text-lg transition-all duration-300 hover:scale-105 hover:shadow-[0_0_25px_#8B5CF6] inline-flex items-center gap-3 group">
                                <i class="fas fa-upload text-white group-hover:translate-y-[-2px] transition-transform duration-300"></i>
                                Submit Film Sekarang
                            </a>
                            @if($setting)
                            <p class="text-gray-300 text-xs mt-4"><b>DITUTUP DALAM</b></p>
                            <div id="countdown-close" class="flex gap-3 mt-2 justify-center">
                                @foreach(['cc-days' => 'HARI', 'cc-hours' => 'JAM', 'cc-minutes' => 'MENIT', 'cc-seconds' => 'DETIK'] as $id => $label)
                                <div class="text-center">
                                    <div id="{{ $id }}" class="text-white font-bold text-xl bg-white/10 rounded-lg px-3 py-2 min-w-[48px]">--</div>
                                    <div class="text-gray-500 text-[10px] mt-1">{{ $label }}</div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            @else
                            <button
                                disabled
                                class="px-8 md:px-10 py-3 md:py-4 rounded-full text-gray-400 font-semibold text-base md:text-lg inline-flex items-center gap-3 cursor-not-allowed bg-white/5 border border-white/10">
                                <i class="fas fa-lock text-gray-500"></i>
                                Submission Ditutup
                            </button>
                            @if($setting && now()->lessThan($setting->open_at))
                            <p class="text-gray-300 text-xs mt-4"><b>DIBUKA DALAM</b></p>
                            <div id="countdown-open" class="flex gap-3 mt-2 justify-center">
                                @foreach(['co-days' => 'HARI', 'co-hours' => 'JAM', 'co-minutes' => 'MENIT', 'co-seconds' => 'DETIK'] as $id => $label)
                                <div class="text-center">
                                    <div id="{{ $id }}" class="text-white font-bold text-xl bg-white/10 rounded-lg px-3 py-2 min-w-[48px]">--</div>
                                    <div class="text-gray-500 text-[10px] mt-1">{{ $label }}</div>
                                </div>
                                @endforeach
                            </div>
                            @elseif($setting)
                            <p class="text-gray-500 text-xs mt-4">
                                *Pendaftaran telah ditutup sejak {{ $setting->close_at->translatedFormat('d F Y') }} pukul {{ $setting->close_at->format('H:i') }} WIB
                            </p>
                            @else
                            <p class="text-gray-500 text-xs mt-4">*Jadwal pendaftaran belum ditentukan</p>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION 2: TENTANG FESTIVAL -->
        <!-- ================================================== -->
        <section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-32">
            <div class="fade-up">
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 mb-14 tracking-tight">
                    Tentang Festival
                </h2>
            </div>
            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
                <!-- Kolom kiri: gambar portrait dengan rounded besar & shadow -->
                <div
                    class="fade-up rounded-3xl overflow-hidden shadow-2xl shadow-purple-900/30 transition-all duration-500 hover:-translate-y-2 hover:shadow-purple-600/50 group">
                    <img
                        src="{{ asset('landing/images/Fest.jpg') }}"
                        alt="Festival Ruang Film Horor 2026"
                        class="w-full h-[600px] object-cover transition duration-700 group-hover:scale-105" />
                </div>
                <!-- Kolom kanan: deskripsi panjang -->
                <div class="fade-up space-y-6">
                    <h3
                        class="text-2xl md:text-3xl font-semibold text-purple-300 tracking-wide">
                        Festival Film Horor 2026
                    </h3>
                    <p style="text-align: justify;" class="text-gray-300 leading-relaxed text-base md:text-lg">
                        Festival Film Horor (FFH) merupakan apresiasi, edukasi, ruang dan
                        pengembangan ekosistem sinema horor di Indonesia. Festival ini
                        hadir untuk membuka ruang diskusi yang lebih luas mengenai horor
                        sebagai medium yang merekam pengalaman manusia, ingatan kolektif,
                        budaya lokal, hingga berbagai persoalan sosial yang hidup di
                        tengah masyarakat.
                    </p>
                    <p style="text-align: justify;" class="text-gray-300 leading-relaxed text-base md:text-lg">
                        Melalui pemutaran film, kompetisi, diskusi, pameran, lokakarya,
                        dan program publik lainnya, FFH berupaya mempertemukan pembuat
                        film, akademisi, komunitas, pelajar, serta publik dalam satu ruang
                        yang inklusif dan kolaboratif.
                    </p>
                    <div class="pt-4">
                        <div
                            class="flex items-center space-x-2 text-purple-300 text-sm font-medium">
                            <span class="w-8 h-[2px] bg-purple-400"></span>
                            <span>#FestivalFilmHoror2026</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION 3: FESTIVAL BOARD -->
        <!-- ================================================== -->
        <section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28">
            <div class="fade-up">
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 mb-16 tracking-tight">
                    Festival Board
                </h2>
            </div>
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                <!-- Card 1 -->
                <div
                    class="board-card glass-card-light rounded-2xl overflow-hidden transition-all duration-300 group">
                    <div class="overflow-hidden">
                        <img
                            src="{{ asset('landing/images/INB.png') }}"
                            alt="Indrata Nur Bayu Aji"
                            class="w-full h-120 object-cover transition duration-500 group-hover:scale-110" />
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-2xl font-bold tracking-tight text-white">
                            INDRATA NUR BAYUAJI
                        </h3>
                        <p
                            class="text-purple-300 text-sm uppercase tracking-wider font-semibold">
                            Bupati Pacitan
                        </p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div
                    class="board-card glass-card-light rounded-2xl overflow-hidden transition-all duration-300 group">
                    <div class="overflow-hidden">
                        <img
                            src="{{ asset('landing/images/GARIN.png') }}"
                            alt="Garin Nugroho"
                            class="w-full h-120 object-cover transition duration-500 group-hover:scale-110" />
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-2xl font-bold tracking-tight text-white">
                            GARIN NUGROHO
                        </h3>
                        <p
                            class="text-purple-300 text-sm uppercase tracking-wider font-semibold">
                            Produser, Sutradara & Penulis
                        </p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div
                    class="board-card glass-card-light rounded-2xl overflow-hidden transition-all duration-300 group">
                    <div class="overflow-hidden">
                        <img
                            src="{{ asset('landing/images/ONGGY.png') }}"
                            alt="Garin Nugroho"
                            class="w-full h-120 object-cover transition duration-500 group-hover:scale-110" />
                    </div>
                    <div class="p-6 space-y-3">
                        <h3 class="text-2xl font-bold tracking-tight text-white">
                            ONG HARRY WAHYU
                        </h3>
                        <p
                            class="text-purple-300 text-sm uppercase tracking-wider font-semibold">
                            Penggerak Budaya & Komunitas
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION 4: FESTIVAL EXPERIENCE -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 awards-carousel-section">
            <div class="flex justify-between items-end mb-8 fade-up">
                <!-- Subtitle & Judul -->
                <div>
                    <p
                        class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                        EXPLORE THE FESTIVAL
                    </p>
                    <h2
                        class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                        What Happened Last Year
                    </h2>
                </div>
                <!-- Tombol Navigasi -->
                <div class="flex gap-3">
                    <button
                        id="prevAwardBtn"
                        class="w-12 h-12 rounded-full glass-card-light flex items-center justify-center text-purple-300 hover:text-white hover:bg-purple-600/50 transition-all duration-300 cursor-pointer group">
                        <i class="fas fa-chevron-left text-xl"></i>
                    </button>
                    <button
                        id="nextAwardBtn"
                        class="w-12 h-12 rounded-full glass-card-light flex items-center justify-center text-purple-300 hover:text-white hover:bg-purple-600/50 transition-all duration-300 cursor-pointer group">
                        <i class="fas fa-chevron-right text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Carousel Container -->
            <div class="relative overflow-hidden">
                <div id="awardsCarouselTrack" class="flex">
                    <!-- Glass Card Container Utama -->
                    <div class="w-full flex-shrink-0 px-2 award-slide">
                        <div
                            class="glass-card p-6 md:p-8 lg:p-10 rounded-3xl transition-all duration-500 fade-up">
                            <!-- Layout Desktop: 2 kolom (60% - 40%) -->
                            <div class="flex flex-col lg:flex-row gap-8 lg:gap-10">
                                <!-- KOLOM KIRI (60%): Grid Featured Films (3x2) -->
                                <div class="lg:w-[60%] w-full">
                                    <h3
                                        class="text-white text-xl font-semibold tracking-wide mb-5 flex items-center gap-2">
                                        <i class="fas fa-clapperboard text-purple-400"></i>
                                        Featured Films
                                    </h3>

                                    <!-- Grid 3x2 untuk desktop -->
                                    <div
                                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                                        <!-- Film Card 1 dengan Slideshow Internal -->
                                        <div class="film-card group transition-all duration-300">
                                            <div
                                                class="relative rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-[0_0_20px_#6D28D9]">
                                                <!-- Slideshow Container -->
                                                <div
                                                    class="relative slideshow-container w-full h-72 overflow-hidden bg-gradient-to-b from-purple-900/30 to-black/50">
                                                    <div class="slideshow-track relative w-full h-full">
                                                        <img
                                                            src="{{ asset('landing/images/films/cardfilm1/card1.jpg') }}"
                                                            alt="Film still 1"
                                                            class="slideshow-img absolute w-full h-full object-cover opacity-100 transition-opacity duration-700 ease-in-out" />
                                                    </div>
                                                    <!-- <span
                                                        class="absolute top-3 left-3 bg-purple-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-2 py-1 rounded-md z-10">Midnight</span> -->
                                                </div>
                                                <!-- <div class="p-4 space-y-1">
                                                    <h4 class="font-bold text-white text-base truncate">
                                                        The Shadow Within
                                                    </h4>
                                                    <p class="text-purple-300 text-xs">
                                                        Horror, Psychological
                                                    </p>
                                                    <p class="text-gray-400 text-xs">105 min</p>
                                                </div> -->
                                            </div>
                                        </div>

                                        <!-- Film Card 2 -->
                                        <div class="film-card group transition-all duration-300">
                                            <div
                                                class="relative rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-[0_0_20px_#6D28D9]">
                                                <div
                                                    class="relative slideshow-container w-full h-72 overflow-hidden bg-gradient-to-b from-purple-900/30 to-black/50">
                                                    <div class="slideshow-track relative w-full h-full">
                                                        <img
                                                            src="{{ asset('landing/images/films/cardfilm1/card2.png') }}"
                                                            alt="Film still 1"
                                                            class="slideshow-img absolute w-full h-full object-cover opacity-100 transition-opacity duration-700" />
                                                    </div>
                                                    <!-- <span
                                                        class="absolute top-3 left-3 bg-purple-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-2 py-1 rounded-md z-10">Premiere</span> -->
                                                </div>
                                                <!-- <div class="p-4 space-y-1">
                                                    <h4 class="font-bold text-white text-base truncate">
                                                        Echoes of Madness
                                                    </h4>
                                                    <p class="text-purple-300 text-xs">
                                                        Thriller, Gore
                                                    </p>
                                                    <p class="text-gray-400 text-xs">98 min</p>
                                                </div> -->
                                            </div>
                                        </div>

                                        <!-- Film Card 3 -->
                                        <div class="film-card group transition-all duration-300">
                                            <div
                                                class="relative rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-[0_0_20px_#6D28D9]">
                                                <div
                                                    class="relative slideshow-container w-full h-72 overflow-hidden bg-gradient-to-b from-purple-900/30 to-black/50">
                                                    <div class="slideshow-track relative w-full h-full">
                                                        <img
                                                            src="{{ asset('landing/images/films/cardfilm1/card3.jpg') }}"
                                                            alt="Film still 1"
                                                            class="slideshow-img absolute w-full h-full object-cover opacity-100 transition-opacity duration-700" />
                                                    </div>
                                                    <!-- <span
                                                        class="absolute top-3 left-3 bg-purple-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-2 py-1 rounded-md z-10">VR Room</span> -->
                                                </div>
                                                <!-- <div class="p-4 space-y-1">
                                                    <h4 class="font-bold text-white text-base truncate">
                                                        The Forest Whispers
                                                    </h4>
                                                    <p class="text-purple-300 text-xs">Supernatural</p>
                                                    <p class="text-gray-400 text-xs">88 min</p>
                                                </div> -->
                                            </div>
                                        </div>

                                        <!-- Film Card 4 -->
                                        <div class="film-card group transition-all duration-300">
                                            <div
                                                class="relative rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-[0_0_20px_#6D28D9]">
                                                <div
                                                    class="relative slideshow-container w-full h-72 overflow-hidden bg-gradient-to-b from-purple-900/30 to-black/50">
                                                    <div class="slideshow-track relative w-full h-full">
                                                        <img
                                                            src="{{ asset('landing/images/films/cardfilm1/card4.png') }}"
                                                            alt="Film still 1"
                                                            class="slideshow-img absolute w-full h-full object-cover opacity-100 transition-opacity duration-700" />
                                                    </div>
                                                    <!-- <span
                                                        class="absolute top-3 left-3 bg-purple-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-2 py-1 rounded-md z-10">Gala</span> -->
                                                </div>
                                                <!-- <div class="p-4 space-y-1">
                                                    <h4 class="font-bold text-white text-base truncate">
                                                        Blood Moon Ritual
                                                    </h4>
                                                    <p class="text-purple-300 text-xs">Folk Horror</p>
                                                    <p class="text-gray-400 text-xs">112 min</p>
                                                </div> -->
                                            </div>
                                        </div>

                                        <!-- Film Card 5 -->
                                        <div class="film-card group transition-all duration-300">
                                            <div
                                                class="relative rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-[0_0_20px_#6D28D9]">
                                                <div
                                                    class="relative slideshow-container w-full h-72 overflow-hidden bg-gradient-to-b from-purple-900/30 to-black/50">
                                                    <div class="slideshow-track relative w-full h-full">
                                                        <img
                                                            src="{{ asset('landing/images/films/cardfilm1/card5.jpg') }}"
                                                            alt="Film still 1"
                                                            class="slideshow-img absolute w-full h-full object-cover opacity-100 transition-opacity duration-700" />
                                                    </div>
                                                    <!-- <span
                                                        class="absolute top-3 left-3 bg-purple-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-2 py-1 rounded-md z-10">Screening</span> -->
                                                </div>
                                                <!-- <div class="p-4 space-y-1">
                                                    <h4 class="font-bold text-white text-base truncate">
                                                        Anomaly Sector
                                                    </h4>
                                                    <p class="text-purple-300 text-xs">Sci-Fi Horror</p>
                                                    <p class="text-gray-400 text-xs">95 min</p>
                                                </div> -->
                                            </div>
                                        </div>

                                        <!-- Film Card 6 -->
                                        <div class="film-card group transition-all duration-300">
                                            <div
                                                class="relative rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.02] group-hover:shadow-[0_0_20px_#6D28D9]">
                                                <div
                                                    class="relative slideshow-container w-full h-72 overflow-hidden bg-gradient-to-b from-purple-900/30 to-black/50">
                                                    <div class="slideshow-track relative w-full h-full">
                                                        <img
                                                            src="{{ asset('landing/images/films/cardfilm1/card6.jpg') }}"
                                                            alt="Film still 1"
                                                            class="slideshow-img absolute w-full h-full object-cover opacity-100 transition-opacity duration-700" />
                                                    </div>
                                                    <!-- <span
                                                        class="absolute top-3 left-3 bg-purple-600/90 backdrop-blur-sm text-white text-[11px] font-bold px-2 py-1 rounded-md z-10">Special</span> -->
                                                </div>
                                                <!-- <div class="p-4 space-y-1">
                                                    <h4 class="font-bold text-white text-base truncate">
                                                        Last Lullaby
                                                    </h4>
                                                    <p class="text-purple-300 text-xs">Drama Horror</p>
                                                    <p class="text-gray-400 text-xs">102 min</p>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- KOLOM KANAN (40%): Informasi Festival -->
                                <div class="lg:w-[40%] w-full space-y-6">
                                    <div>
                                        <h3
                                            class="text-2xl md:text-3xl font-bold text-white mb-4">
                                            A New Horror Experience
                                        </h3>
                                        <p style="text-align: justify;"
                                            class="text-gray-300 leading-relaxed text-sm md:text-base mb-4">
                                            Festival Film Horor Pacitan 2025 menjadi langkah awal
                                            hadirnya platform horor berbasis kelokalan di Indonesia.
                                            Edisi perdana ini berhasil membangun fondasi melalui
                                            antusiasme audiens, partisipasi sineas nasional, serta
                                            terbentuknya ekosistem yang mempertemukan film, budaya,
                                            kolaborasi, dan potensi ekonomi lokal.
                                        </p>
                                    </div>

                                    {{-- <!-- List Fitur dengan Icon Ungu -->
                                    <div class="space-y-3">

                                            <div
                                            class="flex items-center gap-3 group transition-all duration-200 hover:translate-x-1">
                                            <i
                                                class="fas fa-globe-asia text-purple-400 w-5 text-lg"></i>
                                            <span class="text-gray-200 text-sm">International Screening</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-3 group transition-all duration-200 hover:translate-x-1">
                                            <i
                                                class="fas fa-vr-cardboard text-purple-400 w-5 text-lg"></i>
                                            <span class="text-gray-200 text-sm">VR Horror Experience</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-3 group transition-all duration-200 hover:translate-x-1">
                                            <i class="fas fa-film text-purple-400 w-5 text-lg"></i>
                                            <span class="text-gray-200 text-sm">Film Competition</span>
                                        </div>
                                        <div
                                            class="flex items-center gap-3 group transition-all duration-200 hover:translate-x-1">
                                            <i
                                                class="fas fa-chalkboard-user text-purple-400 w-5 text-lg"></i>
                                            <span class="text-gray-200 text-sm">Director Talkshow</span>
                                        </div>
                                    </div>--}}

                                    <!-- Tombol View Full Program -->
                                    <div class="pt-4">
                                        <a href="{{ route('download.ekatalog') }}"
                                            class="btn-gradient inline-flex items-center gap-2 px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:gap-3">
                                            Download Katalog Festival Film Horor 2025
                                            <i class="fas fa-arrow-right text-sm"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- STATISTIK FESTIVAL (Grid 4 kolom) dengan Counter Animation -->
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-12 pt-6 border-t border-purple-500/20">
                                <!-- Stat 1 -->
                                <div
                                    class="glass-card-light rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-[0_0_15px_#6D28D9] hover:scale-[1.02]">
                                    <div
                                        class="text-4xl md:text-5xl font-black bg-gradient-to-r from-purple-400 to-fuchsia-400 bg-clip-text text-transparent mb-2">
                                        <span class="counter" data-target="285">0</span>
                                    </div>
                                    <p
                                        class="text-gray-300 text-sm uppercase tracking-wide font-medium">
                                        Film Submitted
                                    </p>
                                </div>
                                <!-- Stat 2 -->
                                <div
                                    class="glass-card-light rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-[0_0_15px_#6D28D9] hover:scale-[1.02]">
                                    <div
                                        class="text-4xl md:text-5xl font-black bg-gradient-to-r from-purple-400 to-fuchsia-400 bg-clip-text text-transparent mb-2">
                                        <span class="counter" data-target="60">0</span>+
                                    </div>
                                    <p
                                        class="text-gray-300 text-sm uppercase tracking-wide font-medium">
                                        Special Films
                                    </p>
                                </div>
                                <!-- Stat 3 -->
                                <div
                                    class="glass-card-light rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-[0_0_15px_#6D28D9] hover:scale-[1.02]">
                                    <div
                                        class="text-4xl md:text-5xl font-black bg-gradient-to-r from-purple-400 to-fuchsia-400 bg-clip-text text-transparent mb-2">
                                        <span class="counter" data-target="8000">0</span>+
                                    </div>
                                    <p
                                        class="text-gray-300 text-sm uppercase tracking-wide font-medium">
                                        Audience
                                    </p>
                                </div>
                                <!-- Stat 4 -->
                                <div
                                    class="glass-card-light rounded-2xl p-6 text-center transition-all duration-300 hover:shadow-[0_0_15px_#6D28D9] hover:scale-[1.02]">
                                    <div
                                        class="text-4xl md:text-5xl font-black bg-gradient-to-r from-purple-400 to-fuchsia-400 bg-clip-text text-transparent mb-2">
                                        <span class="counter" data-target="62">0</span>
                                    </div>
                                    <p
                                        class="text-gray-300 text-sm uppercase tracking-wide font-medium">
                                        Participants
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GLASS CARD 2: -->
                    <div class="w-full flex-shrink-0 px-2 award-slide">
                        <div
                            class="glass-card p-6 md:p-8 lg:p-10 rounded-3xl transition-all duration-500">
                            <div>
                                <h2 class="text-3xl md:text-5xl font-bold text-white mb-2">
                                    FFH 2025 Film Winner
                                </h2>
                                <p
                                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-10">
                                    Kategori Umum
                                </p>
                            </div>

                            <div
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Poster 1 - Juara 1 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/umum/umum1.jpg') }}"
                                            alt="Winner Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=WINNER+POSTER+1'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-yellow-500 text-xs font-bold uppercase tracking-wider">
                                                🏆 JUARA 1
                                            </p>
                                            <h3 class="text-xl font-bold text-white">
                                                Mama Minta Hotspot
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: Kolong Sinema
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: Panji Respati
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Poster 2 - Juara 2 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/umum/umum2.jpg') }}"
                                            alt="Winner Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=WINNER+POSTER+2'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-purple-400 text-xs font-bold uppercase tracking-wider">
                                                🥈 JUARA 2
                                            </p>
                                            <h3 class="text-xl font-bold text-white">
                                                Terbang Terendam
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: Ladamif Films
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: Adamifa Sobirin
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Poster 3 - Juara 3 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/umum/umum3.jpg') }}"
                                            alt="Winner Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=WINNER+POSTER+3'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-purple-400 text-xs font-bold uppercase tracking-wider">
                                                🥉 JUARA 3
                                            </p>
                                            <h3 class="text-xl font-bold text-white">
                                                Diam Diam, Ingin Aku Melawan
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: Moro-Moro Production
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: Muhammad Ibrahim
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GLASS CARD 3: -->
                    <div class="w-full flex-shrink-0 px-2 award-slide">
                        <div
                            class="glass-card p-6 md:p-8 lg:p-10 rounded-3xl transition-all duration-500">
                            <div>
                                <h2 class="text-3xl md:text-5xl font-bold text-white mb-2">
                                    FFH 2025 Film Winner
                                </h2>
                                <p
                                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-10">
                                    Kategori Pelajar Regional
                                </p>
                            </div>

                            <div
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Poster 1 - Juara 1 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/regional/pelajar1.jpg') }}"
                                            alt="Cinematography Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=CINEMA+1'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-yellow-500 text-xs font-bold uppercase tracking-wider">
                                                🏆 JUARA 1
                                            </p>
                                            <h3 class="text-xl font-bold text-white">
                                                Terbang Terendam
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: Ladamif Films
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: Adamifa Sobirin
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Poster 2 - Juara 2 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/regional/pelajar2.jpg') }}"
                                            alt="Cinematography Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=CINEMA+2'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-purple-400 text-xs font-bold uppercase tracking-wider">
                                                🥈 JUARA 2
                                            </p>
                                            <h3 class="text-xl font-bold text-white">SAJHEN</h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: SMK Negeri 1 Sumenep
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: APRILIANSYAH SALMAN AL FARISI JAKFAR
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Poster 3 - Juara 3 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/regional/pelajar3.JPEG') }}"
                                            alt="Cinematography Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=CINEMA+3'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-purple-400 text-xs font-bold uppercase tracking-wider">
                                                🥉 JUARA 3
                                            </p>
                                            <h3 class="text-xl font-bold text-white">
                                                Pendakian Terakhir
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: MAN Pacitan
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: NANANG SUPRIYONO
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- GLASS CARD 4: -->
                    <div class="w-full flex-shrink-0 px-2 award-slide">
                        <div
                            class="glass-card p-6 md:p-8 lg:p-10 rounded-3xl transition-all duration-500">
                            <div>
                                <h2 class="text-3xl md:text-5xl font-bold text-white mb-2">
                                    FFH 2025 Film Winner
                                </h2>
                                <p
                                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-10">
                                    Kategori Ekshibisi
                                </p>
                            </div>

                            <div
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Poster 1 - Juara 1 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/eksibisi/eksibisi1.jpg') }}"
                                            alt="Audience Choice Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=AUDIENCE+1'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-yellow-500 text-xs font-bold uppercase tracking-wider">
                                                🏆 JUARA 1
                                            </p>
                                            <h3 class="text-xl font-bold text-white">
                                                Wit Wiwit Kawit
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: Karang Taruna Kecamatan Bandar
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: Karang Taruna Kecamatan Bandar
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Poster 2 - Juara 2 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/eksibisi/eksibisi2.jpg') }}"
                                            alt="Audience Choice Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=AUDIENCE+2'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-purple-400 text-xs font-bold uppercase tracking-wider">
                                                🥈 JUARA 2
                                            </p>
                                            <h3 class="text-xl font-bold text-white">
                                                Seribu Bayangan
                                            </h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: PKK & Karang Taruna Desa Candi
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: PKK & Karang Taruna Desa Candi
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Poster 3 - Juara 3 -->
                                <div class="group transition-all duration-300">
                                    <div
                                        class="rounded-2xl overflow-hidden glass-card-light transition-all duration-300 group-hover:scale-[1.03] group-hover:shadow-[0_0_25px_#6D28D9]">
                                        <img
                                            src="{{ asset('landing/images/juara/eksibisi/eksibisi3.jpg') }}"
                                            alt="Audience Choice Poster"
                                            class="w-full h-80 object-cover"
                                            onerror="
                          this.src =
                            'https://placehold.co/400x550/2D1B69/FFFFFF?text=AUDIENCE+3'
                        " />
                                        <div class="p-5 space-y-2">
                                            <p
                                                class="text-purple-400 text-xs font-bold uppercase tracking-wider">
                                                🥉 JUARA 3
                                            </p>
                                            <h3 class="text-xl font-bold text-white">SUMPEK</h3>
                                            <p class="text-gray-400 text-sm">
                                                Production House: SMP Negeri 1 Arjosari
                                            </p>
                                            <p class="text-gray-400 text-sm">
                                                Sutradara: SMP Negeri 1 Arjosari
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @php
        // $setting = \App\Models\SubmissionSetting::current();
        // $submissionOpen = \App\Models\SubmissionSetting::isOpen();
        // $isBeforeOpen = $setting && now()->lessThan($setting->open_at);
        @endphp
        @if ($setting)
        @if($submissionOpen || $isBeforeOpen)
        <!-- ================================================================== -->
        <!-- NEW SECTION: INDIGO -->
        <!-- ================================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 indigo-program-section">
            <!-- heading area with fade-up animation -->
            <div class="fade-up">
                <p
                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    SPECIAL FEATURE PROGRAM
                </p>
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    INDIGO
                </h2>
            </div>

            <!-- main large glass-card container (one single glassmorphism container) -->
            <div
                class="glass-card mt-12 overflow-hidden rounded-3xl transition-all duration-500 indigo-card-hover fade-up">
                <!-- HEADER PROGRAM -->
                <div class="p-6 md:p-8 lg:p-10 border-b border-purple-500/20">
                    <h3
                        class="text-3xl md:text-5xl font-bold text-white text-center tracking-tight">
                        Tema Festival Film Horor 2026
                    </h3>
                </div>
                <!-- HERO BANNER (full width inside glass-card) -->
                <div
                    class="relative w-full h-[350px] md:h-[420px] lg:h-[450px] overflow-hidden rounded-t-3xl">
                    <!-- background image with fallback placeholder -->
                    <img
                        src="{{ asset('landing/images/BACKGROUND FFH 2026.png') }}"
                        alt="INDIGO supernatural horror banner"
                        class="absolute w-full h-full object-cover object-center"
                        onerror="
                this.onerror = null;
                this.src =
                  'https://placehold.co/1600x900/18122B/8B5CF6?text=INDIGO+CINEMATIC+BANNER&font=montserrat';
              " />
                    <!-- dark gradient overlay (cinematic) -->
                    <div class="absolute inset-0 banner-gradient-overlay"></div>
                    <!-- additional subtle purple glow on edges -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-purple-900/30 via-transparent to-black/50"></div>

                    <!-- centered text content -->
                    <div
                        class="absolute inset-0 flex flex-col items-center justify-center text-center px-6 z-10">
                        <h1
                            class="text-6xl md:text-8xl lg:text-9xl font-black uppercase tracking-wider bg-gradient-to-r from-white via-purple-200 to-purple-300 bg-clip-text text-transparent drop-shadow-2xl animate-pulse"
                            style="text-shadow: 0 0 30px rgba(139, 92, 246, 0.5)">
                            INDIGO
                        </h1>
                        <p
                            class="text-purple-200 text-base md:text-xl font-light tracking-wide mt-4 backdrop-blur-sm px-4 py-1 rounded-full bg-black/20">
                            "Melihat yang tak terlihat. Membaca yang terlupakan. Membangun
                            yang akan datang."
                        </p>
                    </div>
                </div>

                <!-- CONTENT AREA: 5 paragraphs with elegant spacing (still inside same glass-card) -->
                <div class="p-6 md:p-10 lg:p-12">
                    <div
                        class="max-w-4xl mx-auto space-y-6 md:space-y-7 text-gray-300 leading-relaxed text-base md:text-lg">
                        <p style="text-align: justify !important;">
                            Sebenarnya, apakah Indigo itu? <br />
                            Indigo, secara harfiah, merupakan warna nila atau ungu. Dalam
                            budaya kekinian, indigo mulai mengalami perkembangan makna.
                            Selain sebagai salah satu warna, indigo dimaknai sebagai
                            seseorang yang memancarkan aura warna ungu, seperti dalam
                            sebutan "anak indigo".
                        </p>
                        <p style="text-align: justify !important;">
                            Ya. "anak indigo" yang dimaksud adalah mereka yang kerap
                            dipercaya memiliki sensitivitas tinggi, intuisi yang tajam,
                            hingga kemampuan-kemampuan melampaui logika manusia karena peka
                            dengan hal-hal spiritual dan mistis.
                        </p>
                        <p style="text-align: justify !important;">
                            Di tanah Nusantara, cerita-cerita tentang "hal-hal yang tidak
                            terindera' sangatlah subur. Legenda, dongeng, mitos, sampai
                            ajaran-ajaran spiritual bisa kita dengar dari siapa pun dan di
                            mana pun. Karena itu pula, indigo adalah kata yang sangat dekat
                            dan menjadi kepercayaan lama yang mengakar dalam tradisi kita.
                            Di Jawa, kepekaan terhadap hal-hal tak kasat mata ini disebut
                            linuwih, di bahasa Sunda disebut pinunjul, sementara bahasa
                            Minang dikatakan sebagai baituah. Setiap daerah memiliki
                            sebutannya sendiri, tapi jelas: indigo ada.
                        </p>
                        <p style="text-align: justify !important;">
                            Inilah mengapa frasa INDIGO dipilih sebagai tema utama dalam
                            perhelatan Festival Film Horor II tahun 2026. Dalam konteks
                            Indonesia, INDIGO merupakan frasa/istilah yang merujuk untuk
                            menyebut entitas manusia memiliki kepekaan lebih mengenai
                            hal-hal yang bersifat supranatural. Pandangan ini menjadi upaya
                            kami untuk membaca ulang istilah INDIGO supaya tidak berhenti
                            hanya dengan kepekaan dalam melihat hantu yang menakutkan atau
                            menakut-nakuti, akan tetapi bisa juga membuka sudut pandang
                            lain, yaitu dengan kepekaan merasakan dan mengalami hal-hal
                            supranatural atau spiritual dalam berbagai perspektif.
                        </p>
                        <p style="text-align: justify !important;">
                            Festival Film Horor 2026 mencoba menjadi titik temu antara
                            budaya, spiritualitas, dan psikologi untuk menjembatani gesekan
                            antara pengetahuan tradisional berbasis pengalaman dengan
                            pengetahuan modern yang menuntut pembuktian rasional, sehingga
                            pemahamannya tak dapat dilepaskan dari sejarah budaya masyarakat
                            Indonesia dalam membaca yang tak terlihat, merawat ingatan
                            terhadap dunia gaib, dan menegosiasikan ulang makna "kemampuan
                            melihat" di tengah perubahan zaman.
                        </p>
                    </div>

                    <!-- subtle decorative line + hint of purple glow (consistent) -->
                    <div
                        class="mt-10 pt-6 border-t border-purple-500/20 flex justify-start items-center gap-3 text-sm text-purple-300">
                        <i class="fas fa-eye text-purple-400"></i>
                        <span class="tracking-wide">KOMPETISI FILM · WORKSHOP · FILM SCREENING · PAGELARAN BUDAYA · PASAR HANTU · PLESIR KIDUL · HOROR IMMERSIVE EXPERIENCE</span>
                        <div class="flex-1"></div>
                        <i class="fas fa-ghost text-purple-400/60"></i>
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.landing.timeline-kompetisi-film')
        @include('layouts.landing.kompetisi-film')

        @else
        <!-- SECTION: PROGRAM HIGHLIGHT -->
        <section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28">

            <div class="fade-up">
                <p class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    APA YANG KAMI TAWARKAN
                </p>
                <h2 class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    Program Highlight
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12 fade-up">

                <!-- Card 1: Kompetisi -->
                <div class="group glass-card-light rounded-2xl p-6 flex flex-col items-center text-center gap-4 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(109,40,217,0.2)] hover:border-purple-500/50">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-2xl transition-transform duration-300 group-hover:scale-110">
                        🏆
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg mb-2 group-hover:text-purple-300 transition-colors duration-300">
                            Kompetisi
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Ruang Apresiasi dan Kurasi Karya Film
                        </p>
                    </div>
                    <a href="/program"
                        class="mt-auto w-full py-2 rounded-xl border border-purple-500/40 bg-purple-500/10 text-purple-400 text-sm font-semibold hover:bg-purple-500/25 transition-colors duration-200 inline-flex items-center justify-center gap-2">
                        Lihat Detail
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>

                <!-- Card 2: Edukasi -->
                <div class="group glass-card-light rounded-2xl p-6 flex flex-col items-center text-center gap-4 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(109,40,217,0.2)] hover:border-purple-500/50">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-2xl transition-transform duration-300 group-hover:scale-110">
                        📚
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg mb-2 group-hover:text-purple-300 transition-colors duration-300">
                            Edukasi
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Workshop, Diskusi, dan Pengembangan Talenta
                        </p>
                    </div>
                    <a href="/program"
                        class="mt-auto w-full py-2 rounded-xl border border-purple-500/40 bg-purple-500/10 text-purple-400 text-sm font-semibold hover:bg-purple-500/25 transition-colors duration-200 inline-flex items-center justify-center gap-2">
                        Lihat Detail
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- Card 3: Eksperiens -->
                <div class="group glass-card-light rounded-2xl p-6 flex flex-col items-center text-center gap-4 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(109,40,217,0.2)] hover:border-purple-500/50">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-2xl transition-transform duration-300 group-hover:scale-110">
                        🎭
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg mb-2 group-hover:text-purple-300 transition-colors duration-300">
                            Eksperiens
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Pengalaman Imersif Berbasis Budaya & Ruang
                        </p>
                    </div>
                    <a href="/program"
                        class="mt-auto w-full py-2 rounded-xl border border-purple-500/40 bg-purple-500/10 text-purple-400 text-sm font-semibold hover:bg-purple-500/25 transition-colors duration-200 inline-flex items-center justify-center gap-2">
                        Lihat Detail
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- Card 4: Ekosistem -->
                <div class="group glass-card-light rounded-2xl p-6 flex flex-col items-center text-center gap-4 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(109,40,217,0.2)] hover:border-purple-500/50">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-2xl transition-transform duration-300 group-hover:scale-110">
                        🌐
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg mb-2 group-hover:text-purple-300 transition-colors duration-300">
                            Ekosistem
                        </h3>
                        <p class="text-gray-400 text-sm leading-relaxed">
                            Kolaborasi, Jaringan, dan Keberlanjutan Industri
                        </p>
                    </div>
                    <a href="/program"
                        class="mt-auto w-full py-2 rounded-xl border border-purple-500/40 bg-purple-500/10 text-purple-400 text-sm font-semibold hover:bg-purple-500/25 transition-colors duration-200 inline-flex items-center justify-center gap-2">
                        Lihat Detail
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>

            </div>
        </section>
        @endif
        @endif

        <!-- ================================================== -->
        <!-- SECTION: OFFICIAL MERCHANDISE -->
        <!-- ================================================== -->
        @include('landing.partials.home-merchandise-section', ['featuredMerchandises' => $featuredMerchandises])

        <!-- ================================================== -->
        <!-- SECTION: WISATA PACITAN (Pacitan Tourism) -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 tourism-section">
            <!-- Header Section dengan fade-up -->
            <div class="fade-up">
                <p
                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    PACITAN TOURISM
                </p>
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    Wisata Pacitan
                </h2>
            </div>

            <!-- Glassmorphism Container Utama -->
            <div
                class="glass-card mt-12 rounded-3xl p-6 md:p-8 lg:p-10 fade-up transition-all duration-500 hover:shadow-[0_0_30px_rgba(109,40,217,0.2)]">
                <!-- Grid Wisata: 3x2 desktop, 2 tablet, 1 mobile -->
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
                    <!-- CARD 1: Wisata Pacitan 1 -->
                    <div class="group tourism-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9]">
                            <div
                                class="relative w-full aspect-[4/3] overflow-hidden bg-gradient-to-br from-purple-900/30 to-black/50">
                                <img
                                    src="{{ asset('landing/images/wisata/wisata1.jpg') }}"
                                    alt="Wisata Pacitan"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/800x600/2D1B69/8B5CF6?text=PACITAN+1&font=montserrat';
                    " />
                                <!-- Overlay gelap tipis untuk nuansa horror festival -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20 opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                                <!-- Efek glow subtle pada sudut -->
                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-gradient-to-tr from-purple-600/20 via-transparent to-fuchsia-600/20"></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: Wisata Pacitan 2 -->
                    <div class="group tourism-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9]">
                            <div
                                class="relative w-full aspect-[4/3] overflow-hidden bg-gradient-to-br from-purple-900/30 to-black/50">
                                <img
                                    src="{{ asset('landing/images/wisata/wisata2.jpg') }}"
                                    alt="Wisata Pacitan"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/800x600/2D1B69/8B5CF6?text=PACITAN+2&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20 opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-gradient-to-tr from-purple-600/20 via-transparent to-fuchsia-600/20"></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: Wisata Pacitan 3 -->
                    <div class="group tourism-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9]">
                            <div
                                class="relative w-full aspect-[4/3] overflow-hidden bg-gradient-to-br from-purple-900/30 to-black/50">
                                <img
                                    src="{{ asset('landing/images/wisata/wisata3.jpg') }}"
                                    alt="Wisata Pacitan"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/800x600/2D1B69/8B5CF6?text=PACITAN+3&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20 opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-gradient-to-tr from-purple-600/20 via-transparent to-fuchsia-600/20"></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 4: Wisata Pacitan 4 -->
                    <div class="group tourism-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9]">
                            <div
                                class="relative w-full aspect-[4/3] overflow-hidden bg-gradient-to-br from-purple-900/30 to-black/50">
                                <img
                                    src="{{ asset('landing/images/wisata/wisata4.jpg') }}"
                                    alt="Wisata Pacitan"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/800x600/2D1B69/8B5CF6?text=PACITAN+4&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20 opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-gradient-to-tr from-purple-600/20 via-transparent to-fuchsia-600/20"></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 5: Wisata Pacitan 5 -->
                    <div class="group tourism-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9]">
                            <div
                                class="relative w-full aspect-[4/3] overflow-hidden bg-gradient-to-br from-purple-900/30 to-black/50">
                                <img
                                    src="{{ asset('landing/images/wisata/wisata5.jpg') }}"
                                    alt="Wisata Pacitan"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/800x600/2D1B69/8B5CF6?text=PACITAN+5&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20 opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-gradient-to-tr from-purple-600/20 via-transparent to-fuchsia-600/20"></div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 6: Wisata Pacitan 6 -->
                    <div class="group tourism-card transition-all duration-500">
                        <div
                            class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9]">
                            <div
                                class="relative w-full aspect-[4/3] overflow-hidden bg-gradient-to-br from-purple-900/30 to-black/50">
                                <img
                                    src="{{ asset('landing/images/wisata/wisata6.jpg') }}"
                                    alt="Wisata Pacitan"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    onerror="
                      this.onerror = null;
                      this.src =
                        'https://placehold.co/800x600/2D1B69/8B5CF6?text=PACITAN+6&font=montserrat';
                    " />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/20 opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-gradient-to-tr from-purple-600/20 via-transparent to-fuchsia-600/20"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Garis Pemisah + CTA Tombol -->
                {{-- <div class="mt-12 pt-10 border-t border-purple-500/20">

                        <div class="text-center">
                        <!-- Tombol Jelajahi Pacitan -->
                        <button
                            class="btn-gradient px-8 md:px-12 py-3 md:py-4 rounded-full text-white font-semibold text-base md:text-lg transition-all duration-300 hover:scale-105 hover:shadow-[0_0_25px_#8B5CF6] inline-flex items-center gap-3 group">
                            <i
                                class="fas fa-compass text-white group-hover:rotate-12 transition-transform duration-300"></i>
                            Jelajahi Pacitan
                            <i
                                class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform duration-300"></i>
                        </button>

                        <!-- Subtle text -->
                        <p class="text-gray-500 text-xs mt-5">
                            *Destinasi wisata alam dan budaya di Pacitan, Jawa Timur
                        </p>
                    </div>
                </div>--}}
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: CTA REGISTRASI FESTIVAL -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 cta-registration-section">
            <!-- Glassmorphism Container Utama -->
            <div
                class="glass-card rounded-3xl p-6 md:p-8 lg:p-12 fade-up transition-all duration-500 hover:shadow-[0_0_35px_rgba(109,40,217,0.3)]">
                <!-- Layout 2 kolom: Desktop 65% - 35%, Mobile 1 kolom -->
                <div
                    class="flex flex-col lg:flex-row gap-8 lg:gap-12 items-center lg:items-stretch">
                    <!-- KONTEN KIRI (65%) -->
                    <div class="lg:w-[65%] w-full space-y-4 text-center lg:text-left">
                        <!-- Subjudul kecil -->
                        <p
                            class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold">
                            FESTIVAL EXPERIENCE
                        </p>

                        <!-- Judul besar dengan glow tipis -->
                        <h2
                            class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight [text-shadow:0_0_15px_rgba(139,92,246,0.3)]">
                            Ayo ke
                            <span
                                class="bg-gradient-to-r from-purple-400 to-fuchsia-400 bg-clip-text text-transparent">Pacitan!</span>
                        </h2>

                        <!-- Deskripsi -->
                        <p
                            class="text-gray-300 text-base md:text-lg leading-relaxed max-w-xl lg:max-w-none">
                            Jelajahi keindahan alam Pacitan, nikmati pemutaran film horor
                            terbaik Indonesia, ikuti program INDIGO, dan rasakan pengalaman
                            festival yang tak terlupakan di Festival Film Horor 2026.
                        </p>

                        <!-- Dekorasi garis ungu tipis -->
                        <div
                            class="w-20 h-[2px] bg-gradient-to-r from-purple-500 to-transparent mx-auto lg:mx-0 mt-4"></div>
                    </div>

                    <!-- KONTEN KANAN (35%) - Area Tombol dengan efek lock -->
                    <div
                        class="lg:w-[35%] w-full flex flex-col items-center justify-center">
                        <!-- Container Tombol dengan posisi relatif untuk tooltip -->
                        <div class="relative inline-block group">
                            <!-- Tooltip yang muncul saat hover -->
                            {{--
                                <div
                                class="tooltip-text absolute -top-12 left-1/2 transform -translate-x-1/2 px-3 py-1.5 bg-purple-900/90 backdrop-blur-md rounded-lg text-xs text-purple-200 whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 pointer-events-none border border-purple-500/30 shadow-lg">
                                🔒 Registrasi dibuka 8 Juni 2026
                                <div
                                    class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-purple-900/90 rotate-45 border-r border-b border-purple-500/30"></div>
                            </div> --}}

                            <!-- Tombol Registrasi dengan efek hover lock -->
                            <button
                                class="registration-btn group relative btn-gradient px-8 md:px-10 py-4 md:py-5 rounded-full text-white font-bold text-base md:text-lg transition-all duration-300 hover:scale-105 hover:shadow-[0_0_30px_#8B5CF6] inline-flex items-center gap-3 overflow-hidden cursor-pointer">
                                <!-- Icon normal: ticket -->
                                <i
                                    class="fas fa-ticket-alt text-white group-hover:hidden transition-all duration-300"></i>
                                <!-- Icon hover: lock -->
                                <i
                                    class="fas fa-lock hidden group-hover:inline-block text-white transition-all duration-300"></i>
                                <span class="font-semibold tracking-wide">Coming Soon</span>
                            </button>
                        </div>

                        <!-- Footer kecil di bawah tombol -->
                        <!-- <p class="text-gray-500 text-xs mt-6 text-center">
                            Pendaftaran akan dibuka sesuai jadwal timeline kompetisi.
                        </p> -->
                    </div>
                </div>
            </div>
        </section>

        <!-- ================================================== -->
        <!-- SECTION: OUR COLLABORATOR -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 sponsor-section">
            <!-- Header Section -->
            <div class="fade-up">
                <p
                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    OFFICIAL COLLABORATOR
                </p>
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    Our Collaborator
                </h2>
            </div>

            <div class="glass-card mt-12 rounded-3xl p-6 md:p-8 lg:p-10 fade-up transition-all duration-500 hover:shadow-[0_0_35px_rgba(109,40,217,0.2)]">

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 md:gap-8 items-center justify-items-center">

                    <div class="w-full flex justify-center p-2">
                        <img
                            src="{{ asset('landing/images/collab/col1.png') }}"
                            alt="Sponsor 1"
                            class="max-h-30 w-auto object-contain filter brightness-100 opacity-90 hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="w-full flex justify-center p-2">
                        <img
                            src="{{ asset('landing/images/collab/col2.png') }}"
                            alt="Sponsor 2"
                            class="max-h-30 w-auto object-contain filter brightness-100 opacity-90 hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="w-full flex justify-center p-2">
                        <img
                            src="{{ asset('landing/images/collab/col3.png') }}"
                            alt="Sponsor 3"
                            class="max-h-30 w-auto object-contain filter brightness-100 opacity-90 hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="w-full flex justify-center p-2">
                        <img
                            src="{{ asset('landing/images/collab/col4.png') }}"
                            alt="Sponsor 4"
                            class="max-h-30 w-auto object-contain filter brightness-100 opacity-90 hover:opacity-100 transition-opacity duration-300">
                    </div>

                    <div class="w-full flex justify-center p-2">
                        <img
                            src="{{ asset('landing/images/collab/col5.png') }}"
                            alt="Sponsor 5"
                            class="max-h-30 w-auto object-contain filter brightness-100 opacity-90 hover:opacity-100 transition-opacity duration-300">
                    </div>

                </div>

            </div>
        </section>


        <!-- ================================================== -->
        <!-- SECTION: SPONSOR & PARTNER - PERFECT INFINITE MARQUEE V3 -->
        <!-- ================================================== -->
        <section
            class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 sponsor-section">
            <!-- Header Section -->
            <div class="fade-up">
                <p
                    class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                    OFFICIAL PARTNERS
                </p>
                <h2
                    class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                    Sponsor & Partner
                </h2>
            </div>

            <!-- Glassmorphism Container Utama -->
            <div
                class="glass-card mt-12 rounded-3xl p-6 md:p-8 lg:p-10 fade-up transition-all duration-500 hover:shadow-[0_0_35px_rgba(109,40,217,0.2)]">
                <!-- BARIS 1: Slider ke Kanan -->
                <div class="mb-8 md:mb-12">
                    <div
                        class="marquee-wrapper relative w-full overflow-hidden rounded-2xl">
                        <div
                            class="absolute left-0 top-0 bottom-0 w-12 md:w-20 z-10 pointer-events-none bg-gradient-to-r from-[#0f0f23] to-transparent rounded-l-2xl"></div>
                        <div
                            class="absolute right-0 top-0 bottom-0 w-12 md:w-20 z-10 pointer-events-none bg-gradient-to-l from-[#0f0f23] to-transparent rounded-r-2xl"></div>

                        <div
                            class="marquee-container cursor-grab active:cursor-grabbing"
                            id="marqueeRightContainer">
                            <div class="marquee-track" id="marqueeRightTrack"></div>
                        </div>
                    </div>
                </div>

                <!-- BARIS 2: Slider ke Kiri -->
                <div class="mt-8 md:mt-12">
                    <div
                        class="marquee-wrapper relative w-full overflow-hidden rounded-2xl">
                        <div
                            class="absolute left-0 top-0 bottom-0 w-12 md:w-20 z-10 pointer-events-none bg-gradient-to-r from-[#0f0f23] to-transparent rounded-l-2xl"></div>
                        <div
                            class="absolute right-0 top-0 bottom-0 w-12 md:w-20 z-10 pointer-events-none bg-gradient-to-l from-[#0f0f23] to-transparent rounded-r-2xl"></div>

                        <div
                            class="marquee-container cursor-grab active:cursor-grabbing"
                            id="marqueeLeftContainer">
                            <div class="marquee-track" id="marqueeLeftTrack"></div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-12 pt-8 border-t border-purple-500/20 text-center">
                    <p class="text-gray-400 text-sm tracking-wide">
                        Supported by amazing partners, institutions, and creative
                        communities.
                    </p>
                </div>
            </div>
        </section>

        @include('layouts.landing.footer')
    </main>
@endsection
