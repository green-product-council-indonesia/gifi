<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahCatatan extends ModalComponent
{
    public $catatan;

    public $doc_id, $registration_id;

    public function mount($doc_id, $registration_id)
    {
        $this->registration_id = $registration_id;
        $this->doc_id = $doc_id;
    }
    public function render()
    {
        return view('livewire.penilaian.modal.tambah-catatan');
    }
    public function addCatatan()
    {
        $this->validate([
            'catatan' => 'required',
        ]);

        $doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->registration_id);
        }])->findOrFail($this->doc_id);

        $data = $doc->registration[0];

        $data->pivot->status = 2;
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
        activity()->log('User ' . Auth::user()->name . ' Menambah Catatan di Dokumen Sertifikasi GTRI');
        $this->emit('penilaianSertifikasi');
    }
}
