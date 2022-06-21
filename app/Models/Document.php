<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode', 'nama_dokumen', 'category_id', 'bobot', 'type', 'document_category_id'
    ];
    public function registration()
    {
        return $this->belongsToMany(Registration::class, 'registration_document')
            ->withPivot('nama_dokumen', 'nama_dokumen_edited', 'status', 'keterangan', 'score', 'document_category_id');
    }

    public function kategoriSertifikasi()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function kategoriDokumen()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }
}
