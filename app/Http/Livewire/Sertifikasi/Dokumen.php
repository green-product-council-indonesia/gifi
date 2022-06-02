<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Dokumen extends Component
{
    use WithFileUploads;
    public $data, $result, $ruas, $kategori, $categories;
    public $nama_dokumen;

    protected $listeners = [
        'editDokumen'
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->data = Registration::where('user_id', $user->id)->select('id', 'nama_ruas')->get();
        $this->categories = DocumentCategory::get();
        $this->result = collect();
    }

    public function render()
    {
        $this->result = Registration::with(
            [
                'document' =>
                function ($q) {
                    $q->where('documents.document_category_id', $this->kategori);
                }
            ]

        )->where('id', $this->ruas)->get();
        return view('livewire.sertifikasi.dokumen')->extends('layouts.app');
    }

    public function updatedRuas()
    {
        $this->reset('kategori');
        $this->result = collect();
    }


    public function uploadDokumen($id)
    {
        $doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->ruas);
        }])->findOrFail($id);

        $bujt = $doc->registration[0];

        if ($doc->type == 'file') {
            $this->validate([
                'nama_dokumen' => 'file|mimes:pdf|max:110000',
            ], [
                'nama_dokumen.max' => 'Dokumen harus berukuran maksimal 15MB',
                'nama_dokumen.mimes' => 'Dokumen harus berbentuk PDF',
            ]);

            $file = $this->nama_dokumen;
            preg_match("/(?:\w+(?:\W+|$)){0,5}/", $doc->nama_dokumen, $matches);

            $nama_file = Str::slug($bujt->nama_ruas) . '-' . Str::slug($doc->kode) . '-' . Str::slug($matches[0]);
            $data = $nama_file . '.' . $file->extension();

            $path = 'storage/checklist-dokumen/' . $bujt->nama_bujt . '/' . $bujt->nama_ruas;
            $filename = $path  . '/' . $data;

            if (file_exists($filename)) {
                unlink($filename);
            }

            $bujt->pivot->status = 1;
            $bujt->pivot->nama_dokumen = $data;
            $bujt->pivot->save();

            $file->storeAs('checklist-dokumen/' . $bujt->nama_bujt . '/' . $bujt->nama_ruas, $data);
            $this->nama_dokumen = null;
        } else {
            $this->validate([
                'nama_dokumen' => 'required',
            ], [
                'nama_dokumen.required' => 'Dokumen kosong, harap diisi',
            ]);

            $bujt->pivot->status = 1;
            $bujt->pivot->nama_dokumen = $this->nama_dokumen;
            $bujt->pivot->save();
        }

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
