<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['categories'];

    public function kategoriSertifikasi()
    {
        return $this->hasMany(Registration::class);
    }

    public function kategoriDokumen()
    {
        return $this->belongsToMany(DocumentCategory::class, 'document_category_has_category')->withPivot('total_bobot');
    }
}
