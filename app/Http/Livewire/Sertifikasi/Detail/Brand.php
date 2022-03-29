<?php

namespace App\Http\Livewire\Sertifikasi\Detail;

use App\Models\Brand as ModelsBrand;
use Livewire\Component;
use PDF;

class Brand extends Component
{
    public $brand, $selectedBrand, $selected;
    public function mount($brand)
    {
        $this->brand = $brand;
    }
    public function render()
    {
        return view('livewire.sertifikasi.detail.brand');
    }

    public function updatedSelectedBrand($id)
    {
        if (!is_null($id)) {
            $this->selected = ModelsBrand::with('plant.perusahaan')->find($id);
        }
    }
}
