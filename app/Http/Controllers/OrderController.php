<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Merchandise;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $this->expireOverdueOrders();

        return view('landing.orders', [
            'orders' => auth()->user()->orders()->latest()->get(),
        ]);
    }

    public function show(Order $order)
    {
        $this->expireOverdueOrders();
        $this->authorizeOrderAccess($order);

        $order->load(['items', 'verifier']);

        return view('landing.invoice', [
            'order' => $order,
            'bankAccounts' => BankAccount::where('is_active', true)->orderBy('rek_bank_name')->get(),
        ]);
    }

    public function uploadPaymentProof(Request $request, Order $order)
    {
        $this->expireOverdueOrders();
        abort_unless($order->user_id === auth()->id(), 403);

        if (!$order->canUploadProof()) {
            return back()->with('warning', 'Bukti transfer tidak dapat diunggah untuk invoice ini.');
        }

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $order->deleteStoredPaymentProof();

        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        $order->update([
            'payment_proof_path' => $path,
            'payment_submitted_at' => now(),
            'status' => Order::STATUS_WAITING_VERIFICATION,
            'verified_at' => null,
            'verified_by' => null,
            'verification_note' => null,
            'rejection_note' => null,
        ]);

        return back()->with('success', 'Bukti transfer berhasil diunggah.');
    }

    public function adminIndex()
    {
        $this->expireOverdueOrders();

        return view('order.index', [
            'title' => 'Data Invoice Merchandise',
            'orders' => Order::with('user')->latest()->get(),
        ]);
    }

    public function adminShow(Order $order)
    {
        $this->expireOverdueOrders();

        return view('order.show', [
            'title' => 'Detail Invoice',
            'order' => $order->load(['user', 'items', 'verifier']),
        ]);
    }

    public function verify(Request $request, Order $order)
    {
        if ($order->status !== Order::STATUS_WAITING_VERIFICATION) {
            return back()->with('warning', 'Invoice ini tidak menunggu verifikasi.');
        }

        $request->validate([
            'verification_note' => 'nullable|string',
        ]);

        $order->update([
            'status' => Order::STATUS_PAID,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'verification_note' => $request->verification_note,
            'rejection_note' => null,
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function reject(Request $request, Order $order)
    {
        if ($order->status !== Order::STATUS_WAITING_VERIFICATION) {
            return back()->with('warning', 'Invoice ini tidak menunggu verifikasi.');
        }

        $request->validate([
            'rejection_note' => 'required|string',
        ]);

        DB::transaction(function () use ($order, $request) {
            $this->restoreStock($order);

            $order->update([
                'status' => Order::STATUS_PAYMENT_REJECTED,
                'verified_by' => auth()->id(),
                'verified_at' => now(),
                'rejection_note' => $request->rejection_note,
                'verification_note' => null,
            ]);
        });

        return back()->with('success', 'Pembayaran ditolak dan stok dikembalikan.');
    }

    protected function authorizeOrderAccess(Order $order)
    {
        $allowedRoles = ['admin', 'adminsub'];

        if ($order->user_id === auth()->id() || in_array(auth()->user()->role, $allowedRoles, true)) {
            return;
        }

        abort(403);
    }

    protected function expireOverdueOrders()
    {
        $expiredOrders = Order::with('items')
            ->where('status', Order::STATUS_WAITING_PAYMENT)
            ->whereNotNull('payment_due_at')
            ->where('payment_due_at', '<', now())
            ->get();

        foreach ($expiredOrders as $order) {
            DB::transaction(function () use ($order) {
                $this->restoreStock($order);

                $order->update([
                    'status' => Order::STATUS_EXPIRED,
                ]);
            });
        }
    }

    protected function restoreStock(Order $order)
    {
        foreach ($order->items as $item) {
            if (!$item->merchandise_id) {
                continue;
            }

            Merchandise::where('id', $item->merchandise_id)
                ->increment('qty_stock', $item->quantity);
        }
    }
}
