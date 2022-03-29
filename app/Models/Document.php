<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_dokumen', 'category_id'
    ];
    public function registration()
    {
        return $this->belongsToMany(Registration::class, 'registration_document')
            ->withPivot('nama_dokumen', 'status', 'keterangan', 'bobot', 'score');
    }

    public function kategoriSertifikasi()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
