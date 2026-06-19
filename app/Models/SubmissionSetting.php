<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubmissionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hero_title',
        'hero_description',
        'hero_image',
        'about_title',
        'about_description',
        'about_description_secondary',
        'about_image',
        'hashtag',
        'theme_title',
        'theme_name',
        'theme_quote',
        'theme_description',
        'theme_image',
        'festival_board',
        'last_year_title',
        'last_year_description',
        'last_year_catalog_label',
        'last_year_catalog_url',
        'open_at',
        'close_at',
    ];

    protected $casts = [
        'open_at' => 'datetime',
        'close_at' => 'datetime',
        'festival_board' => 'array',
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

    public function mediaUrl($path, $fallback = null)
    {
        if (!$path) {
            return $fallback ? asset($fallback) : null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, ['landing/', 'img/', 'assets/'])) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}
