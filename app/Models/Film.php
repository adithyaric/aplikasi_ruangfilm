<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public const CURATION_PENDING = 'pending';
    public const CURATION_APPROVED = 'approved';
    public const CURATION_REJECTED = 'rejected';

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function submissionSetting()
    {
        return $this->belongsTo(SubmissionSetting::class);
    }

    public function juryScores()
    {
        return $this->hasMany(JuryScore::class);
    }

    public function getDisplayStatusAttribute()
    {
        if ($this->winner_rank) {
            return 'winner';
        }

        return $this->curation_status ?: static::CURATION_PENDING;
    }

    public function getDisplayStatusLabelAttribute()
    {
        $status = $this->display_status;

        $labels = [
            'pending'  => 'Menunggu Kurasi',
            'approved' => 'Lolos Kurasi',
            'rejected' => 'Ditolak Kurator',
            'winner'   => $this->winner_rank ?: 'Pemenang',
        ];

        return $labels[$status] ?? ucfirst($status);
    }

    public function averageScore()
    {
        return round((float) $this->juryScores()->avg('score'), 2);
    }
}
