@php
    $collaboratorLogos = [
        'landing/images/collab/col1.png',
        'landing/images/collab/col2.png',
        'landing/images/collab/col3.png',
        'landing/images/collab/col4.png',
        'landing/images/collab/col5.png',
    ];

    $partnerLogos = [
        'landing/images/sponsor/ANEKA HARAPAN.png',
        'landing/images/sponsor/Alifa Cake & Bakery.png',
        'landing/images/sponsor/Bonteh.png',
        'landing/images/sponsor/Dagelan Pacitan.png',
        'landing/images/sponsor/Dewan Kesenian Pacitan.png',
        'landing/images/sponsor/Dopamin.png',
        'landing/images/sponsor/Fhillbrew.png',
        'landing/images/sponsor/Horizontal Hotel.png',
        'landing/images/sponsor/Info Cegatan Pacitan.png',
        'landing/images/sponsor/Info Festival.png',
        'landing/images/sponsor/Info event jatim.png',
        'landing/images/sponsor/Info pacitan.png',
        'landing/images/sponsor/KNPI.png',
        'landing/images/sponsor/Karang Taruna.png',
        'landing/images/sponsor/Kojuwa.png',
        'landing/images/sponsor/Lentera Digital Nusantara.png',
        'landing/images/sponsor/MYPACITAN.png',
        'landing/images/sponsor/PKK.png',
        'landing/images/sponsor/Pacitanku.png',
        'landing/images/sponsor/Sampono Perfumes.png',
        'landing/images/sponsor/Warung makan Karmila.png',
    ];
@endphp

<section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 sponsor-section">
    <div class="fade-up">
        <p class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
            OFFICIAL COLLABORATOR
        </p>
        <h2 class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
            Our Collaborator
        </h2>
    </div>

    <div class="glass-card mt-12 rounded-3xl p-6 md:p-8 lg:p-10 fade-up transition-all duration-500 hover:shadow-[0_0_35px_rgba(109,40,217,0.2)]">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 md:gap-8 items-center justify-items-center">
            @foreach($collaboratorLogos as $logo)
            <div class="w-full flex justify-center p-2">
                <img
                    src="{{ asset($logo) }}"
                    alt="Collaborator Logo"
                    class="max-h-30 w-auto object-contain filter brightness-100 opacity-90 hover:opacity-100 transition-opacity duration-300">
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 md:px-10 py-24 md:py-28 sponsor-section">
    <div class="fade-up">
        <p class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
            OFFICIAL PARTNERS
        </p>
        <h2 class="text-3xl md:text-5xl font-bold text-left border-l-8 border-purple-500 pl-6 tracking-tight">
            Sponsor & Partner
        </h2>
    </div>

    <div class="glass-card mt-12 rounded-3xl p-6 md:p-8 lg:p-10 fade-up transition-all duration-500 hover:shadow-[0_0_35px_rgba(109,40,217,0.2)]">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8 items-center justify-items-center">
            @foreach($partnerLogos as $logo)
            <div class="w-full flex justify-center p-3 rounded-2xl bg-white/5 border border-white/5">
                <img
                    src="{{ asset($logo) }}"
                    alt="Partner Logo"
                    class="max-h-24 w-auto object-contain filter brightness-100 opacity-90 hover:opacity-100 transition-opacity duration-300">
            </div>
            @endforeach
        </div>

        <div class="mt-12 pt-8 border-t border-purple-500/20 text-center">
            <p class="text-gray-400 text-sm tracking-wide">
                Supported by amazing partners, institutions, and creative communities.
            </p>
        </div>
    </div>
</section>
