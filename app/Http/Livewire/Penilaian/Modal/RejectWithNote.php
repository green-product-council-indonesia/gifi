<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class RejectWithNote extends ModalComponent
{
    public $catatan, $registration_id;
    public function render()
    {
        return view('livewire.penilaian.modal.reject-with-note');
    }
    public function reject()
    {
        $this->validate([
            'catatan' => 'required',
        ]);

        $data = Registration::findOrFail($this->registration_id);

        $data->status_dokumen = 2;
        $data->note_dokumen = $this->catatan;
        $data->save();

        $this->closeModal();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);
        $this->emit('penilaianSertifikasi');
    }
}
