<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Brand;
use App\Models\Company;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Dokumen extends Component
{
    use WithFileUploads;
    public $company, $document, $brand, $produk, $nama_dokumen, $nama_perusahaan;

    protected $listeners = [
        'editDokumen'
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->company = Company::where('user_id', $user->id)->with('plant.brand.document')->get();
    }
    public function render()
    {
        $produk = $this->produk;

        $this->nama_perusahaan = Company::whereHas('plant', function ($q) {
            $q->whereHas('brand', function ($q) {
                $q->where('id', $this->produk);
            });
        })->value('nama_perusahaan');

        $this->document = Brand::with('document')->withCount('document')->where('id', $produk)->first();

        return view('livewire.sertifikasi.dokumen')->extends('layouts.app');
    }

    public function uploadDokumen($id, $nama_dokumen)
    {
        $this->validate([
            'nama_dokumen' => 'mimes:pdf,jpg,jpeg,png|max:5500',
        ], [
            'nama_dokumen.max' => 'Dokumen harus berukuran maksimal 5MB',
            'nama_dokumen.mimes' => 'Dokumen harus berbentuk JPG, JPEG atau PDF',
        ]);

        $document = Document::whereHas(
            "brand",
            function ($q) {
                $q->where("brands.id", $this->produk);
            }
        )->findOrFail($id);

        $file = $this->nama_dokumen;
        $nama_file =
            Str::slug($this->nama_perusahaan) . '-' . Str::slug($this->document->nama_brand) . '-' .
            Str::slug($nama_dokumen);
        $data = $nama_file . '.' . $file->extension();

        $path = 'storage/checklist-dokumen/' . $this->nama_perusahaan;
        $filename = $path  . '/' . $data;

        foreach ($document->brand as $doc) {
            if ($doc->id == $this->produk) {
                if (file_exists($filename)) {
                    unlink($filename);
                }
                $doc->pivot->status = 1;
                $doc->pivot->nama_dokumen = $data;
                $doc->pivot->save();
            }
        }

        $file->storeAs('checklist-dokumen/' . $this->nama_perusahaan, $data);
        $this->nama_dokumen = null;

        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Meng-upload Item Checklist Dokumen ');
        return back();
    }

    public function resetError()
    {
        $this->resetErrorBag();
    }
    public function editDokumen()
    {
    }
}
