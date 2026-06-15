<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Festival Film Horor 2026</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <!-- Tailwind CSS v4 -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <!-- Font Awesome Icons (untuk sentuhan premium) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- Google Fonts: Inter & Space Grotesk untuk nuansa cinematic -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}" />

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        /* Select2 dark theme override */
        .select2-container--default .select2-selection--single {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(139, 92, 246, 0.25);
            border-radius: 12px;
            height: 42px;
            display: flex;
            align-items: center;
            padding: 0 14px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #f1f0ff;
            font-size: 14px;
            line-height: normal;
            padding: 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6b7280;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px;
            right: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #7c3aed transparent transparent transparent;
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #7c3aed transparent;
        }

        .select2-dropdown {
            background: #1a0a2e;
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 12px;
            overflow: hidden;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(139, 92, 246, 0.25);
            border-radius: 8px;
            color: #f1f0ff;
            padding: 6px 10px;
            outline: none;
        }

        .select2-container--default .select2-results__option {
            color: #d1d5db;
            font-size: 13px;
            padding: 8px 14px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: rgba(139, 92, 246, 0.25);
            color: #f1f0ff;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background: rgba(139, 92, 246, 0.15);
            color: #a78bfa;
        }

        .select2-container {
            width: 100% !important;
        }

        .field-group {
            margin-bottom: 20px;
        }

        .field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #c4b5fd;
            margin-bottom: 6px;
            letter-spacing: .3px;
        }

        .field-input {
            width: 100%;
            padding: 10px 14px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(139, 92, 246, 0.25);
            border-radius: 12px;
            color: #f1f0ff;
            font-size: 14px;
            outline: none;
            transition: border-color .2s, background .2s;
            box-sizing: border-box;
        }

        .field-input:focus {
            border-color: rgba(139, 92, 246, 0.6);
            background: rgba(255, 255, 255, 0.08);
        }

        .field-input::placeholder {
            color: #6b7280;
        }

        .field-input:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .field-input option {
            background: #1a0a2e;
            color: #f1f0ff;
        }

        .section-divider {
            font-size: 13px;
            font-weight: 700;
            color: #a78bfa;
            border-left: 3px solid #7c3aed;
            padding-left: 12px;
            margin: 24px 0 16px;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #7c3aed, #9333ea);
            border: none;
            border-radius: 14px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity .2s, transform .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            opacity: .88;
            transform: translateY(-1px);
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #7c3aed;
            font-size: 13px;
        }

        .input-icon-wrap .field-input {
            padding-left: 36px;
        }

        .error-msg {
            color: #f87171;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>
</head>

<body class="text-white overflow-x-hidden">
    <!-- ================================================== -->
    <!-- BACKGROUBD BG -->
    <!-- ================================================== -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute top-[-20%] left-[-10%] w-[60%] h-[60%] bg-purple-700/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 right-0 w-[70%] h-[50%] bg-violet-800/20 blur-[130px]"></div>
    </div>

    <!-- ================================================== -->
    <!-- NAVBAR STICKY dengan glassmorphism -->
    <!-- ================================================== -->
    <nav
        class="sticky top-0 z-50 w-full transition-all duration-300 backdrop-blur-xl bg-[#0f0f23]/70 border-b border-purple-500/20 shadow-md">
        <div class="max-w-7xl mx-auto px-6 md:px-10 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#home" class="flex items-center">
                <img src="{{ asset('landing/images/RUANG FILM - GREEN.png') }}" alt="Festival Ruang Film Horor 2026"
                    class="h-12 md:h-14 w-auto object-contain transition duration-300 hover:scale-105" />
            </a>
            <!-- Menu kanan (Desktop) -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="/" class="nav-link {{ request()->is('/') ? 'text-purple-300' : 'text-gray-200' }} font-semibold hover:text-purple-300 transition">Home</a>
                <a href="/program" class="nav-link {{ request()->is('program') ? 'text-purple-300' : 'text-gray-200' }} hover:text-purple-300 transition">Program</a>
                <a href="/merchandise" class="nav-link {{ request()->is('merchandise') ? 'text-purple-300' : 'text-gray-200' }} hover:text-purple-300 transition">Merchandise</a>
                {{-- Keranjang --}}
                <a href="#" class="relative text-gray-200 hover:text-purple-300 transition" title="Keranjang belanja">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    {{-- Badge jumlah item --}}
                    <span id="cart-count"
                        class="absolute -top-2 -right-2 bg-purple-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">
                        0
                    </span>
                </a>
                <a href="{{ route('login') }}"
                    class="btn-gradient px-5 py-2 rounded-full text-white text-sm font-semibold tracking-wide shadow-lg transition-all">Login</a>
            </div>
            <!-- Mobile menu icon + dropdown sederhana (responsive) -->
            <div class="md:hidden flex items-center gap-4">
                {{-- Keranjang mobile --}}
                <a href="#" class="relative text-gray-200 hover:text-purple-300 transition" title="Keranjang">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span id="cart-count-mobile"
                        class="absolute -top-2 -right-2 bg-purple-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">
                        0
                    </span>
                </a>
                <button id="mobile-menu-btn" class="text-purple-300 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <!-- Mobile dropdown menu (hidden by default) -->
        <div id="mobile-menu"
            class="md:hidden hidden flex-col bg-[#0f0f23]/90 backdrop-blur-xl border-t border-purple-500/20 px-6 pb-5 space-y-4 text-base font-medium">
            <a href="/" class="nav-link block py-2 text-gray-200 hover:text-purple-300">Home</a>
            <a href="/program" class="nav-link block py-2 text-gray-200 hover:text-purple-300">Program</a>
            <a href="#" class="nav-link block py-2 text-gray-200 hover:text-purple-300">Merchandise</a>
            <a href="{{ route('login') }}"
                class="btn-gradient inline-block text-center px-4 py-2 rounded-full text-white font-semibold">Login</a>
        </div>
    </nav>

    @yield('main')
    <!-- Custom JS -->
    <script src="{{ asset('landing/js/script.js') }}"></script>
    <!-- Vanilla JavaScript: Smooth Scroll, Mobile Menu, Intersection Observer (fade-up) -->
    <script src="{{ asset('landing/js/vanila1.js') }}"></script>
    <!-- Footer -->
    <script src="{{ asset('landing/js/footer.js') }}"></script>
    <!-- Select2 -->
    <script>
        // Init Select2
        function initSelect2(selector, placeholder) {
            $(selector).select2({
                placeholder: placeholder,
                allowClear: true,
                dropdownParent: $('body')
            });
        }

        $(document).ready(function() {
            initSelect2('#provinsi', 'Pilih Provinsi');
            initSelect2('#kabupaten', 'Pilih Kabupaten/Kota');
            initSelect2('#kecamatan', 'Pilih Kecamatan');
            initSelect2('#desa', 'Pilih Desa/Kelurahan');

            // Auto-load jika ada old value
            const oldProv = "{{ old('provinsi_code') }}";
            const oldKab = "{{ old('kabupaten_code') }}";
            if (oldProv) loadKabupaten(oldProv, oldKab || null);
        });

        function loadKabupaten(provCode, selectedCode = null) {
            fetch('/api/wilayah/kabupaten/' + provCode)
                .then(res => res.json())
                .then(data => {
                    $('#kabupaten').empty().append('<option value="">Pilih Kabupaten/Kota</option>');
                    data.forEach(item => {
                        const selected = selectedCode && item.code == selectedCode ? 'selected' : '';
                        $('#kabupaten').append('<option value="' + item.code + '" ' + selected + '>' + item.name + '</option>');
                    });
                    $('#kabupaten').trigger('change.select2');
                    if (selectedCode) $('#kabupaten').trigger('change');
                });
        }

        function loadKecamatan(kabCode, selectedCode = null) {
            fetch('/api/wilayah/kecamatan/' + kabCode)
                .then(res => res.json())
                .then(data => {
                    $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
                    data.forEach(item => {
                        const selected = selectedCode && item.code == selectedCode ? 'selected' : '';
                        $('#kecamatan').append('<option value="' + item.code + '" ' + selected + '>' + item.name + '</option>');
                    });
                    $('#kecamatan').trigger('change.select2');
                    if (selectedCode) $('#kecamatan').trigger('change');
                });
        }

        function loadDesa(kecCode, selectedCode = null) {
            fetch('/api/wilayah/desa/' + kecCode)
                .then(res => res.json())
                .then(data => {
                    $('#desa').empty().append('<option value="">Pilih Desa/Kelurahan</option>');
                    data.forEach(item => {
                        const selected = selectedCode && item.code == selectedCode ? 'selected' : '';
                        $('#desa').append('<option value="' + item.code + '" ' + selected + '>' + item.name + '</option>');
                    });
                    $('#desa').trigger('change.select2');
                });
        }

        $('#provinsi').on('change', function() {
            const code = $(this).val();
            const name = $(this).find('option:selected').data('name');
            $('#provinsi_name').val(name || '');
            $('#kabupaten').empty().append('<option value="">Pilih Kabupaten/Kota</option>').trigger('change.select2');
            $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>').trigger('change.select2');
            $('#desa').empty().append('<option value="">Pilih Desa/Kelurahan</option>').trigger('change.select2');
            if (!code) return;
            loadKabupaten(code, null);
        });

        $('#kabupaten').on('change', function() {
            const code = $(this).val();
            $('#kabupaten_name').val($(this).find('option:selected').text());
            $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>').trigger('change.select2');
            $('#desa').empty().append('<option value="">Pilih Desa/Kelurahan</option>').trigger('change.select2');
            if (!code) return;
            loadKecamatan(code, null);
        });

        $('#kecamatan').on('change', function() {
            const code = $(this).val();
            $('#kecamatan_name').val($(this).find('option:selected').text());
            $('#desa').empty().append('<option value="">Pilih Desa/Kelurahan</option>').trigger('change.select2');
            if (!code) return;
            loadDesa(code, null);
        });

        $('#desa').on('change', function() {
            $('#desa_name').val($(this).find('option:selected').text());
        });
    </script>

    @php
    $isBeforeOpen = $setting && now()->lessThan($setting->open_at);
    @endphp

    <script>
        @if($submissionOpen)
        const targetClose = new Date("{{ $setting->close_at->toIso8601String() }}").getTime();
        const timerClose = setInterval(function() {
            const diff = targetClose - new Date().getTime();
            if (diff <= 0) {
                clearInterval(timerClose);
                document.getElementById('countdown-close').innerHTML =
                    '<p class="text-yellow-400 text-sm">Submission telah ditutup. Silakan refresh halaman.</p>';
                return;
            }
            document.getElementById('cc-days').innerText = String(Math.floor(diff / 86400000)).padStart(2, '0');
            document.getElementById('cc-hours').innerText = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
            document.getElementById('cc-minutes').innerText = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            document.getElementById('cc-seconds').innerText = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
        }, 1000);

        @elseif($isBeforeOpen)
        const targetOpen = new Date("{{ $setting->open_at->toIso8601String() }}").getTime();
        const timerOpen = setInterval(function() {
            const diff = targetOpen - new Date().getTime();
            if (diff <= 0) {
                clearInterval(timerOpen);
                document.getElementById('countdown-open').innerHTML =
                    '<p class="text-green-400 text-sm">Submission sudah dibuka! Silakan refresh halaman.</p>';
                return;
            }
            document.getElementById('co-days').innerText = String(Math.floor(diff / 86400000)).padStart(2, '0');
            document.getElementById('co-hours').innerText = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
            document.getElementById('co-minutes').innerText = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            document.getElementById('co-seconds').innerText = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
        }, 1000);
        @endif
    </script>
    <script>
        let cartCount = 0;

        document.querySelectorAll('.btn-cart').forEach(function(btn) {
            btn.addEventListener('click', function() {
                cartCount++;

                // Update badge desktop
                const badge = document.getElementById('cart-count');
                const badgeMobile = document.getElementById('cart-count-mobile');

                [badge, badgeMobile].forEach(function(el) {
                    if (el) {
                        el.textContent = cartCount;
                        el.classList.remove('hidden');
                    }
                });

                // Feedback visual tombol
                btn.innerHTML = '<i class="fas fa-check text-sm"></i>';
                btn.classList.add('bg-purple-500/40');
                setTimeout(function() {
                    btn.innerHTML = '<i class="fas fa-shopping-cart text-sm"></i>';
                    btn.classList.remove('bg-purple-500/40');
                }, 1000);
            });
        });
    </script>
</body>

</html>