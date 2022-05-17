<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditScore extends ModalComponent
{
    public $doc, $data_id, $score;

    public function mount($id, $data_id, $data)
    {
        $this->doc = $id;
        $this->data_id = $data_id;
        $this->score = $data;
    }

    public function render()
    {
        return view('livewire.penilaian.modal.edit-score');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'sm';
    }

    public function editScore()
    {
        $this->validate([
            'score' => 'required',
        ]);

        $doc = Document::with(['registration' => function ($q) {
            $q->where('registrations.id', $this->data_id);
        }])->findOrFail($this->doc);

        $data = $doc->registration[0];

        $data->pivot->score = $this->score;
        $data->pivot->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Mengubah Score Dokumen Sertifikasi GTRI');
        $this->emit('editScore');
    }
}
