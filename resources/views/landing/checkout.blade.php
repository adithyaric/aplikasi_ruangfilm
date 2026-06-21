@extends('layouts.landing.master')
@section('main')
@php
    $detail = $user->detail;
@endphp
<main class="relative z-10">
    <section class="max-w-6xl mx-auto px-6 md:px-10 py-16">
        <div class="mb-8">
            <p class="text-purple-400 text-sm uppercase tracking-wider font-semibold mb-2">CHECKOUT</p>
            <h1 class="text-3xl md:text-5xl font-bold border-l-8 border-purple-500 pl-6 tracking-tight">Checkout Merchandise</h1>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-[1.4fr_1fr] gap-8">
            @csrf
            <div class="space-y-8">
                <div class="glass-card rounded-3xl p-6 md:p-8">
                    <h2 class="text-xl font-semibold text-white">{{ $isGeneralBuyer ? 'Biodata Pengiriman' : 'Alamat Pengiriman' }}</h2>

                    @if($isGeneralBuyer)
                    <div class="mt-5 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="field-group !mb-0">
                                <label class="field-label">Nama Lengkap</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="name" class="field-input" value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            <div class="field-group !mb-0">
                                <label class="field-label">Email</label>
                                <div class="input-icon-wrap">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" name="email" class="field-input" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="field-group !mb-0">
                            <label class="field-label">Nomor WhatsApp</label>
                            <div class="input-icon-wrap">
                                <i class="fab fa-whatsapp"></i>
                                <input type="text" name="no_hp" class="field-input" value="{{ old('no_hp', $user->no_hp) }}" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="field-group !mb-0">
                                <label class="field-label">Provinsi</label>
                                <select name="provinsi_code" id="provinsi" class="field-input" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinsi as $province)
                                    <option value="{{ $province->code }}" data-name="{{ $province->name }}"
                                        {{ old('provinsi_code', $detail->provinsi_code ?? '') == $province->code ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="provinsi_name" id="provinsi_name" value="{{ old('provinsi_name', $detail->provinsi_name ?? '') }}">
                            </div>
                            <div class="field-group !mb-0">
                                <label class="field-label">Kabupaten / Kota</label>
                                <select name="kabupaten_code" id="kabupaten" class="field-input" required>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                                <input type="hidden" name="kabupaten_name" id="kabupaten_name" value="{{ old('kabupaten_name', $detail->kabupaten_name ?? '') }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="field-group !mb-0">
                                <label class="field-label">Kecamatan</label>
                                <select name="kecamatan_code" id="kecamatan" class="field-input" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <input type="hidden" name="kecamatan_name" id="kecamatan_name" value="{{ old('kecamatan_name', $detail->kecamatan_name ?? '') }}">
                            </div>
                            <div class="field-group !mb-0">
                                <label class="field-label">Desa / Kelurahan</label>
                                <select name="desa_code" id="desa" class="field-input" required>
                                    <option value="">Pilih Desa/Kelurahan</option>
                                </select>
                                <input type="hidden" name="desa_name" id="desa_name" value="{{ old('desa_name', $detail->desa_name ?? '') }}">
                            </div>
                        </div>

                        <div class="field-group !mb-0">
                            <label class="field-label">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" class="field-input" rows="3" required>{{ old('alamat_lengkap', $detail->alamat_lengkap ?? '') }}</textarea>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('user-detail.index') }}" class="text-purple-300 text-sm hover:text-purple-200">Kelola biodata pembeli di halaman khusus</a>
                        </div>
                    </div>
                    @else
                    <div class="mt-5 space-y-3 text-sm text-gray-300">
                        <div><b>Nama:</b> {{ $user->name }}</div>
                        <div><b>Email:</b> {{ $user->email }}</div>
                        <div><b>WhatsApp:</b> {{ $user->no_hp }}</div>
                        <div><b>Alamat:</b> {{ $user->detail->formatted_address }}</div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('user-detail.index') }}" class="text-purple-300 text-sm hover:text-purple-200">Perbarui biodata pengiriman</a>
                    </div>
                    @endif
                </div>

                <div class="glass-card rounded-3xl p-6 md:p-8">
                    <h2 class="text-xl font-semibold text-white">Expedisi</h2>
                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="text-sm text-gray-300">Pilih Expedisi</label>
                            <select name="expedition_id" class="mt-2 w-full rounded-2xl bg-white/5 border border-purple-500/20 px-4 py-3 text-white" required>
                                <option value="">Pilih expedisi</option>
                                @foreach($expeditions as $expedition)
                                <option value="{{ $expedition->id }}" {{ old('expedition_id') == $expedition->id ? 'selected' : '' }}>
                                    {{ $expedition->display_name }} - Rp {{ number_format($expedition->fee, 0, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-sm text-gray-300">Kode Pos</label>
                            <input type="text" name="postal_code" class="mt-2 w-full rounded-2xl bg-white/5 border border-purple-500/20 px-4 py-3 text-white"
                                value="{{ old('postal_code') }}" placeholder="Opsional">
                        </div>
                        <div>
                            <label class="text-sm text-gray-300">Catatan Pesanan</label>
                            <textarea name="notes" rows="3" class="mt-2 w-full rounded-2xl bg-white/5 border border-purple-500/20 px-4 py-3 text-white"
                                placeholder="Opsional">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-3xl p-6 md:p-8 h-fit">
                <h2 class="text-xl font-semibold text-white">Ringkasan Pesanan</h2>
                <div class="mt-6 space-y-4">
                    @foreach($cart->items as $item)
                    <div class="flex items-start justify-between gap-4 text-sm">
                        <div>
                            <div class="text-white font-medium">{{ $item->merchandise->name }}</div>
                            <div class="text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}</div>
                        </div>
                        <div class="text-purple-300 font-semibold">
                            Rp {{ number_format($item->subtotal(), 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-6 pt-6 border-t border-white/10 flex justify-between text-sm text-gray-300">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($cart->subtotal(), 0, ',', '.') }}</span>
                </div>
                <button type="submit"
                    class="mt-8 w-full h-11 rounded-xl bg-gradient-to-r from-purple-700 to-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2 hover:opacity-90 transition">
                    Buat Invoice
                </button>
            </div>
        </form>
    </section>
</main>
@endsection

@push('scripts')
@if($isGeneralBuyer)
<script>
    const existingKabupaten = "{{ old('kabupaten_code', $detail->kabupaten_code ?? '') }}";
    const existingKecamatan = "{{ old('kecamatan_code', $detail->kecamatan_code ?? '') }}";
    const existingDesaCode = "{{ old('desa_code', $detail->desa_code ?? '') }}";

    document.addEventListener('DOMContentLoaded', function() {
        const selectedProv = document.getElementById('provinsi')?.value;

        if (selectedProv) {
            loadKabupaten(selectedProv, existingKabupaten || null);
        }

        if (existingKabupaten) {
            setTimeout(function() {
                document.getElementById('kabupaten_name').value = document.querySelector('#kabupaten option:checked')?.textContent || '';
                loadKecamatan(existingKabupaten, existingKecamatan || null);
            }, 300);
        }

        if (existingKecamatan) {
            setTimeout(function() {
                document.getElementById('kecamatan_name').value = document.querySelector('#kecamatan option:checked')?.textContent || '';
                loadDesa(existingKecamatan, existingDesaCode || null);
            }, 600);
        }

        if (existingDesaCode) {
            setTimeout(function() {
                document.getElementById('desa_name').value = document.querySelector('#desa option:checked')?.textContent || '';
            }, 900);
        }
    });
</script>
@endif
@endpush
