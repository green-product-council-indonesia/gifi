<?php

namespace App\Http\Livewire\Penilaian;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Sertifikasi extends Component
{
    use WithPagination;
    public $search = '';
    public $paginate = 10;
    public $status;

    public function mount()
    {
    }
    public function render()
    {
        $search = '%' . $this->search . '%';
        $status = '%' . $this->status . '%';

        $role = Auth::user()->roles[0]->name;
        $id_user = Auth::user()->id;

        if ($role == 'verifikator') {
            $data = Registration::where('verifikator', $id_user)
                ->where(function ($q) use ($search) {
                    $q->where('nama_ruas', 'like', $search)
                        ->orWhere('nama_bujt', 'like', $search);
                })
                ->where('status', 'like', $status)
                ->with('verifikators', 'kategoriSertifikasi')
                ->paginate($this->paginate);
        } else {
            $data = Registration::with('kategoriSertifikasi')
                ->where(function ($q) use ($search) {
                    $q->where('nama_ruas', 'like', $search)
                        ->orWhere('nama_bujt', 'like', $search);
                })
                ->where('status', 'like', $status)
                ->paginate($this->paginate);
        }

        return view('livewire.penilaian.sertifikasi', [
            'data' => $data
        ])->extends('layouts.app');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
