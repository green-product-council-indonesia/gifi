<?php

namespace App\Http\Livewire\Account\Modal;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class ChangePassword extends ModalComponent
{
    public $old_password, $new_password, $new_password_confirmation;
    public function render()
    {
        return view('livewire.account.modal.change-password');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'lg';
    }

    public function editPassword()
    {
        $this->validate(
            [
                'old_password' => 'required',
                'new_password' => ['required', 'same:new_password', 'min:6'],
                'new_password_confirmation' => 'required|same:new_password',
            ],
            [
                'required' => 'Form ini Harus Diisi',
                'new_password_confirmation.same' => 'Password Baru anda tidak sesuai'
            ]
        );
        $oldPassword = Auth::User()->password;
        if (Hash::check($this->old_password, $oldPassword)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($this->new_password);
            $user->save();

            $this->closeModal();
            activity()->log('User ' . Auth::user()->name . ' Mengganti Passwordnya');
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => 'Berhasil!'
                ]
            );
            $this->emit('editPassword');
        } else {
            // toast('Password yang anda Masukan Tidak Sesuai','error');

            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'error',
                    'message' => 'Password Lama Anda Salah!'
                ]
            );
            return back();
        }
    }
}
