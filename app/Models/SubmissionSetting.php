<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionSetting extends Model
{
    use HasFactory;

    protected $fillable = ['open_at', 'close_at'];

    protected $casts = [
        'open_at'  => 'datetime',
        'close_at' => 'datetime',
    ];

    // Ambil setting aktif (selalu hanya 1 row)
    public static function current()
    {
        return static::first();
    }

    // Cek apakah submission sedang dibuka
    public static function isOpen()
    {
        $setting = static::current();
        if (!$setting) return false;

        $now = now();
        return $now->greaterThanOrEqualTo($setting->open_at)
            && $now->lessThanOrEqualTo($setting->close_at);
    }
}
