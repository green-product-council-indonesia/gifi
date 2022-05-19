<?php

namespace App\Http\Livewire\User\Modal;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class AddUser extends ModalComponent
{
    public $name, $email, $role;
    public $roles;

    public function mount()
    {
        $this->roles =
            Role::get()->where("name", '!=', "client");
    }
    public function render()
    {
        return view('livewire.user.modal.add-user');
    }

    public function addUser()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => 'required'
        ]);
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt('gtri12345'),
            'status' => 1
        ]);
        $user->assignRole($this->role);

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'success',  'message' => 'User Created Successfully!']
        );
        activity()->log('User ' . Auth::user()->name . ' Menambahkan User ' . $user->name);
        $this->emit('addUser');
    }
}
