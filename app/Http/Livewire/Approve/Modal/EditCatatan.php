<?php

namespace App\Http\Livewire\Approve\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditCatatan extends ModalComponent
{
    public $doc, $document, $selectedBrand, $catatan;
    public function mount($id, $selectedBrand, $data)
    {
        $this->doc = $id;
        $this->selectedBrand = $selectedBrand;
        $this->catatan = $data;
    }
    public function render()
    {
        return view('livewire.approve.modal.edit-catatan');
    }

    public function editCatatan()
    {
        $this->validate([
            'catatan' => 'required',
        ]);
        $document = Document::with('brand')->whereHas(
            "brand",
            function ($q) {
                $q->where("brands.id", $this->selectedBrand);
            }
        )->findOrFail($this->doc);

        foreach ($document->brand as $doc) {
            if ($doc->id == $this->selectedBrand) {
                $doc->pivot->keterangan = $this->catatan;
                $doc->pivot->save();

                $this->closeModal();
                $this->dispatchBrowserEvent(
                    'alert',
                    [
                        'type' => 'success',
                        'message' => 'Berhasil!'
                    ]
                );
                activity()->log('User ' . Auth::user()->name . ' Mengubah Catatan Keterangan Dokumen Sertifikasi GLI');
                $this->emit('editCatatan');
            }
        }
    }
}
