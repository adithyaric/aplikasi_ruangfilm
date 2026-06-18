<?php

namespace Tests\Feature;

use App\Models\AppSetting;
use App\Models\Category;
use App\Models\Expedition;
use App\Models\Merchandise;
use App\Models\MerchandiseCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CheckoutFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_creates_invoice_uses_payment_due_setting_and_decrements_stock()
    {
        $filmCategory = Category::factory()->create();
        $user = User::factory()->create([
            'role' => 'peserta',
            'category_id' => $filmCategory->id,
        ]);
        UserDetail::factory()->create(['user_id' => $user->id]);

        $merchCategory = MerchandiseCategory::factory()->create();
        $merchandise = Merchandise::factory()->create([
            'merchandise_category_id' => $merchCategory->id,
            'price' => 120000,
            'qty_stock' => 10,
        ]);
        $expedition = Expedition::factory()->create([
            'fee' => 15000,
        ]);

        AppSetting::factory()->create([
            'key' => 'payment_due_hours',
            'value' => '48',
        ]);

        $this->actingAs($user)
            ->post(route('cart.store', $merchandise), ['quantity' => 2])
            ->assertRedirect();

        $response = $this->actingAs($user)
            ->post(route('checkout.store'), [
                'expedition_id' => $expedition->id,
                'postal_code' => '63511',
                'notes' => 'Tolong kirim cepat',
            ]);

        $order = Order::first();

        $response->assertRedirect(route('orders.show', $order));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => Order::STATUS_WAITING_PAYMENT,
            'subtotal' => 240000,
            'shipping_fee' => 15000,
            'total' => 255000,
        ]);
        $this->assertEquals(2, $order->items()->sum('quantity'));
        $this->assertTrue($order->payment_due_at->between(now()->addHours(47), now()->addHours(49)));
        $this->assertSame(8, $merchandise->fresh()->qty_stock);
        $this->assertSame(0, $user->cart()->first()->items()->count());
    }

    public function test_payment_proof_upload_and_admin_verification_work()
    {
        Storage::fake('public');

        $admin = User::factory()->role('admin')->create();
        $user = User::factory()->role('peserta')->create();
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'status' => Order::STATUS_WAITING_PAYMENT,
            'payment_due_at' => now()->addDay(),
        ]);

        $this->actingAs($user)
            ->post(route('orders.payment-proof', $order), [
                'payment_proof' => UploadedFile::fake()->image('proof.jpg'),
            ])
            ->assertRedirect();

        $order->refresh();

        $this->assertSame(Order::STATUS_WAITING_VERIFICATION, $order->status);
        Storage::disk('public')->assertExists($order->payment_proof_path);

        $this->actingAs($admin)
            ->post(route('admin.orders.verify', $order), [
                'verification_note' => 'Valid',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => Order::STATUS_PAID,
            'verified_by' => $admin->id,
        ]);
    }

    public function test_overdue_order_is_expired_and_stock_is_restored()
    {
        $user = User::factory()->role('peserta')->create();
        $merchandise = Merchandise::factory()->create([
            'qty_stock' => 0,
        ]);
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'status' => Order::STATUS_WAITING_PAYMENT,
            'payment_due_at' => now()->subHour(),
        ]);
        OrderItem::factory()->create([
            'order_id' => $order->id,
            'merchandise_id' => $merchandise->id,
            'quantity' => 2,
            'subtotal' => 100000,
        ]);

        $this->actingAs($user)
            ->get(route('orders.index'))
            ->assertOk();

        $this->assertSame(Order::STATUS_EXPIRED, $order->fresh()->status);
        $this->assertSame(2, $merchandise->fresh()->qty_stock);
    }
}
