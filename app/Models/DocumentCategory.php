<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori_dokumen'];

    public function kategori()
    {
        return $this->belongsToMany(Category::class, 'document_category_has_category')->withPivot('total_bobot');
    }

    public function dokumen()
    {
        return $this->hasMany(Document::class);
    }
}
