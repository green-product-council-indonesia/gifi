<?php

namespace App\Http\Livewire\Approve\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ModalApprove extends ModalComponent
{
    public $doc, $selectedBrand;
    public function mount($id, $selectedBrand)
    {
        $this->doc = $id;
        $this->selectedBrand =  $selectedBrand;
    }
    public function render()
    {
        return view('livewire.approve.modal.modal-approve');
    }

    public function approveDokumen($id)
    {
        $document = Document::with('brand')->whereHas(
            "brand",
            function ($q) {
                $q->where("brands.id", $this->selectedBrand);
            }
        )->findOrFail($id);
        foreach ($document->brand as $doc) {
            if ($doc->id == $this->selectedBrand) {
                $doc->pivot->status = 2;
                $doc->pivot->save();

                $this->closeModal();
                $this->dispatchBrowserEvent(
                    'alert',
                    [
                        'type' => 'success',
                        'message' => 'Berhasil!'
                    ]
                );

                activity()->log('User ' . Auth::user()->name . ' Menyetujui Dokumen ' . $doc->pivot->nama_dokumen . ' GLI');
                $this->emit('approveDokumen');
            }
        }
    }
}
