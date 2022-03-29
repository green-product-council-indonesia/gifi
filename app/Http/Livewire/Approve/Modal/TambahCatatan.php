<?php

namespace App\Http\Livewire\Approve\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahCatatan extends ModalComponent
{
    public $catatan;

    public $document_id, $selectedBrand;

    public function mount($id, $selectedBrand)
    {
        $this->selectedBrand = $selectedBrand;
        $this->document_id = $id;
    }
    public function render()
    {
        return view('livewire.approve.modal.tambah-catatan');
    }
    public function addCatatan($id)
    {
        $this->validate([
            'catatan' => 'required',
        ]);
        $document = Document::with('brand')->whereHas(
            "brand",
            function ($q) {
                $q->where("brands.id", $this->selectedBrand);
            }
        )->findOrFail($id);

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
                activity()->log('User ' . Auth::user()->name . ' Menambah Catatan di Dokumen Sertifikasi GLI');
                $this->emit('addCatatan');
            }
        }
    }
}
