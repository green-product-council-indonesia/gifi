<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ModalAssign extends ModalComponent
{
    public $brand_selected, $verifikator_selected;
    public $brand, $user;

    public function mount()
    {
        $this->brand = Brand::whereNull('verifikator')->select(['id', 'nama_brand'])->get();
        $this->user = User::whereHas("roles", function ($q) {
            $q->where("name", "verifikator");
        })->select(['id', 'name'])->get();
    }
    public function render()
    {
        return view('livewire.penilaian.modal.modal-assign');
    }
    public function assignVerifikator()
    {
        $brand = Brand::with('verifikators')->findOrFail($this->brand_selected);
        $brand->verifikator =  $this->verifikator_selected;

        $brand->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success', 'message' => 'Penugasan Berhasil!']
        );
        $this->log($this->verifikator_selected);
    }

    public function log($verifikator_id)
    {
        $brand = Brand::with('verifikators')->where('verifikator', $verifikator_id)->first();
        activity()->log('User ' . Auth::user()->name . ' Menunjuk ' . $brand->verifikators->name . ' Sebagai Verifikator Brand ' . $brand->nama_brand);
        $this->emit('assignUser');
    }
}
