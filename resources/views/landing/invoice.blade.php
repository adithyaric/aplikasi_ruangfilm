@extends('layouts.landing.master')
@section('main')
<main class="relative z-10">
    <section class="max-w-6xl mx-auto px-6 md:px-10 py-16">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <p class="text-purple-400 text-sm uppercase tracking-wider font-semibold mb-2">INVOICE</p>
                <h1 class="text-3xl md:text-5xl font-bold border-l-8 border-purple-500 pl-6 tracking-tight">{{ $order->invoice_number }}</h1>
            </div>
            @if($order->canUploadProof())
            <button type="button" id="open-payment-modal"
                class="h-11 px-6 rounded-xl bg-gradient-to-r from-purple-700 to-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2">
                Upload Bukti Transfer
            </button>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] gap-8">
            <div class="glass-card rounded-3xl p-6 md:p-8">
                <h2 class="text-xl font-semibold text-white">Detail Pesanan</h2>
                <div class="mt-6 space-y-4">
                    @foreach($order->items as $item)
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 flex items-center justify-between gap-4">
                        <div>
                            <div class="text-white font-medium">{{ $item->merchandise_name }}</div>
                            <div class="text-sm text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}</div>
                        </div>
                        <div class="text-purple-300 font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="space-y-8">
                <div class="glass-card rounded-3xl p-6 md:p-8">
                    <h2 class="text-xl font-semibold text-white">Status Pembayaran</h2>
                    <div class="mt-5 space-y-3 text-sm text-gray-300">
                        <div><b>Status:</b> {{ strtoupper(str_replace('_', ' ', $order->status)) }}</div>
                        <div><b>Batas Pembayaran:</b> {{ optional($order->payment_due_at)->translatedFormat('d F Y H:i') ?? '-' }} WIB</div>
                        <div><b>Subtotal:</b> Rp {{ number_format($order->subtotal, 0, ',', '.') }}</div>
                    <div><b>Ongkir:</b> Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</div>
                    <div class="text-white font-semibold"><b>Total:</b> Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                    </div>
                    @if($order->payment_proof_path)
                    <a href="{{ $order->paymentProofUrl() }}" target="_blank" class="mt-5 inline-flex text-purple-300 text-sm hover:text-purple-200">
                        Lihat bukti transfer
                    </a>
                    @endif
                    @if($order->rejection_note)
                    <div class="mt-4 rounded-2xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-red-200 text-sm">
                        {{ $order->rejection_note }}
                    </div>
                    @endif
                    @if($order->verification_note)
                    <div class="mt-4 rounded-2xl border border-green-500/30 bg-green-500/10 px-4 py-3 text-green-200 text-sm">
                        {{ $order->verification_note }}
                    </div>
                    @endif
                </div>

                <div class="glass-card rounded-3xl p-6 md:p-8">
                    <h2 class="text-xl font-semibold text-white">Pengiriman</h2>
                    <div class="mt-5 space-y-2 text-sm text-gray-300">
                        <div><b>Penerima:</b> {{ $order->recipient_name }}</div>
                        <div><b>Kontak:</b> {{ $order->recipient_phone }}</div>
                        <div><b>Alamat:</b> {{ $order->full_address }}</div>
                        <div><b>Expedisi:</b> {{ trim($order->expedition_name . ' ' . $order->expedition_service_name) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="payment-modal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/70 px-4">
        <div class="w-full max-w-2xl rounded-3xl border border-purple-500/20 bg-[#111126] p-6 md:p-8">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-purple-400 text-sm uppercase tracking-wider font-semibold mb-1">Pembayaran Manual</p>
                    <h2 class="text-2xl font-bold text-white">Upload Bukti Transfer</h2>
                </div>
                <button type="button" id="close-payment-modal" class="text-gray-400 hover:text-white text-2xl leading-none">&times;</button>
            </div>

            <div class="mt-6 space-y-4">
                @forelse($bankAccounts as $bankAccount)
                <div class="rounded-2xl border border-white/10 bg-white/5 px-5 py-4">
                    <div class="text-white font-semibold">{{ $bankAccount->rek_bank_name }}</div>
                    <div class="text-gray-300 text-sm mt-1">{{ $bankAccount->rek_bank_no }}</div>
                    <div class="text-gray-400 text-sm mt-1">a.n. {{ $bankAccount->rek_name }}</div>
                </div>
                @empty
                <div class="rounded-2xl border border-yellow-500/30 bg-yellow-500/10 px-5 py-4 text-yellow-200 text-sm">
                    Belum ada rekening pembayaran yang aktif.
                </div>
                @endforelse
            </div>

            @if($order->canUploadProof())
            <form action="{{ route('orders.payment-proof', $order) }}" method="POST" enctype="multipart/form-data" class="mt-6">
                @csrf
                <label class="text-sm text-gray-300">Bukti Transfer</label>
                <input type="file" name="payment_proof" required
                    class="mt-2 w-full rounded-2xl bg-white/5 border border-purple-500/20 px-4 py-3 text-white">
                <button type="submit"
                    class="mt-5 w-full h-11 rounded-xl bg-gradient-to-r from-purple-700 to-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2">
                    Kirim Bukti Transfer
                </button>
            </form>
            @endif
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    const openPaymentModal = document.getElementById('open-payment-modal');
    const closePaymentModal = document.getElementById('close-payment-modal');
    const paymentModal = document.getElementById('payment-modal');

    if (openPaymentModal && closePaymentModal && paymentModal) {
        openPaymentModal.addEventListener('click', function() {
            paymentModal.classList.remove('hidden');
            paymentModal.classList.add('flex');
        });

        closePaymentModal.addEventListener('click', function() {
            paymentModal.classList.add('hidden');
            paymentModal.classList.remove('flex');
        });

        paymentModal.addEventListener('click', function(event) {
            if (event.target === paymentModal) {
                paymentModal.classList.add('hidden');
                paymentModal.classList.remove('flex');
            }
        });
    }
</script>
@endpush
