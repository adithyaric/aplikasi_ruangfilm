<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public const CURATION_PENDING = 'pending';
    public const CURATION_UNDER_REVIEW = 'under_review';
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

    public function submissionReviews()
    {
        return $this->hasMany(SubmissionReview::class);
    }

    public function curationReviews()
    {
        return $this->submissionReviews()->stage(ReviewRubric::STAGE_CURATION);
    }

    public function juryReviews()
    {
        return $this->submissionReviews()->stage(ReviewRubric::STAGE_JURY);
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
            'pending'      => 'Menunggu Kurasi',
            'under_review' => 'Dalam Kurasi',
            'approved'     => 'Official Selection',
            'rejected'     => 'Ditolak Kurator',
            'winner'       => $this->winner_rank ?: 'Pemenang',
        ];

        return $labels[$status] ?? ucfirst($status);
    }

    public static function curationStatusLabels()
    {
        return [
            static::CURATION_PENDING => 'Menunggu Kurasi',
            static::CURATION_UNDER_REVIEW => 'Dalam Kurasi',
            static::CURATION_APPROVED => 'Official Selection',
            static::CURATION_REJECTED => 'Ditolak Kurator',
        ];
    }

    public static function curationStatuses()
    {
        return array_keys(static::curationStatusLabels());
    }

    public function averageScore()
    {
        $juryAverage = $this->averageReviewScore(ReviewRubric::STAGE_JURY);

        if ($juryAverage > 0) {
            return $juryAverage;
        }

        return round((float) $this->juryScores()->avg('score'), 2);
    }

    public function averageReviewScore($stage)
    {
        return round((float) $this->submissionReviews()->stage($stage)->avg('total_score'), 2);
    }

    public function reviewCount($stage)
    {
        return $this->submissionReviews()->stage($stage)->count();
    }
}
