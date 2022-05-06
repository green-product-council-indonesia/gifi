<?php

namespace App\Http\Livewire\Import;

use App\Models\Category;
use App\Models\DocumentCategory;
use Livewire\Component;

class ChecklistDokumen extends Component
{
    public $categories, $category_name;

    protected $listeners = [
        'tambahChecklist',
        'editChecklist', 'deleteChecklist'
    ];

    public function mount()
    {
        $this->categories =  Category::get();
    }
    public function render()
    {
        $category = $this->category_name;
        $docs = DocumentCategory::with(['dokumen' => function ($q) use ($category) {
            $q->where('category_id', $category);
        }, 'kategori' => function ($q) use ($category) {
            $q->where('category_id', $category);
        }])->whereHas('dokumen', function ($q) use ($category) {
            $q->where('category_id', $category);
        })->get();

        return view('livewire.import.checklist-dokumen', [
            'docs' => $docs
        ])->extends('layouts.app');
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
