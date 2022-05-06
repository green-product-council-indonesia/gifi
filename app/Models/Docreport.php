<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docreport extends Model
{
    use HasFactory;

    protected $fillable = [
        'angket_penilaian', 'laporan_ringkas_verifikasi', 'rekomendasi', 'registration_id'
    ];

    public function register()
    {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
