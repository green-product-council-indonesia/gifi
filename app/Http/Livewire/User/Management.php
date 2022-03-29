<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Management extends Component
{
    use WithPagination;
    public $paginate = 5, $status = '', $search = '', $role = '';

    protected $listeners = [
        'addUser', 'deleteUser'
    ];

    public function render()
    {
        $search = '%' . $this->search . '%';
        $status = '%' . $this->status . '%';
        $role = '%' . $this->role . '%';
        // $role = $this->role;

        $users = User::with('roles')
            ->whereHas("roles", function ($q) {
                if ($this->role) {
                    $q->where("name",  $this->role);
                }
            })
            ->orderBy('created_at', 'desc')
            ->where('name', 'like', $search)
            ->where('status', 'like', $status)
            ->paginate($this->paginate);


        return view('livewire.user.management', [
            'users' => $users,
        ])->extends('layouts.app');
    }

    public function addUser()
    {
    }
    public function deleteUser()
    {
    }
}
