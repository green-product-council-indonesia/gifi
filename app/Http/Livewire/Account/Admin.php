<?php

namespace App\Http\Livewire\Account;

use App\Models\Registration;
use App\Models\User;
use Livewire\Component;

class Admin extends Component
{
    public function render()
    {
        $user = User::where('status', 0)->get();
        $data =  Registration::get();
        $data_on_process =  Registration::where('status', 2)->get();
        $data_success =  Registration::where('status', 3)->get();

        return view('livewire.account.admin', [
            'user' => count($user),
            'data' => $data,
            'data_on_process' => count($data_on_process),
            'data_success' => count($data_success),
        ]);
    }
}
