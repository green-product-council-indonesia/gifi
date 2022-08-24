<?php

namespace App\Http\Livewire\Approve;

use App\Models\Registration;
use Livewire\Component;

class DetailSertifikasi extends Component
{
    protected $listeners = [
        'approveSertifikasi'
    ];
    public $data;
    public function mount($id, $slug)
    {
        $this->data = Registration::with('reports', 'kategoriSertifikasi')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.approve.detail-sertifikasi')->extends('layouts.app');
    }

    public function approveSertifikasi()
    {
    }
}
