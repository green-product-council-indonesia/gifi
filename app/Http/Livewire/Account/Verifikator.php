<?php

namespace App\Http\Livewire\Account;

use App\Models\Brand;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verifikator extends Component
{
    public function render()
    {
        $data =  Registration::where('verifikator', Auth::id())->get();

        $data_new =  Registration::where('status', 1)->where('verifikator', Auth::id())->get();
        $data_on_process =  Registration::where('status', 2)->where('verifikator', Auth::id())->get();
        $data_success =  Registration::where('status', 3)->where('verifikator', Auth::id())->get();

        return view('livewire.account.verifikator', [
            'data' => $data,
            'data_new' => count($data_new),
            'data_on_process' => count($data_on_process),
            'data_success' => count($data_success),
        ]);
    }
}
