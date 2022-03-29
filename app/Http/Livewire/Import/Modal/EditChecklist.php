<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditChecklist extends ModalComponent
{
    public $document, $nama_dokumen;
    public function mount($id)
    {
        $this->document = Document::findOrFail($id);
        $this->nama_dokumen = $this->document->nama_dokumen;
    }
    public function render()
    {
        return view('livewire.import.modal.edit-checklist');
    }

    protected $rules = [
        'nama_dokumen' => 'required',
    ];

    protected $messages = [
        'required' => 'form ini harus diisi'
    ];

    public function editChecklist($id)
    {
        $this->validate();

        $doc = Document::findOrFail($id);
        $doc->nama_dokumen = $this->nama_dokumen;
        $doc->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Mengubah Item Checklist Dokumen GLI');
        $this->emit('editChecklist');
    }
}
