<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditCatatan extends ModalComponent
{
    public $doc_id, $document, $registration_id, $catatan;
    public function mount($doc_id, $registration_id, $catatan)
    {
        $this->doc_id = $doc_id;
        $this->registration_id = $registration_id;
        $this->catatan = $catatan;
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
            $q->where('registrations.id', $this->registration_id);
        }])->findOrFail($this->doc_id);

        $data = $doc->registration[0];

        $data->pivot->keterangan = $this->catatan;
        $data->pivot->save();

        $this->closeModal();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);

        activity()->log('User ' . Auth::user()->name . ' Mengubah Catatan Keterangan Dokumen Sertifikasi GTRI');
        $this->emit('penilaianSertifikasi');
    }
}
