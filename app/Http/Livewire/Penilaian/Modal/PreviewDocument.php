<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use LivewireUI\Modal\ModalComponent;

class PreviewDocument extends ModalComponent
{
    public $doc_id, $registration_id;

    protected $listeners = ['editDokumen'];

    public function render()
    {
        $doc = Document::with(['registration' => fn ($q) => $q->where('registrations.id', $this->registration_id)])->findOrFail($this->doc_id);

        return view('livewire.penilaian.modal.preview-document', [
            'doc' => $doc->registration[0]->pivot,
            'data' => $doc
        ]);
    }

    public function editDokumen()
    {
    }
}
