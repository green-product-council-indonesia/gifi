<?php

namespace App\Http\Livewire\Penilaian;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class AssignVerifikator extends Component
{
    use WithPagination;
    public $search = '';
    public $paginate = 5;
    public $status_brand;

    protected $listeners = [
        'assignUser', 'removeAssignment'
    ];

    public function render()
    {
        $search = '%' . $this->search . '%';
        $brand = '%' . $this->status_brand . '%';

        $brand = Brand::with('verifikators', 'plant.perusahaan')
            ->where('nama_brand', 'like', $search)
            ->where('status', 'like', $brand)
            ->paginate($this->paginate);

        return view('livewire.penilaian.assign-verifikator', [
            'brands' => $brand
        ])->extends('layouts.app');
    }
    public function assignUser()
    {
    }
    public function removeAssignment()
    {
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
