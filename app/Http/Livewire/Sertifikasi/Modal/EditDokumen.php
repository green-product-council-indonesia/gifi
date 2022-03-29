<?php

namespace App\Http\Livewire\Sertifikasi\Modal;

use App\Models\Brand;
use App\Models\Company;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;


class EditDokumen extends ModalComponent
{
    use WithFileUploads;
    public $dokumen, $document, $produk, $nama_dokumen;
    public function mount($id, $produk)
    {
        $this->dokumen =  $id;
        $this->produk =  $produk;

        $this->nama_perusahaan = Company::whereHas('plant', function ($q) {
            $q->whereHas('brand', function ($q) {
                $q->where('id', $this->produk);
            });
        })->value('nama_perusahaan');

        $this->document = Document::with('brand')
            ->where('id', $this->dokumen)
            ->whereHas('brand', function ($q) {
                $q->where('brands.id', $this->produk);
            })
            ->first();
    }
    public function render()
    {
        return view('livewire.sertifikasi.modal.edit-dokumen');
    }

    public function upload($id, $nama_dokumen)
    {
        $this->validate([
            'nama_dokumen' => 'mimes:pdf,jpg,jpeg,png|max:5500',
        ], [
            'nama_dokumen.max' => 'Dokumen harus berukuran maksimal 5MB',
            'nama_dokumen.mimes' => 'Dokumen harus berbentuk JPG, JPEG atau PDF',
        ]);

        $document = Brand::whereHas(
            "document",
            function ($q) {
                $q->where("documents.id", $this->dokumen);
            }
        )->findOrFail($id);

        $file = $this->nama_dokumen;
        $nama_file =
            Str::slug($this->nama_perusahaan) . '-' . Str::slug($document->nama_brand) . '-' .
            Str::slug($nama_dokumen);
        $data = $nama_file . '.' . $file->extension();

        $path = 'storage/checklist-dokumen/' . $this->nama_perusahaan;
        $filename = $path  . '/' . $data;

        foreach ($document->document as $doc) {
            if ($doc->id == $this->dokumen) {
                if (file_exists($filename)) {
                    unlink($filename);
                }
                $doc->pivot->nama_dokumen = $data;
                $doc->pivot->save();
            }
        }

        $file->storeAs('checklist-dokumen/' . $this->nama_perusahaan, $data);
        $this->nama_dokumen = null;

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Meng-edit Item Checklist Dokumen ');
        $this->emit('editDokumen');
        // return back();
    }
}
