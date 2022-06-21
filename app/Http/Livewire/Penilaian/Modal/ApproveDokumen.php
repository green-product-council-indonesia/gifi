<?php

namespace App\Http\Livewire\Penilaian\Modal;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ApproveDokumen extends ModalComponent
{
    public function render()
    {
        return view('livewire.penilaian.modal.approve-dokumen');
    }
}
