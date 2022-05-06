<?php

namespace App\Http\Livewire\Import\Modal;

use App\Models\Category;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class TambahBobot extends ModalComponent
{
    public $kategori_dokumen, $kategori_sertifikasi, $total_bobot;

    protected $rules = [
        'kategori_dokumen' => 'required',
        'kategori_sertifikasi' => 'required',
        'total_bobot' => 'required',
    ];
    protected $messages = [
        'required' => 'form ini harus diisi'
    ];
    public function render()
    {
        $sertifikasi = Category::get();
        $dokumen = DocumentCategory::get();
        return view('livewire.import.modal.tambah-bobot', [
            'sertifikasi' => $sertifikasi,
            'dokumen' => $dokumen
        ]);
    }

    public function tambahBobot()
    {
        $this->validate();

        $docs = DocumentCategory::find($this->kategori_dokumen);
        if (!$docs->kategori->contains($this->kategori_sertifikasi)) {
            $docs->kategori()->attach($this->kategori_sertifikasi, ['total_bobot' => $this->total_bobot]);
        } else {
            $docs->kategori()->syncWithoutDetaching([$this->kategori_sertifikasi], false);
        }

        $this->closeModal();
        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );

        activity()->log('User ' . Auth::user()->name . ' Menambah Item Checklist Dokumen GLI');
        $this->emit('tambahBobot');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return '2xl';
    }
}
