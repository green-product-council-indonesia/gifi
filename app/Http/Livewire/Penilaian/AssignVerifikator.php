<?php

namespace App\Http\Livewire\Penilaian;

use App\Models\Registration;
use Livewire\Component;
use Livewire\WithPagination;

class AssignVerifikator extends Component
{
    use WithPagination;
    public $search = '';
    public $paginate = 5;
    public $status;

    protected $listeners = [
        'assignment'
    ];

    public function render()
    {
        $search = '%' . $this->search . '%';
        $brand = '%' . $this->status . '%';

        $data = Registration::with('verifikators')
            ->where('nama_bujt', 'like', $search)
            ->orWhere('nama_ruas', 'like', $search)
            ->where('status', 'like', $brand)
            ->paginate($this->paginate);

        return view('livewire.penilaian.assign-verifikator', [
            'data' => $data
        ])->extends('layouts.app');
    }
    public function assignment()
    {
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
