<?php

namespace App\Http\Livewire\User\Modal;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class DeleteUser extends ModalComponent
{
    public $user;
    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.user.modal.delete-user');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            ['type' => 'error',  'message' => 'User Deleted!']
        );

        activity()->log('User ' . Auth::user()->name . ' Menghapus User ' . $user->name);

        $this->emit('deleteUser');
    }
}
