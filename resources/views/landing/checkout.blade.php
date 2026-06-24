@extends('layouts.landing.master')
@section('main')
@php
    $detail = $user->detail;
    $subtotal = $cart->subtotal();
@endphp
<main class="relative z-10">
    <section class="max-w-6xl mx-auto px-6 md:px-10 py-16">
        <div class="mb-8">
            <p class="text-purple-400 text-sm uppercase tracking-wider font-semibold mb-2">CHECKOUT</p>
            <h1 class="text-3xl md:text-5xl font-bold border-l-8 border-purple-500 pl-6 tracking-tight">Checkout Merchandise</h1>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form" class="grid grid-cols-1 lg:grid-cols-[1.4fr_1fr] gap-8">
            @csrf
            <input type="hidden" name="selected_shipping_option" id="selected_shipping_option" value="{{ old('selected_shipping_option') }}">

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
                    <h2 class="text-xl font-semibold text-white">Pengiriman</h2>
                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="text-sm text-gray-300">Kode Pos</label>
                            <input type="text" name="postal_code" id="postal_code" class="mt-2 w-full rounded-2xl bg-white/5 border border-purple-500/20 px-4 py-3 text-white"
                                value="{{ old('postal_code') }}" placeholder="Opsional">
                        </div>
                        <div>
                            <label class="text-sm text-gray-300">Catatan Pesanan</label>
                            <textarea name="notes" rows="3" class="mt-2 w-full rounded-2xl bg-white/5 border border-purple-500/20 px-4 py-3 text-white"
                                placeholder="Opsional">{{ old('notes') }}</textarea>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                <div>
                                    <div class="text-white font-semibold">Opsi Pengiriman Live</div>
                                    <p class="text-sm text-gray-400">Kurir dan ongkir diambil langsung dari RajaOngkir berdasarkan alamat tujuan.</p>
                                </div>
                                <button type="button" id="load-shipping-options"
                                    class="h-11 px-5 rounded-xl bg-gradient-to-r from-purple-700 to-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2 hover:opacity-90 transition">
                                    Cek Ongkir
                                </button>
                            </div>

                            @error('selected_shipping_option')
                            <div class="mt-4 rounded-2xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                                {{ $message }}
                            </div>
                            @enderror

                            <div id="shipping-feedback" class="mt-4 hidden rounded-2xl px-4 py-3 text-sm"></div>
                            <div id="shipping-options" class="mt-4 space-y-4"></div>
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
                <div class="mt-6 pt-6 border-t border-white/10 space-y-3 text-sm text-gray-300">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span id="summary-subtotal" data-subtotal="{{ (int) $subtotal }}">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Ongkir</span>
                        <span id="summary-shipping">Belum dipilih</span>
                    </div>
                    <div class="flex justify-between text-white font-semibold">
                        <span>Total</span>
                        <span id="summary-total">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div id="summary-shipping-label" class="hidden rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-xs text-gray-300"></div>
                </div>
                <button type="submit" id="submit-checkout"
                    class="mt-8 w-full h-11 rounded-xl bg-gradient-to-r from-purple-700 to-purple-500 text-white text-sm font-semibold flex items-center justify-center gap-2 hover:opacity-90 transition disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    Buat Invoice
                </button>
            </div>
        </form>
    </section>
</main>
@endsection

@push('scripts')
<script>
    const checkoutForm = document.getElementById('checkout-form');
    const shippingButton = document.getElementById('load-shipping-options');
    const shippingOptionsContainer = document.getElementById('shipping-options');
    const shippingFeedback = document.getElementById('shipping-feedback');
    const selectedShippingOptionInput = document.getElementById('selected_shipping_option');
    const submitCheckoutButton = document.getElementById('submit-checkout');
    const summarySubtotal = document.getElementById('summary-subtotal');
    const summaryShipping = document.getElementById('summary-shipping');
    const summaryTotal = document.getElementById('summary-total');
    const summaryShippingLabel = document.getElementById('summary-shipping-label');
    const oldSelectedShippingOption = "{{ old('selected_shipping_option') }}";
    const checkoutSubtotal = Number(summarySubtotal.dataset.subtotal || 0);
    const isGeneralBuyer = @json($isGeneralBuyer);

    function formatRupiah(value) {
        return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
    }

    function resetShippingSummary(message = 'Belum dipilih') {
        selectedShippingOptionInput.value = '';
        summaryShipping.textContent = message;
        summaryTotal.textContent = formatRupiah(checkoutSubtotal);
        summaryShippingLabel.classList.add('hidden');
        summaryShippingLabel.textContent = '';
        submitCheckoutButton.setAttribute('disabled', 'disabled');
    }

    function showShippingFeedback(message, type = 'info') {
        const classes = {
            info: 'border border-white/10 bg-white/5 text-gray-200',
            error: 'border border-red-500/30 bg-red-500/10 text-red-200',
            success: 'border border-green-500/30 bg-green-500/10 text-green-200',
        };

        shippingFeedback.className = 'mt-4 rounded-2xl px-4 py-3 text-sm ' + (classes[type] || classes.info);
        shippingFeedback.textContent = message;
        shippingFeedback.classList.remove('hidden');
    }

    function clearShippingOptions(message = 'Belum dipilih') {
        shippingOptionsContainer.innerHTML = '';
        shippingFeedback.classList.add('hidden');
        resetShippingSummary(message);
    }

    function applySelectedShipping(option) {
        selectedShippingOptionInput.value = option.quoteId;
        summaryShipping.textContent = formatRupiah(option.price);
        summaryTotal.textContent = formatRupiah(checkoutSubtotal + Number(option.price));
        summaryShippingLabel.textContent = option.courierName + ' - ' + option.serviceName + (option.etd ? ' · Estimasi ' + option.etd + ' hari' : '');
        summaryShippingLabel.classList.remove('hidden');
        submitCheckoutButton.removeAttribute('disabled');
    }

    function renderShippingOptions(groups) {
        shippingOptionsContainer.innerHTML = '';
        resetShippingSummary();

        groups.forEach(function(group, groupIndex) {
            const wrapper = document.createElement('div');
            wrapper.className = 'rounded-2xl border border-white/10 bg-white/5 p-4';

            const optionsHtml = group.options.map(function(option, optionIndex) {
                const optionId = 'shipping-option-' + groupIndex + '-' + optionIndex;

                return `
                    <label for="${optionId}" class="block cursor-pointer rounded-2xl border border-white/10 bg-black/10 px-4 py-4 transition hover:border-purple-400/40">
                        <div class="flex items-start gap-3">
                            <input
                                type="radio"
                                id="${optionId}"
                                name="shipping_option_picker"
                                value="${option.quote_id}"
                                data-quote-id="${option.quote_id}"
                                data-courier-name="${option.courier_name}"
                                data-service-name="${option.service_name}"
                                data-price="${option.price}"
                                data-etd="${option.etd || ''}"
                                class="mt-1"
                            >
                            <div class="flex-1">
                                <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <div class="text-white font-semibold">${option.service_name}</div>
                                        <div class="text-xs text-gray-400">${option.description || option.service_name}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-purple-300 font-semibold">${formatRupiah(option.price)}</div>
                                        <div class="text-xs text-gray-400">${option.etd ? 'Estimasi ' + option.etd + ' hari' : 'Estimasi mengikuti kurir'}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>
                `;
            }).join('');

            wrapper.innerHTML = `
                <div class="flex items-center justify-between gap-4">
                    <div class="text-white font-semibold">${group.courier_name}</div>
                    <div class="text-xs uppercase tracking-[0.2em] text-gray-400">${group.options.length} layanan</div>
                </div>
                <div class="mt-4 space-y-3">${optionsHtml}</div>
            `;

            shippingOptionsContainer.appendChild(wrapper);
        });

        const radios = shippingOptionsContainer.querySelectorAll('input[name="shipping_option_picker"]');
        radios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                applySelectedShipping({
                    quoteId: this.dataset.quoteId,
                    courierName: this.dataset.courierName,
                    serviceName: this.dataset.serviceName,
                    price: Number(this.dataset.price || 0),
                    etd: this.dataset.etd || '',
                });
            });
        });

        const targetQuoteId = selectedShippingOptionInput.value || oldSelectedShippingOption;
        const checkedRadio = Array.from(radios).find(function(radio) {
            return radio.value === targetQuoteId;
        }) || radios[0];

        if (checkedRadio) {
            checkedRadio.checked = true;
            checkedRadio.dispatchEvent(new Event('change'));
        }
    }

    function buildShippingPayload() {
        return new URLSearchParams(new FormData(checkoutForm));
    }

    async function loadShippingOptions() {
        shippingButton.setAttribute('disabled', 'disabled');
        shippingButton.textContent = 'Memuat...';
        showShippingFeedback('Mengambil pilihan ongkir terbaru...', 'info');
        resetShippingSummary();

        try {
            const response = await fetch("{{ route('checkout.shipping-options') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                body: buildShippingPayload(),
            });

            const payload = await response.json();

            if (!response.ok) {
                const message = payload.message || 'Gagal memuat opsi pengiriman.';
                throw new Error(message);
            }

            const groups = payload.data?.groups || [];

            if (!groups.length) {
                throw new Error('Tidak ada layanan pengiriman yang tersedia untuk alamat ini.');
            }

            renderShippingOptions(groups);
            showShippingFeedback('Opsi pengiriman berhasil diperbarui.', 'success');
        } catch (error) {
            clearShippingOptions();
            showShippingFeedback(error.message || 'Gagal memuat opsi pengiriman.', 'error');
        } finally {
            shippingButton.removeAttribute('disabled');
            shippingButton.textContent = 'Cek Ongkir';
        }
    }

    function attachShippingReset(selector) {
        document.querySelectorAll(selector).forEach(function(element) {
            element.addEventListener('change', function() {
                clearShippingOptions('Periksa ulang ongkir');
            });
            element.addEventListener('input', function() {
                clearShippingOptions('Periksa ulang ongkir');
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        attachShippingReset('#postal_code, textarea[name="alamat_lengkap"]');

        if (isGeneralBuyer) {
            attachShippingReset('#provinsi, #kabupaten, #kecamatan, #desa, input[name="name"], input[name="email"], input[name="no_hp"]');
        }

        if (!isGeneralBuyer) {
            setTimeout(loadShippingOptions, 250);
        }
    });

    shippingButton.addEventListener('click', function() {
        loadShippingOptions();
    });
</script>

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
                if (oldSelectedShippingOption) {
                    loadShippingOptions();
                }
            }, 900);
        }
    });
</script>
@endif
@endpush
