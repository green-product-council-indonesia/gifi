<?php

namespace App\Http\Livewire\Approve\Modal;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ModalAcc extends ModalComponent
{
    public $scoring_id, $brand, $tgl_approve, $no_sertifikat;

    public function mount($brand)
    {
        $this->brand = $brand;
    }
    public function render()
    {
        return view('livewire.approve.modal.modal-acc');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return '2xl';
    }

    public function approveSertifikasi($id)
    {

        $this->validate(
            [
                'scoring_id' => 'required',
                'tgl_approve' => 'required|date',
                'no_sertifikat' => 'required'
            ],
            [
                'required' => 'harap isi scoring sertifikasi terlebih dahulu'
            ]
        );

        $brand = Brand::with('plant.perusahaan')->findOrFail($id);


        $brand->status = 3;
        $brand->scoring_id = $this->scoring_id;
        $brand->no_sertifikat = "GLI-" . $this->no_sertifikat;
        $brand->tgl_approve = Carbon::parse($this->tgl_approve);
        $brand->tgl_masa_berlaku = Carbon::parse($this->tgl_approve)->addYear()->locale('id');
        $brand->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Menyetujui Sertifikasi ' . $brand->nama_brand . ' yang dimiliki oleh ' . $brand->plant->perusahaan->nama_perusahaan);
        $this->emit('approveSertifikasi');
    }
}
