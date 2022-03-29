<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahChecklist extends ModalComponent
{
    public $nama_dokumen, $category;
    protected $rules = [
        'nama_dokumen' => 'required',
        'category' => 'required'
    ];
    protected $messages = [
        'required' => 'form ini harus diisi'
    ];
    public function render()
    {
        $categories = Category::where('id', '!=', 1)->get();
        return view('livewire.import.modal.tambah-checklist', [
            'categories' => $categories
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
            'nama_dokumen' => $this->nama_dokumen,
            'category_id' => $this->category
        ]);

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Menambah Item Checklist Dokumen GLI');
        $this->emit('tambahChecklist');
    }
}
