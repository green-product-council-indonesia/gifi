<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Brand;
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
        $brand = Brand::with('verifikators')->findOrFail($id);
        $brand->verifikator = null;
        $brand->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Pembatalan Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Menghapus ' . $brand->verifikators->name . ' Dari Verifikator Brand ' . $brand->nama_brand);
        $this->emit('removeAssignment');
    }
}
