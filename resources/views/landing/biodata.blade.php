<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Biodata Pembeli - Festival Ruang Film Horor 2026</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />
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
                <a href="{{ route('merchandise') }}" class="nav-link text-gray-200 hover:text-purple-300 transition">Merchandise</a>
                <a href="{{ route('login') }}"
                    class="btn-gradient px-5 py-2 rounded-full text-white text-sm font-semibold tracking-wide shadow-lg transition-all">Login</a>
            </div>
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-purple-300 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div id="mobile-menu"
            class="md:hidden hidden flex-col bg-[#0f0f23]/90 backdrop-blur-xl border-t border-purple-500/20 px-6 pb-5 space-y-4 text-base font-medium">
            <a href="/" class="block py-2 text-gray-200 hover:text-purple-300">Home</a>
            <a href="/program" class="block py-2 text-gray-200 hover:text-purple-300">Program</a>
            <a href="{{ route('merchandise') }}" class="block py-2 text-gray-200 hover:text-purple-300">Merchandise</a>
            <a href="{{ route('login') }}"
                class="btn-gradient inline-block text-center px-4 py-2 rounded-full text-white font-semibold">Login</a>
        </div>
    </nav>

    <main class="relative z-10">
        <section class="max-w-2xl mx-auto px-6 md:px-10 py-16 fade-up">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 mb-6 text-sm">
                <a href="/" class="text-gray-500 hover:text-purple-400 transition">Home</a>
                <span class="text-gray-600">/</span>
                <a href="{{ route('merchandise') }}" class="text-gray-500 hover:text-purple-400 transition">Merchandise</a>
                <span class="text-gray-600">/</span>
                <span class="text-purple-400 font-semibold">Biodata Pembeli</span>
            </div>

            {{-- Header --}}
            <div class="mb-8">
                <p class="text-purple-400 text-sm uppercase tracking-wider font-semibold mb-1">CHECKOUT</p>
                <h1 class="text-3xl md:text-4xl font-bold border-l-8 border-purple-500 pl-5 tracking-tight">
                    Biodata Pembeli
                </h1>
                <p class="text-gray-400 text-sm mt-3 pl-5">
                    Isi data dirimu dengan benar untuk keperluan pengiriman merchandise.
                </p>
            </div>

            {{-- Card Form --}}
            <div class="glass-card rounded-3xl p-6 md:p-8 transition-all duration-500 hover:shadow-[0_0_30px_rgba(109,40,217,0.15)]">

                @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 text-sm flex items-center gap-3">
                    <i class="fas fa-check-circle text-lg"></i>
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                    <div class="flex items-center gap-2 mb-2 font-semibold">
                        <i class="fas fa-exclamation-circle"></i> Terdapat kesalahan:
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- <form action="{{ route('biodata-pembeli.store') }}" method="POST"> --}}
                <form action="#" method="POST">
                    @csrf

                    {{-- Informasi Pribadi --}}
                    <div class="section-divider">Informasi Pribadi</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5">
                        <div class="field-group">
                            <label class="field-label">Nama Lengkap <span class="text-red-400">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-user"></i>
                                <input type="text" name="nama" class="field-input"
                                    placeholder="Nama Lengkap"
                                    value="{{ old('nama') }}" required>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label">Email <span class="text-red-400">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" class="field-input"
                                    placeholder="Email"
                                    value="{{ old('email') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Nomor WhatsApp <span class="text-red-400">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="fab fa-whatsapp"></i>
                            <input type="tel" name="no_whatsapp" class="field-input"
                                placeholder="cth: 08123456789"
                                value="{{ old('no_whatsapp') }}" required>
                        </div>
                        <p class="text-gray-500 text-xs mt-1">Nomor aktif untuk konfirmasi pesanan.</p>
                    </div>

                    {{-- Alamat Pengiriman --}}
                    <div class="section-divider">Alamat Pengiriman</div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5">
                        {{-- Provinsi --}}
                        <div class="field-group">
                            <label class="field-label">Provinsi <span class="text-red-400">*</span></label>
                            <select name="provinsi_code" id="provinsi" class="field-input" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinsi as $p)
                                <option value="{{ $p->code }}" data-name="{{ $p->name }}"
                                    {{ old('provinsi_code') == $p->code ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="provinsi_name" id="provinsi_name" value="{{ old('provinsi_name') }}">
                        </div>

                        {{-- Kabupaten --}}
                        <div class="field-group">
                            <label class="field-label">Kabupaten / Kota <span class="text-red-400">*</span></label>
                            <select name="kabupaten_code" id="kabupaten" class="field-input" required>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            <input type="hidden" name="kabupaten_name" id="kabupaten_name" value="{{ old('kabupaten_name') }}">
                        </div>

                        {{-- Kecamatan --}}
                        <div class="field-group">
                            <label class="field-label">Kecamatan <span class="text-red-400">*</span></label>
                            <select name="kecamatan_code" id="kecamatan" class="field-input" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <input type="hidden" name="kecamatan_name" id="kecamatan_name" value="{{ old('kecamatan_name') }}">
                        </div>

                        {{-- Desa --}}
                        <div class="field-group">
                            <label class="field-label">Desa / Kelurahan <span class="text-red-400">*</span></label>
                            <select name="desa_code" id="desa" class="field-input" required>
                                <option value="">Pilih Desa/Kelurahan</option>
                            </select>
                            <input type="hidden" name="desa_name" id="desa_name" value="{{ old('desa_name') }}">
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Alamat Lengkap <span class="text-red-400">*</span></label>
                        <textarea name="alamat_lengkap" class="field-input" rows="3"
                            placeholder="Nama jalan, nomor rumah, RT/RW, patokan..." required
                            style="resize:vertical; min-height:80px;">{{ old('alamat_lengkap') }}</textarea>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Kode Pos</label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-map-pin"></i>
                            <input type="text" name="kode_pos" class="field-input"
                                placeholder="cth: 63511"
                                value="{{ old('kode_pos') }}" maxlength="5">
                        </div>
                    </div>

                    {{-- Catatan --}}
                    <div class="field-group">
                        <label class="field-label">Catatan Pesanan <span class="text-gray-500 font-normal">(opsional)</span></label>
                        <textarea name="catatan" class="field-input" rows="2"
                            placeholder="cth: Titip di pos satpam, ukuran kaos L..."
                            style="resize:vertical;">{{ old('catatan') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit mt-2">
                        <i class="fas fa-paper-plane text-sm"></i>
                        Lanjutkan Pemesanan
                    </button>

                    <p class="text-gray-600 text-xs text-center mt-4">
                        Data kamu aman dan hanya digunakan untuk keperluan pengiriman.
                    </p>
                </form>
            </div>

        </section>
    </main>

    <script src="{{ asset('landing/js/script.js') }}"></script>
    <script src="{{ asset('landing/js/vanila1.js') }}"></script>
    <script src="{{ asset('landing/js/footer.js') }}"></script>

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
</body>

</html>