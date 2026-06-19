@extends('layouts.landing.master')

@section('main')
@php
    $landingSetting = $activeLandingSetting ?? $setting ?? null;
@endphp

<main class="relative z-10">
    <section
        id="program"
        class="relative min-h-[90vh] flex items-center justify-center px-6 py-20 overflow-hidden bg-cover bg-center"
        style="background-image: url({{ $landingSetting ? $landingSetting->mediaUrl($landingSetting->hero_image, 'landing/images/BACKGROUND FFH 2026.png') : asset('landing/images/BACKGROUND FFH 2026.png') }});">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 premium-glow opacity-40"></div>
        <div class="bg-glow-abstract"></div>
        <div class="relative max-w-6xl w-full mx-auto fade-up">
            <div class="glass-card p-8 md:p-12 lg:p-16 text-center shadow-2xl border border-purple-400/30">
                <div class="space-y-6 md:space-y-8">
                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter leading-[1.1] bg-gradient-to-r from-white via-purple-200 to-purple-300 bg-clip-text text-transparent drop-shadow-2xl">
                        KOMPETISI FILM
                    </h1>
                    <p class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                        Timeline, kategori, dan tim penilai diambil langsung dari data periode submission dan user role yang aktif.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.landing.timeline-kompetisi-film', ['timelineItems' => $timelineItems])
    @include('layouts.landing.kompetisi-film', ['competitionCategories' => $competitionCategories])

    <section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28">
        <div class="fade-up">
            <h2 class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 mb-16 tracking-tight">
                Juri
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            @forelse($juryMembers as $jury)
            <div class="board-card glass-card-light rounded-2xl overflow-hidden transition-all text-center duration-300 group">
                <div class="overflow-hidden relative">
                    <img
                        src="{{ asset('landing/images/user.png') }}"
                        alt="{{ $jury->name }}"
                        class="w-full h-120 object-cover transition duration-500 group-hover:scale-110" />
                    <div class="absolute top-4 right-4 bg-purple-600/80 backdrop-blur-sm px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider">
                        {{ $jury->category->name ?? 'Lintas Kategori' }}
                    </div>
                </div>
                <div class="p-6 space-y-3">
                    <h3 class="text-2xl font-bold tracking-tight text-white">
                        {{ strtoupper($jury->name) }}
                    </h3>
                    <p class="text-purple-300 text-sm uppercase tracking-wider font-semibold">
                        {{ $jury->category->name ?? 'Juri Festival' }}
                    </p>
                </div>
            </div>
            @empty
            <div class="lg:col-span-3 glass-card-light rounded-2xl p-8 text-center text-gray-400">
                User dengan role juri belum tersedia.
            </div>
            @endforelse
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28">
        <div class="fade-up">
            <p class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                PROGRAM HIGHLIGHT
            </p>
            <h2 class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                Ruang Festival
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12 fade-up">
            @foreach([
                ['icon' => '🏆', 'title' => 'Kompetisi', 'description' => 'Ruang apresiasi dan kurasi karya film dari seluruh kategori yang dibuka admin.'],
                ['icon' => '📚', 'title' => 'Edukasi', 'description' => 'Workshop, diskusi, dan pertukaran praktik baik untuk peserta serta komunitas.'],
                ['icon' => '🎭', 'title' => 'Eksperiens', 'description' => 'Program pemutaran dan pengalaman tematik yang menautkan film dengan ruang budaya.'],
                ['icon' => '🌐', 'title' => 'Ekosistem', 'description' => 'Kolaborasi antara sineas, kurator, juri, komunitas, dan publik festival.'],
            ] as $highlight)
            <div class="group glass-card-light rounded-2xl p-6 flex flex-col items-center text-center gap-4 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(109,40,217,0.2)] hover:border-purple-500/50">
                <div class="w-14 h-14 rounded-2xl bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-2xl transition-transform duration-300 group-hover:scale-110">
                    {{ $highlight['icon'] }}
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-2 group-hover:text-purple-300 transition-colors duration-300">
                        {{ $highlight['title'] }}
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        {{ $highlight['description'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 faq-section">
        <div class="fade-up">
            <p class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                PERTANYAAN UMUM
            </p>
            <h2 class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
                FAQ
            </h2>
        </div>

        <div class="glass-card mt-8 rounded-3xl p-6 md:p-8 fade-up transition-all duration-500 hover:shadow-[0_0_30px_rgba(109,40,217,0.2)]">
            <div class="max-w-3xl">
                <p class="text-gray-300 leading-relaxed text-base md:text-lg">
                    Admin membuka periode submission, peserta mendaftar sesuai kategori, kurator memfilter karya, lalu juri memberikan nilai dan menentukan pemenang. Semua data inti program sekarang ditarik dari database agar lebih mudah dikelola dari panel admin.
                </p>
            </div>
        </div>
    </section>
</main>
@endsection
