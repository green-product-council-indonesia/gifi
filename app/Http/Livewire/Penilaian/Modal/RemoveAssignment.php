<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class RemoveAssignment extends ModalComponent
{
    public $brand_id;
    public function mount($id)
    {
        $this->brand_id = $id;
    }
    public function render()
    {
        return view('livewire.penilaian.modal.remove-assignment');
    }

    public function remove($id)
    {
        $data = Registration::with('verifikators')->findOrFail($id);
        $data->verifikator = null;
        $data->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Pembatalan Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Menghapus ' . $data->verifikators->name . ' Dari Verifikator Ruas Jalan ' . $data->nama_ruas);
        $this->emit('assignment');
    }
}
