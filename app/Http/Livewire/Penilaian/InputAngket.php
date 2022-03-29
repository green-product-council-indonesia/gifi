<?php

namespace App\Http\Livewire\Penilaian;

use App\Models\Category;
use App\Models\Docrating;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class InputAngket extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $search = '';
    public $paginate = 5;


    // public $sortBy = 'nama_brand';
    // public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        // 'sortBy' => ['except' => ''],
        // 'sortDirection' => ['except' => ''],
    ];

    public $angket_penilaian_doc, $category_id;
    protected $messages = [
        'required' => 'form harus diisi',
        'mimes' => 'file harus dalam format xlsx / excel',
        'max' => 'batas ukuran file harus kurang dari 8MB'
    ];

    protected $listeners = ['editAngket' => 'angket'];

    public function render()
    {
        $search = '%' . $this->search . '%';
        $category_list = Category::where('id', '!=', 1)->get();
        $category = Category::with('kategoriAngket')->where('id', '!=', 1)->where('categories', 'like', $search)->paginate($this->paginate);

        return view('livewire.penilaian.input-angket', [
            'categories' => $category,
            'list' => $category_list
        ])->extends('layouts.app');
    }

    public function angketPenilaian()
    {
        $this->validate([
            'angket_penilaian_doc' => 'required|max:8192|mimes:xls,xlsx',
            'category_id' => 'required'
        ]);

        $category = Category::find($this->category_id);
        if ($category) {
            $file = $this->angket_penilaian_doc;

            $nama_file =
                'Angket-Penilaian-' . $category->categories;
            $data = $nama_file . '.' . $file->extension();

            $file->storeAs('template_angket/', $data);
            // dd($data);
            Docrating::create([
                'angket_penilaian_doc' => $data,
                'category_id' => $this->category_id
            ]);

            $this->angket_penilaian_doc = '';
            $this->category_id = '';

            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => 'Upload Berhasil!'
                ]
            );
            return back();
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'error',
                    'message' => 'Upload Gagal!'
                ]
            );
        }
    }

    public function angket()
    {
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
