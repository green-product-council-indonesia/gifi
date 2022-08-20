<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Account extends Component
{
    protected $listeners = [
        'editPassword'
    ];
    public function render()
    {
        $user_id = Auth::id();
        $user = User::with('roles')->find($user_id);

        return view('livewire.account', [
            'user' => $user,
        ])->extends('layouts.app');
    }

    public function editPassword()
    {
    }
}
