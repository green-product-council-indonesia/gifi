<?php

namespace App\Http\Livewire\Approve;

use App\Models\Brand;
use Livewire\Component;

class DetailSertifikasi extends Component
{
    protected $listeners = [
        'approveSertifikasi'
    ];
    public $brand;
    public function mount($slug)
    {
        $this->brand = Brand::with('ratings', 'kategoriProduk', 'plant.perusahaan')->where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.approve.detail-sertifikasi')->extends('layouts.app');
    }

    public function approveSertifikasi()
    {
    }
}
