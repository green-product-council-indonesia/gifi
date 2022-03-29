<?php

namespace App\Http\Livewire\Account;

use App\Models\Brand;
use App\Models\User;
use Livewire\Component;

class Admin extends Component
{
    public function render()
    {
        $user = User::where('status', 0)->get();
        $brand =  Brand::get();
        $brand_on_process =  Brand::where('status', 2)->get();
        $brand_success =  Brand::where('status', 3)->get();

        return view('livewire.account.admin', [
            'user' => count($user),
            'brand' => $brand,
            'brand_on_process' => count($brand_on_process),
            'brand_success' => count($brand_success),
        ]);
    }
}
