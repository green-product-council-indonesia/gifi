<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Client extends Component
{
    public function render()
    {
        $brand = Brand::whereHas('plant', function ($q) {
            $q->whereHas('perusahaan', function ($x) {
                $x->where('user_id', Auth::id());
            });
        })->get();

        $brand_is_processing = Brand::with('plant.perusahaan.user')->where('status', 2)->whereHas(
            'plant',
            function ($q) {
                $q->whereHas('perusahaan', function ($x) {
                    $x->where('user_id', Auth::id());
                });
            }
        )->get();

        $brand_is_approved = Brand::with('plant.perusahaan.user')->where('status', 3)->whereHas(
            'plant',
            function ($q) {
                $q->whereHas('perusahaan', function ($x) {
                    $x->where('user_id', Auth::id());
                });
            }
        )->get();

        return view('livewire.dashboard.client', [
            'brand' => $brand,
            'brand_is_processing' => count($brand_is_processing),
            'brand_is_approved' => $brand_is_approved
        ]);
    }
}
