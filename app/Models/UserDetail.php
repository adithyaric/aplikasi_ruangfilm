<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'community_name',
        'provinsi_code',
        'provinsi_name',
        'kabupaten_code',
        'kabupaten_name',
        'kecamatan_code',
        'kecamatan_name',
        'desa_code',
        'desa_name',
        'username_ig',
        'posisi',
        'alamat_lengkap',
        'tanggal_lahir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
