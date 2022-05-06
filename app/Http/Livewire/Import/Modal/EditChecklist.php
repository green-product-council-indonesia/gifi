<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditChecklist extends ModalComponent
{
    public $document, $kode, $nama_dokumen, $kategori_dokumen, $category, $bobot, $type;
    public function mount($id)
    {
        $this->document = Document::findOrFail($id);
        $this->nama_dokumen = $this->document->nama_dokumen;
        $this->kategori_dokumen = $this->document->document_category_id;
        $this->category = $this->document->category_id;
        $this->bobot = $this->document->bobot;
        $this->type = $this->document->type;
        $this->kode = $this->document->kode;
    }
    public function render()
    {
        $categories = Category::get();
        $doc_categories = DocumentCategory::get();
        return view(
            'livewire.import.modal.edit-checklist',
            [
                'categories' => $categories,
                'doc_categories' => $doc_categories
            ]
        );
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return '3xl';
    }

    protected $rules = [
        'nama_dokumen' => 'required',
    ];

    protected $messages = [
        'required' => 'form ini harus diisi'
    ];

    public function editChecklist($id)
    {
        $this->validate();

        $doc = Document::findOrFail($id);
        $doc->kode = $this->kode;
        $doc->nama_dokumen = $this->nama_dokumen;
        $doc->document_category_id = $this->kategori_dokumen;
        $doc->category_id = $this->category;
        $doc->bobot = $this->bobot;
        $doc->type = $this->type;
        $doc->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Mengubah Item Checklist Dokumen GTRI');
        $this->emit('editChecklist');
    }
}
