<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahCatatan extends ModalComponent
{
    public $catatan;

    public $doc, $data;

    public function mount($id, $data_id)
    {
        $this->data = $data_id;
        $this->doc = $id;
    }
    public function render()
    {
        return view('livewire.penilaian.modal.tambah-catatan');
    }
    public function addCatatan($id)
    {
        $this->validate([
            'catatan' => 'required',
        ]);

        $doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->data);
        }])->findOrFail($id);

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
        activity()->log('User ' . Auth::user()->name . ' Menambah Catatan di Dokumen Sertifikasi GIFI');
        $this->emit('addCatatan');
    }
}
