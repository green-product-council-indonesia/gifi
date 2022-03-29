<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Company;
use Livewire\Component;

class AllData extends Component
{
    public $search, $paginate = 5;
    public function render()
    {
        $search = '%' . $this->search . '%';

        $perusahaan = Company::with('plant.brand.document')->where('nama_perusahaan', 'like', $search)->paginate($this->paginate);
        return view('livewire.sertifikasi.all-data', [
            'perusahaan' => $perusahaan
        ])->extends('layouts.app');
    }
}
