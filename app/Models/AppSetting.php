<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class AppSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue($key, $default = null)
    {
        try {
            return optional(static::where('key', $key)->first())->value ?? $default;
        } catch (QueryException $exception) {
            return $default;
        }
    }

    public static function setValue($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value]
        );
    }

    public static function paymentDueHours()
    {
        return (int) static::getValue('payment_due_hours', 24);
    }

    public static function shippingOriginDestinationId()
    {
        $manualDestinationId = trim((string) static::getValue('shipping_origin_rajaongkir_destination_id', ''));

        if ($manualDestinationId !== '') {
            return $manualDestinationId;
        }

        $autoDestinationId = trim((string) static::getValue('shipping_origin_laravolt_auto_destination_id', ''));

        if ($autoDestinationId !== '') {
            return $autoDestinationId;
        }

        return trim((string) config('services.rajaongkir.fallback_origin_destination_id', config('services.rajaongkir.origin_destination_id')));
    }
}
