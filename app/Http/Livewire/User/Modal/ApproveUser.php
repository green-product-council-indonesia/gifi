<?php

namespace App\Http\Livewire\User\Modal;

use App\Mail\UserApprovalMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use LivewireUI\Modal\ModalComponent;

class ApproveUser extends ModalComponent
{
    public $user;
    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.modal.approve-user');
    }

    public function approveUser($id)
    {
        // DB::beginTransaction();
        // try {
        $user = User::findOrFail($id);

        if (config('app.env') === 'production') {
            Mail::to($user->email)->send(new UserApprovalMail($user->name));
        } else {
            Mail::to('anas@gpci.or.id')->send(new UserApprovalMail($user->name));
        }

        $user->status = 1;
        $user->save();


        // DB::commit();

        $this->closeModal();
        $this->emit('approveUser');

        activity()->log('User ' . Auth::user()->name . ' Menyetujui Pendaftaran User ' . $user->name);
        session()->flash('message', 'Account Activated.');
        return redirect()->route('approve-user');
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     $this->closeModal();
        //     $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Something went Wrong!']);
        // }
    }
}
