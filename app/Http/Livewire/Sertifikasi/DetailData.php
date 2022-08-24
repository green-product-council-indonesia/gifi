<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Registration;
use Livewire\Component;

class DetailData extends Component
{
    public $slug, $data_id;
    public function mount($id, $slug)
    {
        $this->data_id = $id;
        $this->slug = $slug;
    }
    public function render()
    {
        $data = Registration::with('reports', 'kategoriSertifikasi')->findOrFail($this->data_id);
        return view('livewire.sertifikasi.detail-data', ['data' => $data])->extends('layouts.app');
    }
}
