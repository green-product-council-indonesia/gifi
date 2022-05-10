<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verifikator extends Component
{
    public function render()
    {
        $user_id = Auth::id();

        $brands = Registration::where('verifikator', $user_id)->get();
        $data = Registration::where('verifikator', $user_id)->where('status', 1)->get();
        $data_is_processing = Registration::where('verifikator', $user_id)->where('status', 2)->get();
        $data_is_approved = Registration::where('verifikator', $user_id)->where('status', 3)->get();

        return view('livewire.dashboard.verifikator', [
            'data' => count($data),
            'brands' => $brands,
            'data_is_processing' => $data_is_processing,
            'data_is_approved' => count($data_is_approved)
        ]);
    }
}
