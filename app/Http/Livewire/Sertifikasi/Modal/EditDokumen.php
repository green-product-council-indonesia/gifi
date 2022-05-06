<?php

namespace App\Http\Livewire\Sertifikasi\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;


class EditDokumen extends ModalComponent
{
    use WithFileUploads;
    public $doc_id, $ruas, $document, $data, $nama_dokumen;

    public function mount($id, $data)
    {
        $this->doc_id =  $id;
        $this->ruas =  $data;
    }

    public function render()
    {
        return view('livewire.sertifikasi.modal.edit-dokumen');
    }
    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'lg';
    }

    public function upload($id)
    {
        $doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->ruas);
        }])->findOrFail($id);

        $bujt = $doc->registration[0];

        if ($doc->type == 'file') {
            $this->validate([
                'nama_dokumen' => 'mimes:pdf,jpg,jpeg,png|max:5500',
            ], [
                'nama_dokumen.max' => 'Dokumen harus berukuran maksimal 5MB',
                'nama_dokumen.mimes' => 'Dokumen harus berbentuk JPG, JPEG atau PDF',
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

        $this->closeModal();
        activity()->log('User ' . Auth::user()->name . ' Meng-edit Item Checklist Dokumen ');
        $this->emit('editDokumen');
    }
}
