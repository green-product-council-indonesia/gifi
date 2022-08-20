<?php

namespace App\Http\Livewire\Approve;

use App\Models\DocumentCategory;
use App\Models\Registration;
use Livewire\Component;

class DetailSertifikasi extends Component
{
    protected $listeners = [
        'approveSertifikasi'
    ];
    public $data, $score;
    public function mount($id, $slug)
    {
        $this->data = Registration::with('reports', 'kategoriSertifikasi')->findOrFail($id);
        $this->score = DocumentCategory::with([
            'kategori' => function ($q) {
                $q->where('category_id', $this->data->category_id);
            },
            'dokumen' => function ($q) {
                $q->where('category_id', $this->data->category_id);
            },
            'dokumen.registration' => function ($q) {
                $q->where('registrations.id', $this->data->id);
            },
        ])->get();
    }

    public function render()
    {
        return view('livewire.approve.detail-sertifikasi')->extends('layouts.app');
    }

    public function approveSertifikasi()
    {
    }
}
