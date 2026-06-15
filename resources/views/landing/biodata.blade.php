@extends('layouts.landing.master')
@section('main')
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
@endsection