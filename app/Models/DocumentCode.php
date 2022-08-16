<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentCode extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'nama_kriteria'];

    public function kode()
    {
        return $this->hasMany(Document::class);
    }
}
