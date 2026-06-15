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