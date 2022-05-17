<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\DocumentCategory;
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
        $score = DocumentCategory::with([
            'kategori' => function ($q) use ($data) {
                $q->where('category_id', $data->category_id);
            },
            'dokumen' => function ($q) use ($data) {
                $q->where('category_id', $data->category_id);
            },
            'dokumen.registration' => function ($q) use ($data) {
                $q->where('registrations.id', $data->id);
            },
        ])->get();

        return view('livewire.sertifikasi.detail-data', [
            'data' => $data,
            'score' => $score
        ])->extends('layouts.app');
    }
}
