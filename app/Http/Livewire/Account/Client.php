<?php

namespace App\Http\Livewire\Account;

use App\Models\Brand;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Client extends Component
{
    public function render()
    {
        $data =  Registration::where('user_id', Auth::id())->get();

        $data_on_process =  Registration::where('user_id', Auth::id())->where('status', 2)->get();
        $data_renewal =  Registration::where('user_id', Auth::id())->where('tipe_sertifikasi', 2)->get();
        $data_baru =  Registration::where('user_id', Auth::id())->where('tipe_sertifikasi', 1)->get();

        return view('livewire.account.client', [
            'data' => $data,
            'data_on_process' => count($data_on_process),
            'data_renewal' => count($data_renewal),
            'data_baru' => count($data_baru)
        ]);
    }
}
