<?php

namespace App\Http\Livewire\Penilaian;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Sertifikasi extends Component
{

    use WithPagination;
    public $search = '';
    public $paginate = 5;
    public $status_brand;

    public function mount()
    {
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $brand = '%' . $this->status_brand . '%';

        $brand = User::with(['brands' => function ($q) use ($search, $brand) {
            $q->where('nama_brand', 'like', $search);
            $q->where('status', 'like', $brand);
        }])
            ->where('id', Auth::user()->id)
            ->whereHas("brands", function ($q) use ($search, $brand) {
                $q->where('nama_brand', 'like', $search);
                $q->where('status', 'like', $brand);
            })->paginate($this->paginate);

        return view('livewire.penilaian.sertifikasi', [
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
