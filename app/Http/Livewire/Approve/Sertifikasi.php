<?php

namespace App\Http\Livewire\Approve;

use App\Models\Brand;
use App\Models\Registration;
use Livewire\Component;
use Livewire\WithPagination;

class Sertifikasi extends Component
{
    use WithPagination;
    public $search = '';
    public $paginate = 10;
    public $status;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $status = '%' . $this->status . '%';

        $data = Registration::with('kategoriSertifikasi')
            ->where(function ($q) use ($search) {
                $q->where('nama_ruas', 'like', $search)
                    ->orWhere('nama_bujt', 'like', $search);
            })
            ->where('status', 'like', $status)
            ->paginate($this->paginate);

        return view('livewire.approve.sertifikasi', [
            'data' => $data
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
