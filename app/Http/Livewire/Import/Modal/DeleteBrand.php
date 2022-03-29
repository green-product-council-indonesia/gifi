<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class DeleteBrand extends ModalComponent
{
    public $category_id;

    public function mount($category)
    {
        $this->category_id = $category;
    }

    public function render()
    {
        return view('livewire.import.modal.delete-brand');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'md';
    }

    public function deleteBrand($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Menghapus Kategori Brand ' . $category->categories);
        $this->emit('deleteBrand');
    }
}
