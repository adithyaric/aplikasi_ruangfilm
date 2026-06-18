@extends('layouts.landing.master')
@section('main')
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
                    <h2 class="text-xl font-semibold text-white">Alamat Pengiriman</h2>
                    <div class="mt-5 space-y-3 text-sm text-gray-300">
                        <div><b>Nama:</b> {{ $user->name }}</div>
                        <div><b>Email:</b> {{ $user->email }}</div>
                        <div><b>WhatsApp:</b> {{ $user->no_hp }}</div>
                        <div><b>Alamat:</b> {{ $user->detail->formatted_address }}</div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('user-detail.index') }}" class="text-purple-300 text-sm hover:text-purple-200">Perbarui biodata pengiriman</a>
                    </div>
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
