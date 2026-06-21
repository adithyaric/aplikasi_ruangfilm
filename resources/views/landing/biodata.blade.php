@extends('layouts.landing.master')

@section('main')
@php
    $isGeneralBuyer = $user->role === 'umum';
    $categoryId = $user->category_id;
    $jatimCode = '35';
    $jatimName = 'JAWA TIMUR';
    $pacitanCode = '3501';
    $pacitanName = 'KABUPATEN PACITAN';
@endphp

<main class="relative z-10">
    <section class="max-w-4xl mx-auto px-6 md:px-10 py-16">
        <div class="flex items-center gap-2 mb-6 text-sm">
            <a href="{{ route('landing.home') }}" class="text-gray-500 hover:text-purple-400 transition">Home</a>
            <span class="text-gray-600">/</span>
            <span class="text-purple-400 font-semibold">{{ $title }}</span>
        </div>

        <div class="mb-8">
            <p class="text-purple-400 text-sm uppercase tracking-wider font-semibold mb-2">
                {{ $isGeneralBuyer ? 'SHOPPING PROFILE' : 'SUBMISSION PROFILE' }}
            </p>
            <h1 class="text-3xl md:text-5xl font-bold border-l-8 border-purple-500 pl-6 tracking-tight">
                {{ $detail ? 'Perbarui Biodata' : 'Lengkapi Biodata' }}
            </h1>
            <p class="text-gray-400 text-sm md:text-base mt-4 pl-6 max-w-2xl">
                {{ $isGeneralBuyer
                    ? 'Lengkapi biodata pengiriman agar checkout merchandise bisa diproses tanpa kembali ke halaman dashboard.'
                    : 'Lengkapi biodata peserta sebelum mengirim submission film.' }}
            </p>
        </div>

        <div class="glass-card rounded-3xl p-6 md:p-8">
            @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/30 text-green-400 text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-300 text-sm">
                <div class="font-semibold mb-2">Terdapat kesalahan pada form:</div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('user-detail.save') }}" method="POST">
                @csrf

                @if($isGeneralBuyer)
                <div class="section-divider">Informasi Akun</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5">
                    <div class="field-group">
                        <label class="field-label">Nama Lengkap <span class="text-red-400">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" class="field-input"
                                value="{{ old('name', $user->name) }}" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Email <span class="text-red-400">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" class="field-input"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Nomor WhatsApp <span class="text-red-400">*</span></label>
                    <div class="input-icon-wrap">
                        <i class="fab fa-whatsapp"></i>
                        <input type="text" name="no_hp" class="field-input"
                            value="{{ old('no_hp', $user->no_hp) }}" required>
                    </div>
                </div>
                @else
                <div class="section-divider">Informasi Peserta</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5">
                    <div class="field-group">
                        <label class="field-label">Nama Komunitas <span class="text-red-400">*</span></label>
                        <input type="text" name="community_name" class="field-input"
                            placeholder="Nama Komunitas / Rumah Produksi / Kelompok"
                            value="{{ old('community_name', $detail->community_name ?? '') }}" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Posisi / Jabatan <span class="text-red-400">*</span></label>
                        <input type="text" name="posisi" class="field-input"
                            placeholder="cth: Ketua, Anggota, Sutradara"
                            value="{{ old('posisi', $detail->posisi ?? '') }}" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5">
                    <div class="field-group">
                        <label class="field-label">Username Instagram <span class="text-red-400">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="fab fa-instagram"></i>
                            <input type="text" name="username_ig" class="field-input"
                                placeholder="username_instagram"
                                value="{{ old('username_ig', $detail->username_ig ?? '') }}" required>
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Tanggal Lahir <span class="text-red-400">*</span></label>
                        <input type="date" name="tanggal_lahir" class="field-input"
                            value="{{ old('tanggal_lahir', optional($detail->tanggal_lahir ?? null)->format('Y-m-d')) }}" required>
                    </div>
                </div>
                @endif

                <div class="section-divider">Alamat</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5">
                    <div class="field-group">
                        <label class="field-label">Provinsi <span class="text-red-400">*</span></label>
                        @if(!$isGeneralBuyer && $categoryId != 1)
                        <input type="text" class="field-input" value="{{ $jatimName }}" disabled>
                        <input type="hidden" name="provinsi_code" id="provinsi" value="{{ $jatimCode }}">
                        @else
                        <select name="provinsi_code" id="provinsi" class="field-input" required>
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinsi as $p)
                            <option value="{{ $p->code }}" data-name="{{ $p->name }}"
                                {{ old('provinsi_code', $detail->provinsi_code ?? '') == $p->code ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                            @endforeach
                        </select>
                        @endif
                        <input type="hidden" name="provinsi_name" id="provinsi_name"
                            value="{{ old('provinsi_name', $detail->provinsi_name ?? (!$isGeneralBuyer && $categoryId != 1 ? $jatimName : '')) }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label">Kabupaten / Kota <span class="text-red-400">*</span></label>
                        @if(!$isGeneralBuyer && in_array($categoryId, [3, 4]))
                        <input type="text" class="field-input" value="{{ $pacitanName }}" disabled>
                        <input type="hidden" name="kabupaten_code" id="kabupaten" value="{{ $pacitanCode }}">
                        <input type="hidden" name="kabupaten_name" id="kabupaten_name" value="{{ $pacitanName }}">
                        @else
                        <select name="kabupaten_code" id="kabupaten" class="field-input" required>
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                        <input type="hidden" name="kabupaten_name" id="kabupaten_name"
                            value="{{ old('kabupaten_name', $detail->kabupaten_name ?? '') }}">
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5">
                    <div class="field-group">
                        <label class="field-label">Kecamatan <span class="text-red-400">*</span></label>
                        <select name="kecamatan_code" id="kecamatan" class="field-input" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                        <input type="hidden" name="kecamatan_name" id="kecamatan_name"
                            value="{{ old('kecamatan_name', $detail->kecamatan_name ?? '') }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label">Desa / Kelurahan <span class="text-red-400">*</span></label>
                        <select name="desa_code" id="desa" class="field-input" required>
                            <option value="">Pilih Desa/Kelurahan</option>
                        </select>
                        <input type="hidden" name="desa_name" id="desa_name"
                            value="{{ old('desa_name', $detail->desa_name ?? '') }}">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label">Alamat Lengkap <span class="text-red-400">*</span></label>
                    <textarea name="alamat_lengkap" class="field-input" rows="4"
                        placeholder="Nama jalan, nomor rumah, RT/RW, patokan..." required>{{ old('alamat_lengkap', $detail->alamat_lengkap ?? '') }}</textarea>
                </div>

                <div class="flex flex-col md:flex-row gap-3 pt-2">
                    <a href="{{ $isGeneralBuyer ? route('orders.index') : route('dashboard') }}"
                        class="px-5 py-3 rounded-xl border border-white/10 bg-white/5 text-gray-300 text-center font-semibold">
                        Kembali
                    </a>
                    <button type="submit" class="btn-submit">
                        Simpan Biodata
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    const categoryId = parseInt("{{ $categoryId ?? 1 }}", 10);
    const isGeneralBuyer = "{{ $isGeneralBuyer ? '1' : '0' }}" === '1';
    const JATIM_CODE = "{{ $jatimCode }}";
    const PACITAN_CODE = "{{ $pacitanCode }}";
    const existingKabupaten = "{{ old('kabupaten_code', $detail->kabupaten_code ?? '') }}";
    const existingKecamatan = "{{ old('kecamatan_code', $detail->kecamatan_code ?? '') }}";
    const existingDesaCode = "{{ old('desa_code', $detail->desa_code ?? '') }}";

    function hydrateKabupaten(selectedCode) {
        if (selectedCode) {
            document.getElementById('kabupaten_name').value = document.querySelector('#kabupaten option:checked')?.textContent || '';
        }
    }

    function hydrateKecamatan(selectedCode) {
        if (selectedCode) {
            document.getElementById('kecamatan_name').value = document.querySelector('#kecamatan option:checked')?.textContent || '';
        }
    }

    function hydrateDesa(selectedCode) {
        if (selectedCode) {
            document.getElementById('desa_name').value = document.querySelector('#desa option:checked')?.textContent || '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof initSelect2 === 'function') {
            initSelect2('#provinsi', 'Pilih Provinsi');
            initSelect2('#kabupaten', 'Pilih Kabupaten/Kota');
            initSelect2('#kecamatan', 'Pilih Kecamatan');
            initSelect2('#desa', 'Pilih Desa/Kelurahan');
        }

        if (!isGeneralBuyer && categoryId !== 1) {
            document.getElementById('provinsi_name').value = "{{ $jatimName }}";

            if (categoryId === 3 || categoryId === 4) {
                loadKecamatan(PACITAN_CODE, existingKecamatan || null);
                if (existingKecamatan) {
                    setTimeout(function() {
                        hydrateKecamatan(existingKecamatan);
                        loadDesa(existingKecamatan, existingDesaCode || null);
                    }, 300);
                }
            } else {
                loadKabupaten(JATIM_CODE, existingKabupaten || null);
                if (existingKabupaten) {
                    setTimeout(function() {
                        hydrateKabupaten(existingKabupaten);
                        loadKecamatan(existingKabupaten, existingKecamatan || null);
                    }, 300);
                }
            }
        } else {
            const selectedProv = document.getElementById('provinsi').value;

            if (selectedProv) {
                loadKabupaten(selectedProv, existingKabupaten || null);
                if (existingKabupaten) {
                    setTimeout(function() {
                        hydrateKabupaten(existingKabupaten);
                        loadKecamatan(existingKabupaten, existingKecamatan || null);
                    }, 300);
                }
            }
        }

        if (existingKecamatan) {
            setTimeout(function() {
                hydrateKecamatan(existingKecamatan);
                loadDesa(existingKecamatan, existingDesaCode || null);
            }, 600);
        }

        if (existingDesaCode) {
            setTimeout(function() {
                hydrateDesa(existingDesaCode);
            }, 900);
        }
    });
</script>
@endpush
