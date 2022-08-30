<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ApproveWithNote extends ModalComponent
{
    public $catatan, $registration_id;
    public function render()
    {
        return view('livewire.penilaian.modal.approve-with-note');
    }

    public function approveDokumen()
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
        activity()->log('User ' . Auth::user()->name . ' Menambah Catatan di Dokumen Sertifikasi GTRI');
        $this->emit('penilaianSertifikasi');
    }
}
