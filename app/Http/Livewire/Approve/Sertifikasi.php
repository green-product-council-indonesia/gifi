<?php

namespace App\Http\Livewire\Approve;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Sertifikasi extends Component
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


    public function mount()
    {
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $brand = '%' . $this->status_brand . '%';

        $brand = Brand::with('plant.perusahaan')->orderBy($this->sortBy, $this->sortDirection)->where('nama_brand', 'like', $search)
            ->where('status', 'like', $brand)
            ->paginate($this->paginate);

        return view('livewire.approve.sertifikasi', [
            'brand' => $brand
        ])->extends('layouts.app');
    }

    public function sort($sort, $direction)
    {
        $this->sortBy = $sort;
        $this->sortDirection = $direction;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
