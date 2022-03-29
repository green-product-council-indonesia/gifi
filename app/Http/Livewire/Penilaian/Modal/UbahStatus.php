<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class UbahStatus extends ModalComponent
{
    public $brand;

    public function mount($brand)
    {
        $this->brand =  Brand::findOrFail($brand);
    }

    public function render()
    {
        return view('livewire.penilaian.modal.ubah-status');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'xl';
    }

    public function changeStatus($id)
    {
        $product = Brand::findOrFail($id);
        $product->status = 2;
        $product->save();

        $this->closeModal();
        activity()->log('User ' . Auth::user()->name . ' Menyetujui ' . $product->nama_brand . ' untuk Lanjut dalam Proses Penilaian ');
        $this->emit('status');
    }
}
