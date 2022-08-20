<?php

namespace App\Http\Livewire;

use App\Mail\test;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EmailTest extends Component
{
    public function render()
    {
        return view('livewire.email-test')->extends('layouts.app');
    }

    public function test()
    {
        Mail::to("nasirudin.sabiq16@mhs.uinjkt.ac.id")->send(new test());
        return redirect()->route('test-email');
    }
}
