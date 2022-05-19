<?php

namespace App\Http\Livewire\Import;

use App\Models\Category;
use App\Models\DocumentCategory;
use Livewire\Component;

class ChecklistDokumen extends Component
{
    public $categories, $category, $docs;

    protected $listeners = [
        'tambahChecklist',
        'editChecklist', 'deleteChecklist'
    ];

    public function mount()
    {
        $this->categories =  Category::get();
    }

    // public function updatedCategory($value)
    // {
    //     // $this->reset('category');
    // }

    public function render()
    {
        $category = $this->category;
        $this->docs = DocumentCategory::with([
            'dokumen' => function ($q) use ($category) {
                $q->where('category_id', $category);
            },
            'kategori' => function ($q) use ($category) {
                $q->where('category_id', $category);
            }
        ])->whereHas('dokumen', function ($q) use ($category) {
            $q->where('category_id', $category);
        })->get();

        return view('livewire.import.checklist-dokumen')->extends('layouts.app');
    }

    public function tambahChecklist()
    {
    }
    public function editChecklist()
    {
    }
    public function deleteChecklist()
    {
    }
}
