<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ModalApprove extends ModalComponent
{
    public $doc_id, $registration_id, $catatan;
    public function mount($doc_id, $registration_id)
    {
        $this->doc_id = $doc_id;
        $this->registration_id =  $registration_id;
    }
    public function render()
    {
        return view('livewire.penilaian.modal.modal-approve');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'xl';
    }

    public function approveDokumen()
    {
        $doc = Document::with(['registration' => fn ($q) => $q->where('registrations.id', $this->registration_id)])->findOrFail($this->doc_id);
        $data = $doc->registration[0];

        $data->pivot->keterangan = $this->catatan;
        $data->pivot->status = 3;
        $data->pivot->save();

        $this->closeModal();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);

        activity()->log('User ' . Auth::user()->name . ' Menyetujui Dokumen ' . $data->pivot->nama_dokumen . ' GTRI');
        $this->emit('penilaianSertifikasi');
    }
}
