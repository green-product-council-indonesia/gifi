<?php

namespace App\Http\Livewire\Import;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentCategory;
use Livewire\Component;

class ChecklistDokumen extends Component
{
    public $categories, $category = 1, $document_category_id = 1;

    protected $listeners = [
        'tambahChecklist',
        'editChecklist',
        'deleteChecklist'
    ];

    public function mount()
    {
        $this->categories =  Category::get();
    }

    public function render()
    {
        $docs = DocumentCategory::with([
            'dokumen' => fn ($q) => $q->where('category_id', $this->category),
        ])->get();

        $documents = Document::where('document_category_id', $this->document_category_id)->where('category_id', $this->category)->get();
        return view('livewire.import.checklist-dokumen', ['docs' => $docs, 'documents' => $documents])->extends('layouts.app');
    }

    public function changeList($id)
    {
        $this->document_category_id = $id;
    }
    public function changeCategory($id)
    {
        $this->category = $id;
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
