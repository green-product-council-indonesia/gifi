<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Brand;
use Livewire\Component;

class CetakSertifikat extends Component
{
    public $slug;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $brand = Brand::with('plant.perusahaan', 'kategoriProduk')->where('slug', $this->slug)->first();
        return view('livewire.sertifikasi.cetak-sertifikat', [
            'brand' => $brand
        ])->extends('layouts.auth');
    }
}
