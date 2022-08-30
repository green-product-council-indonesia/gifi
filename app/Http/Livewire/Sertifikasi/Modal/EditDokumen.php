<?php

namespace App\Http\Livewire\Sertifikasi\Modal;

use App\Models\Document;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditDokumen extends ModalComponent
{
    use WithFileUploads;
    public $document_id, $registration_id, $nama_dokumen, $dokumen_edit;

    public function render()
    {
        return view('livewire.sertifikasi.modal.edit-dokumen');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'lg';
    }

    protected $rules = [
        'dokumen_edit' => 'required|mimes:pdf|max:102400'
    ];

    protected $messages = [
        'dokumen_edit.required' => 'Form ini Kosong, Harap Diisi',
        'dokumen_edit.max' => 'Dokumen harus berukuran maksimal 50MB',
        'dokumen_edit.mimes' => 'Dokumen harus berbentuk PDF',
    ];

    public function edit()
    {
        $this->validate();
        $doc = Document::with(['registration' => fn ($q) => $q->where('registrations.id', $this->registration_id)])->findOrFail($this->document_id);
        $bujt = $doc->registration[0];


        $files = $this->dokumen_edit;

        $path = 'storage/checklist-dokumen/' . $bujt->nama_bujt . '/' . $bujt->nama_ruas;
        $filename = $path  . '/' . $this->nama_dokumen;

        if (file_exists($filename)) unlink($filename);

        $files->storeAs('checklist-dokumen/' . $bujt->nama_bujt . '/' . $bujt->nama_ruas, $this->nama_dokumen);
        $this->dokumen_edit = null;

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);
        $this->closeModal();
    }
}
