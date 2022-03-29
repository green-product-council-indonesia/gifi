<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Log extends Component
{
    public $paginate = 10;
    public function render()
    {
        $lastActivity = Activity::orderBy('created_at', 'desc')->paginate($this->paginate);
        return view('livewire.log', [
            'activity' => $lastActivity
        ])->extends('layouts.app');
    }
}
