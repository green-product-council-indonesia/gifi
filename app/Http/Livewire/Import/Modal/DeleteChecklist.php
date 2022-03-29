<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class DeleteChecklist extends ModalComponent
{
    public $doc_id;

    public function mount($id)
    {
        $this->doc_id = $id;
    }

    public function render()
    {
        return view('livewire.import.modal.delete-checklist');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'md';
    }

    public function deleteChecklist($id)
    {
        $doc = Document::findOrFail($id);
        $doc->delete();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Menghapus Item Checklist Dokumen GLI');
        $this->emit('deleteChecklist');
    }
}
