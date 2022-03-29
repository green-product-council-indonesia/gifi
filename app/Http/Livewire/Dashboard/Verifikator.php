<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verifikator extends Component
{
    public function render()
    {
        $user_id = Auth::id();

        $brands = Brand::where('verifikator', $user_id)->get();
        $brand = Brand::where('verifikator', $user_id)->where('status', 1)->get();
        $brand_is_processing = Brand::where('verifikator', $user_id)->where('status', 2)->get();
        $brand_is_approved = Brand::where('verifikator', $user_id)->where('status', 3)->get();

        return view('livewire.dashboard.verifikator', [
            'brand' => count($brand),
            'brands' => $brands,
            'brand_is_processing' => $brand_is_processing,
            'brand_is_approved' => count($brand_is_approved)
        ]);
    }
}
