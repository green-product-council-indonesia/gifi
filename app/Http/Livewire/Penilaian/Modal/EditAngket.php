<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\Category;
use App\Models\Docrating;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditAngket extends ModalComponent
{
    use WithFileUploads;

    public $category, $categories;
    public $angket_penilaian, $id_category;
    protected $messages = [
        'required' => 'form harus diisi',
        'mimes' => 'file harus dalam format xlsx / excel',
        'max' => 'batas ukuran file harus kurang dari 8MB'
    ];

    public function mount($category)
    {
        $this->category = Category::with('kategoriAngket')->findOrFail($category);
    }

    public function render()
    {
        $this->categories =
            Category::with('kategoriAngket')->whereNotIn('id', [1, $this->category])->get();
        return view('livewire.penilaian.modal.edit-angket');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return '2xl';
    }

    public function editAngket($id)
    {
        $this->validate([
            'angket_penilaian' => 'required|max:8192|mimes:xls,xlsx',
        ]);

        $doc = Docrating::findOrFail($id);
        if ($this->angket_penilaian) {
            if (isset($doc->angket_penilaian_doc)) {
                $directory = public_path('storage/template_angket/' . $doc->angket_penilaian_doc);
                if (file_exists($directory)) {
                    unlink($directory);
                }
            }

            $file = $this->angket_penilaian;
            $nama_file =
                'Angket-Penilaian-' . \Str::slug($this->category->categories);
            $data = $nama_file . '.' . $file->extension();

            $file->storeAs('template_angket/', $data);
            // dd($data);
            $doc->angket_penilaian_doc = $data;
            $doc->save();
        }

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Edit Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Mengubah Dokumen Angket Penilaian GLI');
        $this->emit('editAngket');
    }
}
