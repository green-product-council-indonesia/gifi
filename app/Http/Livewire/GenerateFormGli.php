<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GenerateFormGli extends Component
{
    public function render()
    {
        return view('livewire.home')->extends('layouts.app');
    }
}
