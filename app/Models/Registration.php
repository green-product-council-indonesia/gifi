<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_sertifikasi', 'nama_bujt', 'slug', 'alamat_operasional', 'email_operasional', 'noTelp_operasional', 'kodePos_operasional', 'nama_ruas', 'panjang_ruas', 'tgl_mulai_operasional', 'category_id', 'jumlah_rest_area', 'jumlah_gerbang_tol', 'jumlah_jembatan', 'jumlah_jpo', 'jumlah_underpass', 'jumlah_terowongan', 'jumlah_underpass_satwa', 'status', 'status_dokumen', 'note_dokumen', 'tipe_sertifikasi', 'tgl_pendaftaran', 'tgl_approve', 'tgl_masa_berlaku', 'contact', 'user_id', 'verifikator'
    ];

    public function document()
    {
        return $this->belongsToMany(Document::class, 'registration_document')->withPivot(
            'nama_dokumen',
            'nama_dokumen_edited',
            'status',
            'keterangan',
            'score',
            'document_category_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategoriSertifikasi()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function verifikators()
    {
        return $this->belongsTo(User::class, 'verifikator');
    }
    public function reports()
    {
        return $this->hasOne(Docreport::class);
    }
}
