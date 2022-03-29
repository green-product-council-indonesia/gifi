<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Brand;
use Livewire\Component;

class Visitor extends Component
{
    public function render()
    {
        $brands = Brand::get();
        $brand = Brand::where('status', 1)->get();
        $brand_is_processing = Brand::where('status', 2)->get();
        $brand_is_approved = Brand::where('status', 3)->get();
        return view('livewire.dashboard.visitor', [
            'brand' => count($brand),
            'brands' => $brands,
            'brand_is_processing' => $brand_is_processing,
            'brand_is_approved' => count($brand_is_approved)
        ]);
    }
}
