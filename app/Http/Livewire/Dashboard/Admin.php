<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Registration;
use App\Models\User;
use Livewire\Component;

class Admin extends Component
{
    public function render()
    {
        $users = User::where('status', 0)->get();
        $data_is_processing = Registration::where('status', 2)->get();
        $data_is_approved = Registration::where('status', 3)->inRandomOrder()->get();
        return view('livewire.dashboard.admin', [
            'users' => $users,
            'data_is_processing' => $data_is_processing,
            'data_is_approved' => $data_is_approved
        ]);
    }
}
