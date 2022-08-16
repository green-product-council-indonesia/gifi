<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Category;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahChecklist extends ModalComponent
{
    public $kode, $nama_dokumen, $kategori_dokumen, $category, $bobot;
    protected $rules = [
        'kode' => 'required',
        'nama_dokumen' => 'required',
        'category' => 'required',
        'bobot' => 'required',
    ];
    protected $messages = [
        'required' => 'form ini harus diisi'
    ];

    public function render()
    {
        $categories = Category::get();
        $doc_categories = DocumentCategory::get();
        return view('livewire.import.modal.tambah-checklist', [
            'categories' => $categories,
            'doc_categories' => $doc_categories
        ]);
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return '3xl';
    }

    public function tambahChecklist()
    {
        $this->validate();

        Document::create([
            'kode' => $this->kode,
            'nama_dokumen' => $this->nama_dokumen,
            'bobot' => $this->bobot,
            'category_id' => $this->category,
            'document_category_id' => $this->kategori_dokumen,
        ]);

        $this->closeModal();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Berhasil!']);

        activity()->log('User ' . Auth::user()->name . ' Menambah Item Checklist Dokumen GLI');
        $this->emit('tambahChecklist');
    }
}
