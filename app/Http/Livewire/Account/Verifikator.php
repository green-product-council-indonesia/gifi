<?php

namespace App\Http\Livewire\Account;

use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verifikator extends Component
{
    public function render()
    {
        $brand =  Brand::where('verifikator', Auth::id())->get();

        $brand_new =  Brand::where('status', 1)->where('verifikator', Auth::id())->get();
        $brand_on_process =  Brand::where('status', 2)->where('verifikator', Auth::id())->get();
        $brand_success =  Brand::where('status', 3)->where('verifikator', Auth::id())->get();

        return view('livewire.account.verifikator', [
            'brand' => $brand,
            'brand_new' => count($brand_new),
            'brand_on_process' => count($brand_on_process),
            'brand_success' => count($brand_success),
        ]);
    }
}
