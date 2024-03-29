<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class ApproveDokumen extends ModalComponent
{
    public $registration_id;
    public function render()
    {
        return view('livewire.penilaian.modal.approve-dokumen');
    }

    public function approve()
    {

        $data = Registration::findOrFail($this->registration_id);

        $data->status_dokumen = 3;
        $data->save();

        $this->closeModal();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);

        $this->emit('penilaianSertifikasi');
    }
}
