<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Approval extends Component
{
    use WithPagination;
    public $paginate = 5, $status = '', $search = '';

    protected $listeners = [
        'approveUser'
    ];
    public function render()
    {
        $search = '%' . $this->search . '%';
        $status = '%' . $this->status . '%';

        $user = User::orderBy('created_at', 'desc')
            ->whereHas("roles", function ($q) {
                $q->where("name", "client");
            })
            ->orderBy('created_at', 'desc')
            ->where('status', 'like', $status)
            ->where('name', 'like', $search)
            ->paginate($this->paginate);

        return view('livewire.user.approval', [
            'users' => $user
        ])->extends('layouts.app');
    }

    public function approveUser()
    {
    }
}
