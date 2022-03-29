<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Brand;
use App\Models\User;
use Livewire\Component;

class Admin extends Component
{
    public function render()
    {
        $users = User::where('status', 0)->get();
        $brand_is_processing = Brand::where('status', 2)->get();
        $brand_is_approved = Brand::with('plant.perusahaan')->where('status', 3)->inRandomOrder()->get();
        return view('livewire.dashboard.admin', [
            'users' => $users,
            'brand_is_processing' => $brand_is_processing,
            'brand_is_approved' => $brand_is_approved
        ]);
    }
}
