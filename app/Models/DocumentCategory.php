<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori_dokumen'];
    public function dokumen()
    {
        return $this->hasMany(Document::class);
    }
}
