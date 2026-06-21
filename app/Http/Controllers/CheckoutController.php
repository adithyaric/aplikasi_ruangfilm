<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\Cart;
use App\Models\Expedition;
use App\Models\Order;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Laravolt\Indonesia\Models\Province;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = Cart::with('items.merchandise.category')
            ->firstOrCreate(['user_id' => auth()->id()]);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('warning', 'Keranjang Anda masih kosong.');
        }

        $user = auth()->user()->load('detail');
        $isGeneralBuyer = $user->role === 'umum';

        if (!$user->detail && !$isGeneralBuyer) {
            return redirect()->route('user-detail.index')
                ->with('warning', 'Lengkapi biodata terlebih dahulu sebelum checkout.');
        }

        return view('landing.checkout', [
            'cart' => $cart,
            'expeditions' => Expedition::where('is_active', true)->orderBy('name')->get(),
            'user' => $user,
            'isGeneralBuyer' => $isGeneralBuyer,
            'provinsi' => $isGeneralBuyer ? Province::orderBy('name')->get() : collect(),
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user()->load('detail');
        $isGeneralBuyer = $user->role === 'umum';

        $rules = [
            'expedition_id' => 'required|exists:expeditions,id',
            'postal_code' => 'nullable|string|max:10',
            'notes' => 'nullable|string',
        ];

        if ($isGeneralBuyer) {
            $rules = array_merge($rules, [
                'name' => 'required|string|max:100',
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
                'no_hp' => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
                'provinsi_code' => 'required',
                'provinsi_name' => 'required',
                'kabupaten_code' => 'required',
                'kabupaten_name' => 'required',
                'kecamatan_code' => 'required',
                'kecamatan_name' => 'required',
                'desa_code' => 'required',
                'desa_name' => 'required',
                'alamat_lengkap' => 'required|string',
            ]);
        }

        $request->validate($rules);

        if ($isGeneralBuyer) {
            $this->persistGeneralBuyerProfile($request, $user);
            $user->load('detail');
        }

        if (!$user->detail) {
            return redirect()->route('user-detail.index')
                ->with('warning', 'Lengkapi biodata terlebih dahulu sebelum checkout.');
        }

        $cart = Cart::with('items.merchandise')
            ->firstOrCreate(['user_id' => $user->id]);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('warning', 'Keranjang Anda masih kosong.');
        }

        $expedition = Expedition::where('id', $request->expedition_id)
            ->where('is_active', true)
            ->firstOrFail();

        $subtotal = 0;

        foreach ($cart->items as $item) {
            $merchandise = $item->merchandise;

            if (!$merchandise || !$merchandise->is_active) {
                return redirect()->route('cart.index')
                    ->with('warning', 'Ada merchandise yang sudah tidak tersedia.');
            }

            if ($item->quantity > $merchandise->qty_stock) {
                return redirect()->route('cart.index')
                    ->with('warning', 'Stok merchandise tidak mencukupi untuk checkout.');
            }

            $subtotal += $item->quantity * $merchandise->currentPrice();
        }

        $order = DB::transaction(function () use ($cart, $expedition, $request, $user, $subtotal) {
            $order = Order::create([
                'invoice_number' => $this->generateInvoiceNumber(),
                'user_id' => $user->id,
                'expedition_id' => $expedition->id,
                'expedition_name' => $expedition->name,
                'expedition_service_name' => $expedition->service_name,
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
                'recipient_phone' => $user->no_hp,
                'province_name' => $user->detail->provinsi_name,
                'city_name' => $user->detail->kabupaten_name,
                'district_name' => $user->detail->kecamatan_name,
                'village_name' => $user->detail->desa_name,
                'postal_code' => $request->postal_code,
                'full_address' => $user->detail->formatted_address,
                'notes' => $request->notes,
                'shipping_fee' => $expedition->fee,
                'subtotal' => $subtotal,
                'total' => $subtotal + $expedition->fee,
                'status' => Order::STATUS_WAITING_PAYMENT,
                'payment_due_at' => now()->addHours(AppSetting::paymentDueHours()),
            ]);

            foreach ($cart->items as $item) {
                $merchandise = $item->merchandise;

                $order->items()->create([
                    'merchandise_id' => $merchandise->id,
                    'merchandise_name' => $merchandise->name,
                    'merchandise_slug' => $merchandise->slug,
                    'merchandise_image' => $merchandise->image,
                    'unit_price' => $merchandise->currentPrice(),
                    'quantity' => $item->quantity,
                    'weight' => $merchandise->weight,
                    'subtotal' => $item->quantity * $merchandise->currentPrice(),
                ]);

                $merchandise->decrement('qty_stock', $item->quantity);
            }

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('orders.show', $order)
            ->with('success', 'Invoice berhasil dibuat. Silakan lanjutkan pembayaran.');
    }

    protected function generateInvoiceNumber()
    {
        do {
            $number = 'INV-RF-' . now()->format('Ymd') . '-' . str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (Order::where('invoice_number', $number)->exists());

        return $number;
    }

    protected function persistGeneralBuyerProfile(Request $request, $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'community_name' => null,
                'provinsi_code' => $request->provinsi_code,
                'provinsi_name' => $request->provinsi_name,
                'kabupaten_code' => $request->kabupaten_code,
                'kabupaten_name' => $request->kabupaten_name,
                'kecamatan_code' => $request->kecamatan_code,
                'kecamatan_name' => $request->kecamatan_name,
                'desa_code' => $request->desa_code,
                'desa_name' => $request->desa_name,
                'username_ig' => null,
                'posisi' => null,
                'alamat_lengkap' => $request->alamat_lengkap,
                'tanggal_lahir' => null,
            ]
        );
    }
}
