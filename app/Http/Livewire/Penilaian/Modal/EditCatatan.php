<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditCatatan extends ModalComponent
{
    public $doc, $document, $data_id, $catatan;
    public function mount($id, $data_id, $data)
    {
        $this->doc = $id;
        $this->data_id = $data_id;
        $this->catatan = $data;
    }
    public function render()
    {
        return view('livewire.penilaian.modal.edit-catatan');
    }

    public function editCatatan()
    {
        $this->validate([
            'catatan' => 'required',
        ]);

        $doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->data_id);
        }])->findOrFail($this->doc);

        $data = $doc->registration[0];

        $data->pivot->keterangan = $this->catatan;
        $data->pivot->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Mengubah Catatan Keterangan Dokumen Sertifikasi GTRI');
        $this->emit('editCatatan');
    }
}
