<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    public const STATUS_WAITING_PAYMENT = 'waiting_payment';
    public const STATUS_WAITING_VERIFICATION = 'waiting_verification';
    public const STATUS_PAID = 'paid';
    public const STATUS_PAYMENT_REJECTED = 'payment_rejected';
    public const STATUS_EXPIRED = 'expired';

    protected $fillable = [
        'invoice_number',
        'user_id',
        'expedition_id',
        'expedition_name',
        'expedition_service_name',
        'recipient_name',
        'recipient_email',
        'recipient_phone',
        'province_name',
        'city_name',
        'district_name',
        'village_name',
        'postal_code',
        'full_address',
        'notes',
        'shipping_fee',
        'subtotal',
        'total',
        'status',
        'payment_due_at',
        'payment_proof_path',
        'payment_submitted_at',
        'verified_at',
        'verified_by',
        'verification_note',
        'rejection_note',
    ];

    protected $casts = [
        'shipping_fee' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
        'payment_due_at' => 'datetime',
        'payment_submitted_at' => 'datetime',
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expedition()
    {
        return $this->belongsTo(Expedition::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function canUploadProof()
    {
        return $this->status === static::STATUS_WAITING_PAYMENT
            && $this->payment_due_at
            && now()->lessThanOrEqualTo($this->payment_due_at);
    }

    public function normalizedPaymentProofPath()
    {
        $path = trim((string) $this->payment_proof_path);

        if ($path === '' || Str::startsWith($path, ['http://', 'https://'])) {
            return null;
        }

        if (Str::startsWith($path, 'storage/')) {
            return ltrim(Str::after($path, 'storage/'), '/');
        }

        return ltrim($path, '/');
    }

    public function paymentProofUrl()
    {
        $path = trim((string) $this->payment_proof_path);

        if ($path === '') {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    public function deleteStoredPaymentProof()
    {
        $path = $this->normalizedPaymentProofPath();

        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
