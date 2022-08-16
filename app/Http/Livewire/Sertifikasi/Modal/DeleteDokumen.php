<?php

namespace App\Http\Livewire\Sertifikasi\Modal;

use App\Models\Document;
use LivewireUI\Modal\ModalComponent;

class DeleteDokumen extends ModalComponent
{
    public $document_id, $registration_id, $nama_dokumen;
    public function render()
    {
        return view('livewire.sertifikasi.modal.delete-dokumen');
    }

    public function delete()
    {
        $doc = Document::with(['registration' => fn ($q) => $q->where('registrations.id', $this->registration_id)])->findOrFail($this->document_id);
        $bujt = $doc->registration[0];

        $docs = json_decode($bujt->pivot->nama_dokumen);
        dd($docs);

        $path = 'storage/checklist-dokumen/' . $bujt->nama_bujt . '/' . $bujt->nama_ruas;
        $filename = $path  . '/' . $this->nama_dokumen;

        if (file_exists($filename)) unlink($filename);
        if (count($docs) > 1) {
            foreach ($docs as $doc) {
                if ($doc == $this->nama_dokumen) unset($doc);
                else $files[] = $doc;
            }
            $bujt->pivot->nama_dokumen = json_encode($files, 128);
        } else {
            $bujt->pivot->nama_dokumen = null;
            $bujt->pivot->status = 0;
        }

        $bujt->pivot->save();
        $this->emit('dokumen');

        $this->forceClose()->closeModal();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Dokumen Berhasil Dihapus!']);
    }
}
