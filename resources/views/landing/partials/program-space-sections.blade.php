@php
    $programSections = [
        [
            'title' => 'EDUKASI',
            'description' => 'Workshop, Diskusi, dan Pengembangan Talenta.',
        ],
        [
            'title' => 'EKSPERIENS',
            'description' => 'Pengalaman Imersif Berbasis Budaya & Ruang.',
        ],
        [
            'title' => 'EKOSISTEM',
            'description' => 'Kolaborasi, Jaringan, dan Keberlanjutan Industri.',
        ],
    ];

    $programSectionBackground = $landingSetting
        ? $landingSetting->mediaUrl($landingSetting->theme_image ?: $landingSetting->hero_image, 'landing/images/BACKGROUND FFH 2026.png')
        : asset('landing/images/BACKGROUND FFH 2026.png');
@endphp

@foreach($programSections as $programSection)
<section
    class="relative min-h-[90vh] flex items-center justify-center px-6 py-20 overflow-hidden bg-cover bg-center"
    style="background-image: url({{ $programSectionBackground }});">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="absolute inset-0 premium-glow opacity-40"></div>
    <div class="bg-glow-abstract"></div>

    <div class="relative max-w-6xl w-full mx-auto fade-up">
        <div class="glass-card p-8 md:p-12 lg:p-16 text-center shadow-2xl border border-purple-400/30">
            <div class="space-y-6 md:space-y-8">
                <h2 class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-tighter leading-[1.1] bg-gradient-to-r from-white via-purple-200 to-purple-300 bg-clip-text text-transparent drop-shadow-2xl">
                    {{ $programSection['title'] }}
                </h2>
                <p class="text-gray-300 text-base md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                    {{ $programSection['description'] }}
                </p>
            </div>
        </div>

        <div class="mt-10 flex justify-center">
            <button
                class="group w-14 h-14 rounded-full glass-card-light flex items-center justify-center border border-purple-500/30 cursor-default"
                aria-label="Lihat detail program {{ strtolower($programSection['title']) }}">
                <i class="fas fa-chevron-down text-purple-400 text-xl animate-bounce group-hover:text-purple-300 transition-all duration-300"></i>
            </button>
        </div>
    </div>
</section>
@endforeach
