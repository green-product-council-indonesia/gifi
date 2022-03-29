<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahBrand extends ModalComponent
{
    public $category;

    public function render()
    {
        return view('livewire.import.modal.tambah-brand');
    }

    protected $rules = [
        'category' => 'required',
    ];

    protected $messages = [
        'required' => 'form ini harus diisi',
    ];

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'xl';
    }

    public function tambahBrand()
    {
        $this->validate();

        Category::create([
            'categories' => $this->category
        ]);

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Menambahkan Kategori Brand ' . $this->category);
        $this->emit('tambahBrand');
    }
}
