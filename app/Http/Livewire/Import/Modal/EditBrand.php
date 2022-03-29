<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditBrand extends ModalComponent
{
    public $category_name, $category, $name;

    public function mount($category)
    {
        $this->category = Category::findOrFail($category);
        $this->category_name = $this->category->categories;
    }

    public function render()
    {
        return view('livewire.import.modal.edit-brand');
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

    public function editBrand($id)
    {
        $this->validate();

        $category = Category::findOrFail($id);
        $category->categories = $this->category_name;
        $category->save();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Mengubah Nama Kategori Brand menjadi ' . $this->category_name);
        $this->emit('editBrand');
    }
}
