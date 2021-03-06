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
    public $doc, $doc_id, $ruas, $document, $data, $nama_dokumen, $nama_dokumen_edited = [];

    public function mount($id, $data)
    {
        $this->doc_id =  $id;
        $this->ruas =  $data;

        $this->doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->ruas);
        }])->findOrFail($this->doc_id);

        if ($this->doc->type == 'url') {
            $this->nama_dokumen = $this->doc->registration[0]->pivot->nama_dokumen;
        }
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

            if ($bujt->pivot->status == 2) {
                $this->validate([
                    'nama_dokumen_edited' => 'required',
                    'nama_dokumen_edited.*' => 'mimes:pdf|max:102400',
                ], [
                    'nama_dokumen_edited.*.max' => 'Dokumen harus berukuran maksimal 15MB',
                    'nama_dokumen_edited.*.mimes' => 'Dokumen harus berbentuk PDF',
                ]);
                # code...
                $i = 1;
                foreach ($this->nama_dokumen_edited as $data) {
                    dd($data);
                    preg_match("/(?:\w+(?:\W+|$)){0,10}/", $data->nama_dokumen, $matches);
                    $nama_file = Str::slug($bujt->nama_ruas) . '-' . Str::slug($doc->kode) . '-' . Str::slug($matches[0]) . '-edited-' . $i++;

                    # code...
                }
            } else {
                $this->validate([
                    'nama_dokumen' => 'mimes:pdf|max:102400',
                ], [
                    'nama_dokumen.max' => 'Dokumen harus berukuran maksimal 15MB',
                    'nama_dokumen.mimes' => 'Dokumen harus berbentuk PDF',
                ]);
                $file = $this->nama_dokumen;
                preg_match("/(?:\w+(?:\W+|$)){0,10}/", $doc->nama_dokumen, $matches);

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
            }
        } else {
            $this->validate([
                'nama_dokumen' => 'required',
            ], [
                'nama_dokumen.required' => 'Dokumen kosong, harap diisi',
            ]);

            $bujt->pivot->status = 1;
            $bujt->pivot->nama_dokumen = $this->nama_dokumen;
            $bujt->pivot->save();

            $this->nama_dokumen = null;
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
