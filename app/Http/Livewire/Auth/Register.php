<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';
    public $no_telp = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'no_telp' => ['required'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->no_telp,
            'password' => Hash::make($this->password),
            'status' => 0
        ]);

        $user->assignRole('client');


        event(new Registered($user));

        // Auth::login($user, true);
        session()->flash('message', 'Terimakasih telah mendaftar, Harap menunggu aktivasi akun anda dari Pihak Administrator');
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
