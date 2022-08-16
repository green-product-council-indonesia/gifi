<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class SubmitScore extends ModalComponent
{
    public $doc_id, $registration_id, $score;
    public function render()
    {
        return view('livewire.penilaian.modal.submit-score');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'sm';
    }
    protected $rules = [
        'score' => 'required|numeric'
    ];
    protected $messages = [
        'required' => 'kolom :attribute kosong, harap diisi',
        'numeric' => 'kolom :attribute harus berupa angka',
    ];
    public function submit()
    {
        $this->validate();

        $doc = Document::with(['registration' => fn ($q) => $q->where('registrations.id', $this->registration_id)])->findOrFail($this->doc_id);
        $data = $doc->registration[0];

        $data->pivot->score = $this->score;
        $data->pivot->save();

        $this->closeModal();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);

        $this->emit('penilaianSertifikasi');
    }
}
