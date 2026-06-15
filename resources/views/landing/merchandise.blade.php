<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Merchandise - Festival Ruang Film Horor 2026</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}" />
</head>

<body class="text-white overflow-x-hidden">

    {{-- Background --}}
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[60%] bg-purple-700/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 right-0 w-[70%] h-[50%] bg-violet-800/20 blur-[130px]"></div>
    </div>

    {{-- Navbar --}}
    <nav class="sticky top-0 z-50 w-full transition-all duration-300 backdrop-blur-xl bg-[#0f0f23]/70 border-b border-purple-500/20 shadow-md">
        <div class="max-w-7xl mx-auto px-6 md:px-10 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <img src="{{ asset('landing/images/RUANG FILM - GREEN.png') }}"
                    alt="Festival Ruang Film Horor 2026"
                    class="h-12 md:h-14 w-auto object-contain transition duration-300 hover:scale-105" />
            </a>
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="/" class="nav-link text-gray-200 hover:text-purple-300 transition">Home</a>
                <a href="/program" class="nav-link text-gray-200 hover:text-purple-300 transition">Program</a>
                <a href="#" class="nav-link text-purple-300 font-semibold transition">Merchandise</a>

                {{-- Keranjang --}}
                <a href="#" class="relative text-gray-200 hover:text-purple-300 transition" title="Keranjang belanja">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span id="cart-count"
                        class="absolute -top-2 -right-2 bg-purple-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">0</span>
                </a>

                <a href="{{ route('login') }}"
                    class="btn-gradient px-5 py-2 rounded-full text-white text-sm font-semibold tracking-wide shadow-lg transition-all">Login</a>
            </div>
            <div class="md:hidden flex items-center gap-4">
                <a href="#" class="relative text-gray-200 hover:text-purple-300 transition">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span id="cart-count-mobile"
                        class="absolute -top-2 -right-2 bg-purple-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">0</span>
                </a>
                <button id="mobile-menu-btn" class="text-purple-300 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div id="mobile-menu"
            class="md:hidden hidden flex-col bg-[#0f0f23]/90 backdrop-blur-xl border-t border-purple-500/20 px-6 pb-5 space-y-4 text-base font-medium">
            <a href="/" class="nav-link block py-2 text-gray-200 hover:text-purple-300">Home</a>
            <a href="/program" class="nav-link block py-2 text-gray-200 hover:text-purple-300">Program</a>
            <a href="#" class="nav-link block py-2 text-purple-300 font-semibold">Merchandise</a>
            <a href="{{ route('login') }}"
                class="btn-gradient inline-block text-center px-4 py-2 rounded-full text-white font-semibold">Login</a>
        </div>
    </nav>

    <main class="relative z-10">

        {{-- Hero kecil --}}
        <section class="max-w-7xl mx-auto px-6 md:px-10 pt-16 pb-8 fade-up">
            <div class="flex items-center gap-3 mb-2">
                <a href="/" class="text-gray-500 hover:text-purple-400 text-sm transition">Home</a>
                <span class="text-gray-600">/</span>
                <span class="text-purple-400 text-sm font-semibold">Merchandise</span>
            </div>
            <p class="text-purple-400 text-sm md:text-base uppercase tracking-wider font-semibold mb-2">
                OFFICIAL MERCHANDISE
            </p>
            <h1 class="text-3xl md:text-5xl font-bold border-l-8 border-purple-500 pl-6 tracking-tight">
                Semua Merchandise
            </h1>
            <p class="text-gray-400 text-sm md:text-base mt-4 pl-6 max-w-xl">
                Dapatkan merchandise eksklusif Festival Ruang Film Horor 2026. Stok terbatas, pesan sekarang!
            </p>
        </section>

        {{-- Filter & Search --}}
        <section class="max-w-7xl mx-auto px-6 md:px-10 py-6 fade-up">
            <div class="glass-card rounded-2xl p-4 md:p-6 flex flex-col sm:flex-row gap-4 items-center justify-between">
                {{-- Search --}}
                <div class="relative w-full sm:max-w-xs">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                    <input type="text" id="search-input"
                        placeholder="Cari merchandise..."
                        class="w-full pl-9 pr-4 py-2 rounded-xl bg-white/5 border border-purple-500/20 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-purple-500/50 transition">
                </div>

                {{-- Filter kategori --}}
                <div class="flex gap-2 flex-wrap justify-center">
                    <button data-filter="all"
                        class="filter-btn active px-4 py-2 rounded-full text-xs font-semibold border border-purple-500/40 bg-purple-500/20 text-purple-300 transition hover:bg-purple-500/30">
                        Semua
                    </button>
                    <button data-filter="apparel"
                        class="filter-btn px-4 py-2 rounded-full text-xs font-semibold border border-white/10 bg-white/5 text-gray-400 transition hover:border-purple-500/40 hover:text-purple-300">
                        Pakaian
                    </button>
                    <button data-filter="aksesoris"
                        class="filter-btn px-4 py-2 rounded-full text-xs font-semibold border border-white/10 bg-white/5 text-gray-400 transition hover:border-purple-500/40 hover:text-purple-300">
                        Aksesoris
                    </button>
                    <button data-filter="kolektibel"
                        class="filter-btn px-4 py-2 rounded-full text-xs font-semibold border border-white/10 bg-white/5 text-gray-400 transition hover:border-purple-500/40 hover:text-purple-300">
                        Kolektibel
                    </button>
                </div>

                {{-- Sort --}}
                <select id="sort-select"
                    class="px-4 py-2 rounded-xl bg-white/5 border border-purple-500/20 text-gray-300 text-sm focus:outline-none focus:border-purple-500/50 transition">
                    <option value="default">Urutkan</option>
                    <option value="price-asc">Harga: Terendah</option>
                    <option value="price-desc">Harga: Tertinggi</option>
                </select>
            </div>
        </section>

        {{-- Grid Merchandise --}}
        <section class="max-w-7xl mx-auto px-6 md:px-10 py-4 pb-28">
            <div id="merch-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 fade-up">

                {{-- CARD TEMPLATE — duplikasi sesuai produk --}}
                @php
                $products = [
                ['name' => 'Official Festival T-Shirt', 'price' => 120000, 'old_price' => 150000, 'img' => 'merchan1.jpg', 'badge' => 'LIMITED', 'category' => 'apparel'],
                ['name' => 'Horror Festival Hoodie', 'price' => 250000, 'old_price' => null, 'img' => 'merchan2.jpg', 'badge' => null, 'category' => 'apparel'],
                ['name' => 'Collector Tote Bag', 'price' => 85000, 'old_price' => null, 'img' => 'merchan3.jpg', 'badge' => 'NEW', 'category' => 'aksesoris'],
                ['name' => 'Festival Poster', 'price' => 50000, 'old_price' => null, 'img' => 'merchan1.jpg', 'badge' => null, 'category' => 'kolektibel'],
                ['name' => 'Enamel Pin Set', 'price' => 75000, 'old_price' => 90000, 'img' => 'merchan2.jpg', 'badge' => 'LIMITED', 'category' => 'kolektibel'],
                ['name' => 'Festival Lanyard', 'price' => 40000, 'old_price' => null, 'img' => 'merchan3.jpg', 'badge' => null, 'category' => 'aksesoris'],
                ];
                @endphp

                @foreach($products as $p)
                <div class="group merchandise-card transition-all duration-500"
                    data-category="{{ $p['category'] }}"
                    data-price="{{ $p['price'] }}"
                    data-name="{{ strtolower($p['name']) }}">
                    <div class="glass-card-light rounded-2xl overflow-hidden transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-2 group-hover:shadow-[0_0_25px_#6D28D9] h-full flex flex-col">

                        {{-- Gambar --}}
                        <div class="relative w-full overflow-hidden bg-gradient-to-br from-purple-900/30 to-black/50" style="height:200px;">
                            <img src="{{ asset('landing/images/merchan/' . $p['img']) }}"
                                alt="{{ $p['name'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                onerror="this.onerror=null;this.src='https://placehold.co/400x200/2D1B69/8B5CF6?text=MERCH&font=montserrat'">

                            @if($p['badge'])
                            <span class="absolute top-3 left-3 bg-purple-700 text-purple-100 text-[10px] font-semibold px-2 py-1 rounded-full tracking-wide">
                                {{ $p['badge'] }}
                            </span>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>

                        {{-- Info --}}
                        <div class="p-5 flex flex-col flex-grow gap-3">
                            <h3 class="text-base font-bold text-white group-hover:text-purple-300 transition-colors duration-300 leading-snug">
                                {{ $p['name'] }}
                            </h3>

                            <div class="flex items-baseline gap-2">
                                <span class="text-purple-400 text-lg font-bold">
                                    Rp {{ number_format($p['price'], 0, ',', '.') }}
                                </span>
                                @if($p['old_price'])
                                <span class="text-gray-500 text-sm line-through">
                                    Rp {{ number_format($p['old_price'], 0, ',', '.') }}
                                </span>
                                @endif
                            </div>

                            <div class="flex gap-2 mt-auto">
                                <button
                                    title="Tambah ke keranjang"
                                    class="btn-cart flex-none w-10 h-10 rounded-xl border border-purple-500/40 bg-purple-500/10 text-purple-400 hover:bg-purple-500/25 transition-colors duration-200 flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-sm"></i>
                                </button>
                                <a href="#"
                                    class="flex-1 h-10 rounded-xl bg-gradient-to-r from-purple-700 to-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2 hover:opacity-85 transition-opacity duration-200">
                                    <i class="fas fa-bolt text-xs"></i>
                                    Beli Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- Empty state --}}
            <div id="empty-state" class="hidden text-center py-20">
                <div class="text-5xl mb-4">🛍️</div>
                <p class="text-gray-400 text-lg">Tidak ada produk ditemukan.</p>
            </div>
        </section>

    </main>

    <script src="{{ asset('landing/js/script.js') }}"></script>
    <script src="{{ asset('landing/js/vanila1.js') }}"></script>
    <script src="{{ asset('landing/js/footer.js') }}"></script>

    <script>
        // ── Keranjang ──
        let cartCount = 0;
        document.querySelectorAll('.btn-cart').forEach(function(btn) {
            btn.addEventListener('click', function() {
                cartCount++;
                ['cart-count', 'cart-count-mobile'].forEach(function(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        el.textContent = cartCount;
                        el.classList.remove('hidden');
                    }
                });
                btn.innerHTML = '<i class="fas fa-check text-sm"></i>';
                btn.classList.add('bg-purple-500/40');
                setTimeout(function() {
                    btn.innerHTML = '<i class="fas fa-shopping-cart text-sm"></i>';
                    btn.classList.remove('bg-purple-500/40');
                }, 1000);
            });
        });

        // ── Filter kategori ──
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-purple-500/20', 'text-purple-300', 'border-purple-500/40');
                    b.classList.add('bg-white/5', 'text-gray-400', 'border-white/10');
                });
                this.classList.add('active', 'bg-purple-500/20', 'text-purple-300', 'border-purple-500/40');
                this.classList.remove('bg-white/5', 'text-gray-400', 'border-white/10');
                applyFilters();
            });
        });

        // ── Search ──
        document.getElementById('search-input').addEventListener('input', applyFilters);

        // ── Sort ──
        document.getElementById('sort-select').addEventListener('change', applyFilters);

        function applyFilters() {
            const activeFilter = document.querySelector('.filter-btn.active')?.dataset.filter || 'all';
            const searchVal = document.getElementById('search-input').value.toLowerCase();
            const sortVal = document.getElementById('sort-select').value;
            const cards = Array.from(document.querySelectorAll('.merchandise-card'));

            let visible = cards.filter(function(card) {
                const matchCat = activeFilter === 'all' || card.dataset.category === activeFilter;
                const matchSearch = card.dataset.name.includes(searchVal);
                card.style.display = (matchCat && matchSearch) ? '' : 'none';
                return matchCat && matchSearch;
            });

            // Sort
            const grid = document.getElementById('merch-grid');
            if (sortVal === 'price-asc') {
                visible.sort((a, b) => parseInt(a.dataset.price) - parseInt(b.dataset.price));
            } else if (sortVal === 'price-desc') {
                visible.sort((a, b) => parseInt(b.dataset.price) - parseInt(a.dataset.price));
            }
            visible.forEach(card => grid.appendChild(card));

            // Empty state
            document.getElementById('empty-state').classList.toggle('hidden', visible.length > 0);
        }
    </script>

</body>

</html>