@extends('layouts.master')
@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Detail Invoice {{ $order->invoice_number }}</b></h3>
                </div>
                <div class="box-body">
                    <p><b>Pembeli:</b> {{ $order->recipient_name }} ({{ $order->recipient_phone }})</p>
                    <p><b>Alamat:</b> {{ $order->full_address }}</p>
                    <p><b>Expedisi:</b> {{ trim($order->expedition_name . ' ' . $order->expedition_service_name) }}</p>
                    <p><b>Status:</b> {{ strtoupper(str_replace('_', ' ', $order->status)) }}</p>
                    <p><b>Batas Bayar:</b> {{ optional($order->payment_due_at)->translatedFormat('d F Y H:i') ?? '-' }} WIB</p>
                    @if($order->notes)
                    <p><b>Catatan:</b> {{ $order->notes }}</p>
                    @endif

                    <hr>
                    <h4><b>Item Pesanan</b></h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Qty</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->merchandise_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->weight) }} gr</td>
                                    <td>@currency($item->unit_price)</td>
                                    <td>@currency($item->subtotal)</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Subtotal</th>
                                    <th>@currency($order->subtotal)</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Ongkir</th>
                                    <th>@currency($order->shipping_fee)</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Total</th>
                                    <th>@currency($order->total)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Bukti Transfer</b></h3>
                </div>
                <div class="box-body">
                    @if($order->payment_proof_path)
                    <p>
                        <a href="{{ asset('storage/' . $order->payment_proof_path) }}" target="_blank" class="btn btn-info btn-sm">
                            Lihat Bukti Transfer
                        </a>
                    </p>
                    @else
                    <p class="text-muted">Belum ada bukti transfer.</p>
                    @endif

                    @if($order->verification_note)
                    <div class="alert alert-success">
                        <b>Catatan Verifikasi:</b><br>
                        {{ $order->verification_note }}
                    </div>
                    @endif

                    @if($order->rejection_note)
                    <div class="alert alert-danger">
                        <b>Catatan Penolakan:</b><br>
                        {{ $order->rejection_note }}
                    </div>
                    @endif

                    @if($order->status === \App\Models\Order::STATUS_WAITING_VERIFICATION)
                    <hr>
                    <form action="{{ route('admin.orders.verify', $order) }}" method="POST" style="margin-bottom:14px;">
                        @csrf
                        <div class="form-group">
                            <label>Catatan Verifikasi</label>
                            <textarea name="verification_note" class="form-control" rows="3" placeholder="Opsional"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Verifikasi Pembayaran</button>
                    </form>

                    <form action="{{ route('admin.orders.reject', $order) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Alasan Penolakan</label>
                            <textarea name="rejection_note" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block">Tolak Pembayaran</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
