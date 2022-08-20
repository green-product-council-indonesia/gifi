<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ModalAssign extends ModalComponent
{
    public $selected_ruas, $selected_verifikator;
    public $data, $user;

    public function mount()
    {
        $this->data = Registration::whereNull('verifikator')->select(['id', 'nama_ruas'])->get();
        $this->user = User::whereHas("roles", function ($q) {
            $q->where("name", "verifikator");
        })->select(['id', 'name'])->get();
    }
    public function render()
    {
        return view('livewire.penilaian.modal.modal-assign');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'lg';
    }
    public function assignVerifikator()
    {
        $brand = Registration::with('verifikators')->findOrFail($this->selected_ruas);
        $brand->verifikator =  $this->selected_verifikator;

        $brand->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'message' => 'Penugasan Berhasil!']
        );
        $this->log($this->selected_verifikator);
    }

    public function log($verifikator_id)
    {
        $data = Registration::with('verifikators')->where('verifikator', $verifikator_id)->first();
        activity()->log('User ' . Auth::user()->name . ' Menunjuk ' . $data->verifikators->name . ' Sebagai Verifikator Ruas Jalan ' . $data->nama_ruas);
        $this->emit('assignment');
    }
}
