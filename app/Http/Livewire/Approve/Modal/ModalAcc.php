<?php

namespace App\Http\Livewire\Approve\Modal;

use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class ModalAcc extends ModalComponent
{
    public $data, $tgl_approve, $no_sertifikat;

    public function mount($data)
    {
        $this->data = $data;
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

    public function approveSertifikasi()
    {

        $this->validate(
            [
                'tgl_approve' => 'required|date',
                'no_sertifikat' => 'required'
            ],
            [
                'required' => 'form ini harap isi terlebih dahulu'
            ]
        );

        $data = Registration::findOrFail($this->data);

        $data->status = 3;
        $data->no_sertifikasi = "GTRI-" . $this->no_sertifikat;
        $data->tgl_approve = Carbon::parse($this->tgl_approve);
        $data->tgl_masa_berlaku = Carbon::parse($this->tgl_approve)->addYear()->locale('id');
        $data->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Menyetujui Sertifikasi ' . $data->nama_ruas . ' yang dimiliki oleh ' . $data->nama_bujt);
        $this->emit('approveSertifikasi');
    }
}
