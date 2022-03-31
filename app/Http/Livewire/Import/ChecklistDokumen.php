<?php

namespace App\Http\Livewire\Import;

use App\Models\Category;
use App\Models\Document;
use Livewire\Component;

class ChecklistDokumen extends Component
{
    // public $categories, $category_name;

    // protected $listeners = [
    //     'tambahChecklist', 'editChecklist', 'deleteChecklist'
    // ];

    public function mount()
    {
        $this->categories =  Category::get();
    }
    public function render()
    {
        // $docs = Document::with('brand', 'kategoriBrand')->where('category_id', $this->category_name)->get();

        return view('livewire.import.checklist-dokumen', [
            // 'docs' => $docs
        ])->extends('layouts.app');
    }

    // public function tambahChecklist()
    // {
    // }
    // public function editChecklist()
    // {
    // }
    // public function deleteChecklist()
    // {
    // }
}
