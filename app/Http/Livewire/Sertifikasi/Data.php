<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Data extends Component
{
    public function render()
    {
        $id_user = Auth::user()->id;
        $perusahaan = Company::where('user_id', $id_user)->with('plant.brand.document')->first();

        return view('livewire.sertifikasi.data', [
            'perusahaan' => $perusahaan
        ])->extends(
            'layouts.app',
        );
    }
}
