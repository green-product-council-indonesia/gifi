<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\DocumentCategory;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dokumen extends Component
{
    use WithFileUploads;
    public $data, $result, $registration_id, $kategori, $categories;
    public $nama_dokumen = [];

    protected $listeners = ['dokumen'];

    public function mount()
    {
        $user = Auth::user();
        $this->data = Registration::where('user_id', $user->id)->select('id', 'nama_ruas')->get();
        $this->categories = DocumentCategory::get();
        $this->result = collect();
    }

    public function render()
    {
        $this->result = Registration::with(['document' => fn ($q) => $q->where('documents.document_category_id', $this->kategori)])->where('id', $this->registration_id)->get();
        return view('livewire.sertifikasi.dokumen')->extends('layouts.app');
    }

    public function updatedRuas()
    {
        $this->reset('kategori');
        $this->result = collect();
    }

    public function resetError()
    {
        $this->resetErrorBag();
    }
    public function dokumen()
    {
    }
}
