<?php

namespace App\Http\Livewire\Account;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Client extends Component
{
    public function render()
    {
        $brand =  Brand::whereHas('plant', function ($q) {
            $q->whereHas(
                'perusahaan',
                function ($q) {
                    $q->where('user_id', Auth::id());
                }
            );
        })->get();

        $brand_on_process =  Brand::whereHas('plant', function ($q) {
            $q->whereHas(
                'perusahaan',
                function ($q) {
                    $q->where('user_id', Auth::id());
                }
            );
        })->where('status', 2)->get();

        $brand_renewal =  Brand::whereHas('plant', function ($q) {
            $q->whereHas(
                'perusahaan',
                function ($q) {
                    $q->where('user_id', Auth::id());
                }
            );
        })->where('jenis_sertifikasi', 2)->get();

        $brand_baru =  Brand::whereHas('plant', function ($q) {
            $q->whereHas(
                'perusahaan',
                function ($q) {
                    $q->where('user_id', Auth::id());
                }
            );
        })->where('jenis_sertifikasi', 1)->get();

        return view('livewire.account.client', [
            'brand' => $brand,
            'brand_on_process' => count($brand_on_process),
            'brand_renewal' => count($brand_renewal),
            'brand_baru' => count($brand_baru)
        ]);
    }
}
