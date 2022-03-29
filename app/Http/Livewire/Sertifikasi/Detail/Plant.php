<?php

namespace App\Http\Livewire\Sertifikasi\Detail;

use App\Models\Plant as ModelsPlant;
use Livewire\Component;

class Plant extends Component
{
    public $plant, $selectedPlant;

    public $selected;
    public function mount($plant)
    {
        $this->plant = $plant;
    }
    public function render()
    {
        return view('livewire.sertifikasi.detail.plant');
    }

    public function updatedSelectedPlant($id)
    {
        if (!is_null($id)) {
            $this->selected = ModelsPlant::find($id);
        }
    }
}
