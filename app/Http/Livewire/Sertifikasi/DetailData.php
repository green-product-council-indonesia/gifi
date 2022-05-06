<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Registration;
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
        $data = Registration::where('slug', $this->slug)->with('kategoriSertifikasi')->first();
        return view('livewire.sertifikasi.detail-data', [
            'data' => $data
        ])->extends('layouts.app');
    }
}
