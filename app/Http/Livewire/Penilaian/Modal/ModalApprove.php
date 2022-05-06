<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ModalApprove extends ModalComponent
{
    public $doc, $data;
    public function mount($id, $data_id)
    {
        $this->doc = $id;
        $this->data =  $data_id;
    }
    public function render()
    {
        return view('livewire.penilaian.modal.modal-approve');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'lg';
    }

    public function approveDokumen($id)
    {
        $doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->data);
        }])->findOrFail($id);

        $data = $doc->registration[0];

        $data->pivot->status = 2;
        $data->pivot->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Menyetujui Dokumen ' . $data->pivot->nama_dokumen . ' GIFI');
        $this->emit('approveDokumen');
    }
}
