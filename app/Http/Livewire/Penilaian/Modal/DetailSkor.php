<?php

namespace App\Http\Livewire\Penilaian\Modal;

use App\Models\DocumentCategory;
use App\Models\Registration;
use LivewireUI\Modal\ModalComponent;

class DetailSkor extends ModalComponent
{
    public $result, $scoring;

    public function mount($data)
    {
        $result = Registration::findOrFail($data);
        $this->scoring = DocumentCategory::with([
            'kategori' => function ($q) use ($result) {
                $q->where('category_id', $result->category_id);
            },
            'dokumen' => function ($q) use ($result) {
                $q->where('category_id', $result->category_id);
            },
            'dokumen.registration' => function ($q) use ($data) {
                $q->where('registrations.id', $data);
            },
        ])->get();
    }
    public function render()
    {
        return view('livewire.penilaian.modal.detail-skor');
    }

    public static function modalMaxWidth(): string
    {
        // 'sm' // 'md' // 'lg' // 'xl' // '2xl' // '3xl' // '4xl' // '5xl' // '6xl' // '7xl'
        return 'xl';
    }
}
