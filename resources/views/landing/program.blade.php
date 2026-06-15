@extends('layouts.landing.master')
@section('main')
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

        @include('layouts.landing.timeline-kompetisi-film')
        @include('layouts.landing.kompetisi-film')

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

        @include('layouts.landing.footer')
    </main>
@endsection