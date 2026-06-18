<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionSetting extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'open_at', 'close_at'];

    protected $casts = [
        'open_at'  => 'datetime',
        'close_at' => 'datetime',
    ];

    public function films()
    {
        return $this->hasMany(Film::class);
    }

    public function getDisplayNameAttribute()
    {
        return $this->name ?: 'Periode ' . optional($this->open_at)->format('F Y');
    }

    public function scopeActive($query)
    {
        $now = now();

        return $query->where('open_at', '<=', $now)
            ->where('close_at', '>=', $now);
    }

    public static function current()
    {
        return static::active()->orderBy('open_at')->first()
            ?: static::where('open_at', '>', now())->orderBy('open_at')->first()
            ?: static::orderByDesc('close_at')->first();
    }

    public static function currentActive()
    {
        return static::active()->orderBy('open_at')->first();
    }

    public static function isOpen()
    {
        return static::currentActive() !== null;
    }

    public static function overlaps($openAt, $closeAt, $ignoreId = null)
    {
        return static::when($ignoreId, function ($query) use ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        })->where(function ($query) use ($openAt, $closeAt) {
            $query->whereBetween('open_at', [$openAt, $closeAt])
                ->orWhereBetween('close_at', [$openAt, $closeAt])
                ->orWhere(function ($inner) use ($openAt, $closeAt) {
                    $inner->where('open_at', '<=', $openAt)
                        ->where('close_at', '>=', $closeAt);
                });
        })->exists();
    }

    public static function resolveForDate($date)
    {
        return static::where('open_at', '<=', $date)
            ->where('close_at', '>=', $date)
            ->orderBy('open_at')
            ->first();
    }
}
