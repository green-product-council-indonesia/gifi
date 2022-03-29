<?php

namespace App\Http\Livewire\Approve;

use App\Models\Brand;
use App\Models\Company;
use App\Models\Plant;
use Livewire\Component;

class Dokumen extends Component
{
    public $perusahaan, $plant, $brand, $document;
    public $selectedCompany, $selectedPlant, $selectedBrand;

    protected $listeners = [
        'approveDokumen', 'addCatatan', 'editCatatan'
    ];
    public function mount()
    {
        $this->perusahaan = Company::with('plant.brand.document')->get();
        $this->plant = collect();
        $this->brand = collect();
    }
    public function render()
    {
        return view('livewire.approve.dokumen')->extends('layouts.app');
    }

    public function updatedSelectedCompany($id)
    {
        if (!is_null($id)) {
            $this->plant = Plant::where('company_id', $id)->get();
        }
    }
    public function updatedSelectedPlant($id)
    {
        if (!is_null($id)) {
            $this->brand = Brand::where('plant_id', $id)->get();
        }
    }
    public function updatedSelectedBrand($id)
    {
        if (!is_null($id)) {
            $this->document = Brand::with('document', 'plant.perusahaan')->find($id);
        }
    }
    public function approveDokumen()
    {
    }
    public function addCatatan()
    {
    }
    public function editCatatan()
    {
    }
}
