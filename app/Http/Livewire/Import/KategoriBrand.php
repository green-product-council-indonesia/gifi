<?php

namespace App\Http\Livewire\Import;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class KategoriBrand extends Component
{
    use WithPagination;
    public $search = '';
    public $paginate = 5;
    public $status_brand;

    public $sortBy = 'nama_brand';
    public $sortDirection = 'asc';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => ''],
        'sortDirection' => ['except' => ''],
    ];

    protected $listeners = [
        'tambahBrand', 'editBrand', 'deleteBrand'
    ];

    public function render()
    {
        $search = '%' . $this->search . '%';

        $categories = Category::where('categories', 'like', $search)->where('id', '!=', 1)->paginate($this->paginate);

        return view('livewire.import.kategori-brand', ['categories' => $categories])->extends('layouts.app');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function tambahBrand()
    {
    }
    public function editBrand()
    {
    }
    public function deleteBrand()
    {
    }
}
