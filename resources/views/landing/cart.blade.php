@extends('layouts.landing.master')
@section('main')
<main class="relative z-10">
    <section class="max-w-6xl mx-auto px-6 md:px-10 py-16">
        <div class="mb-8">
            <p class="text-purple-400 text-sm uppercase tracking-wider font-semibold mb-2">KERANJANG</p>
            <h1 class="text-3xl md:text-5xl font-bold border-l-8 border-purple-500 pl-6 tracking-tight">Keranjang Belanja</h1>
        </div>

        @if($cart->items->isEmpty())
        <div class="glass-card rounded-3xl p-10 text-center text-gray-300">
            Keranjang masih kosong.
            <div class="mt-6">
                <a href="{{ route('merchandise') }}" class="btn-gradient px-6 py-3 rounded-full text-white font-semibold">Belanja Merchandise</a>
            </div>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-[1.8fr_1fr] gap-8">
            <div class="glass-card rounded-3xl p-6 md:p-8">
                <div class="space-y-4">
                    @foreach($cart->items as $item)
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 md:p-5 flex flex-col md:flex-row gap-4 md:items-center">
                        <img src="{{ $item->merchandise && $item->merchandise->image ? asset('storage/' . $item->merchandise->image) : asset('landing/images/merchan/merchan1.jpg') }}"
                            alt="{{ $item->merchandise->name ?? 'Merchandise' }}"
                            class="w-full md:w-28 h-28 object-cover rounded-2xl">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-white">{{ $item->merchandise->name ?? 'Merchandise tidak ditemukan' }}</h3>
                            <p class="text-sm text-gray-400 mt-1">
                                {{ $item->merchandise->category->name ?? '-' }} • {{ number_format(optional($item->merchandise)->weight ?? 0) }} gram
                            </p>
                            <p class="text-purple-300 font-bold mt-2">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="md:w-48">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex gap-2 items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" min="1" max="{{ optional($item->merchandise)->qty_stock ?? $item->quantity }}"
                                    value="{{ $item->quantity }}"
                                    class="w-24 rounded-xl bg-white/5 border border-purple-500/20 px-3 py-2 text-white">
                                <button type="submit" class="rounded-xl border border-purple-500/40 px-3 py-2 text-sm text-purple-300">Update</button>
                            </form>
                            <form action="{{ route('cart.destroy', $item) }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-300 hover:text-red-200">Hapus</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="glass-card rounded-3xl p-6 md:p-8 h-fit">
                <h2 class="text-xl font-semibold text-white">Ringkasan</h2>
                <div class="mt-6 space-y-3 text-sm text-gray-300">
                    <div class="flex justify-between">
                        <span>Total Item</span>
                        <span>{{ $cart->totalQuantity() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($cart->subtotal(), 0, ',', '.') }}</span>
                    </div>
                </div>
                <a href="{{ route('checkout.show') }}"
                    class="mt-8 w-full h-11 rounded-xl bg-gradient-to-r from-purple-700 to-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2 hover:opacity-90 transition">
                    Checkout
                </a>
            </div>
        </div>
        @endif
    </section>
</main>
@endsection
