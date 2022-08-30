<?php

namespace App\Http\Livewire\Sertifikasi\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;

class UploadDokumen extends ModalComponent
{
    use WithFileUploads;
    public $doc_id, $registration_id, $nama_dokumen = [], $nama_dokumen_url;

    public function render()
    {
        return view('livewire.sertifikasi.modal.upload-dokumen');
    }
    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'lg';
    }

    protected $rules = [
        'nama_dokumen' => 'required',
        'nama_dokumen.*' => 'mimes:pdf|max:102400',
    ];

    protected $messages = [
        'nama_dokumen.required' => 'Form ini Kosong, Harap Diisi',
        'nama_dokumen.*.max' => 'Dokumen harus berukuran maksimal 15MB',
        'nama_dokumen.*.mimes' => 'Dokumen harus berbentuk PDF',
    ];

    public function upload()
    {
        $this->validate();
        $doc = Document::with(['registration' => fn ($q) => $q->where('registrations.id', $this->registration_id)])->findOrFail($this->doc_id);
        $bujt = $doc->registration[0];


        $i = 1;
        foreach ($this->nama_dokumen as $data) {
            $file = $data->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);

            $nama_file = $this->registration_id . '-' . $this->doc_id . '-' . Str::slug($doc->kode) . '-' . Str::slug($fileName) . '-' . $i++;
            $dokumen = $nama_file . '.' . $data->extension();

            $path = 'storage/checklist-dokumen/' . $bujt->nama_bujt . '/' . $bujt->nama_ruas;

            $filepath  = $path  . '/' . $dokumen;

            if (file_exists($filepath)) unlink($filepath);

            $data->storeAs('checklist-dokumen/' . $bujt->nama_bujt . '/' . $bujt->nama_ruas, $dokumen);
            $files[] = $dokumen;
        }

        $bujt->pivot->status = 1;
        $bujt->pivot->nama_dokumen = json_encode($files, 128);
        $bujt->pivot->save();

        $this->nama_dokumen = [];

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);
        $this->closeModal();

        activity()->log('User ' . Auth::user()->name . ' Meng-upload Item Checklist Dokumen ');
        $this->emit('dokumen');
    }

    public function removeDocument($index)
    {
        array_splice($this->nama_dokumen, $index);
    }
}
