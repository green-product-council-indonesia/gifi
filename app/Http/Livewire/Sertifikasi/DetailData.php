<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Company;
use Livewire\Component;

class DetailData extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $perusahaan = Company::with('plant.brand.document')->where('slug', $this->slug)->first();
        return view('livewire.sertifikasi.detail-data', [
            'perusahaan' => $perusahaan
        ])->extends('layouts.app');
    }
}
