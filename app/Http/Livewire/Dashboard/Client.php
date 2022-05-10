<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Client extends Component
{
    public function render()
    {
        $data = Registration::where('user_id', Auth::id())->get();

        $data_is_processing = Registration::where('status', 2)->where('user_id', Auth::id())->get();

        $data_is_approved = Registration::where('status', 3)->where('user_id', Auth::id())->get();

        return view('livewire.dashboard.client', [
            'data' => $data,
            'data_is_processing' => count($data_is_processing),
            'data_is_approved' => $data_is_approved
        ]);
    }
}
