<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    public function getPosterUrlAttribute()
    {
        if (!$this->poster) {
            return asset('landing/images/BACKGROUND FFH 2026.png');
        }

        if (Str::startsWith($this->poster, ['http://', 'https://'])) {
            return $this->poster;
        }

        if (Str::startsWith($this->poster, ['landing/', 'img/', 'assets/'])) {
            return asset($this->poster);
        }

        return asset('storage/' . ltrim($this->poster, '/'));
    }
}
