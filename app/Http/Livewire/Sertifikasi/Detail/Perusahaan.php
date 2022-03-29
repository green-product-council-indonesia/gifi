<?php

namespace App\Http\Livewire\Sertifikasi\Detail;

use Livewire\Component;

class Perusahaan extends Component
{
    public $perusahaan;
    public function mount($perusahaan)
    {
        $this->perusahaan = $perusahaan;
    }
    public function render()
    {
        return view('livewire.sertifikasi.detail.perusahaan');
    }
}
