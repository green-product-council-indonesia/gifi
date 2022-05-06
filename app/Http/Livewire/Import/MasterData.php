<?php

namespace App\Http\Livewire\Import;

use App\Models\Category;
use Livewire\Component;

class MasterData extends Component
{
    protected $listeners = [
        'tambahBobot',
    ];
    public $category;

    public function mount()
    {
        $this->category = Category::with('kategoriDokumen')->get();
    }

    public function render()
    {
        return view('livewire.import.master-data')->extends('layouts.app');
    }

    public function tambahBobot()
    {
    }
}
