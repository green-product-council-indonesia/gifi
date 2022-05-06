<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    public $search = '';
    public $paginate = 5;

    public function render()
    {
        $role = Auth::user()->roles[0]->name;
        $id_user = Auth::user()->id;

        $ruas = '%' . $this->search . '%';

        if ($role == 'client') {
            $data = Registration::where('user_id', $id_user)
                ->where(function ($q) use ($ruas) {
                    $q->where('nama_ruas', 'like', $ruas)
                        ->orWhere('nama_bujt', 'like', $ruas);
                })
                ->with('kategoriSertifikasi')
                ->paginate($this->paginate);
        } elseif ($role == 'super-admin' || 'admin') {
            $data = Registration::with('kategoriSertifikasi')
                ->where(function ($q) use ($ruas) {
                    $q->where('nama_ruas', 'like', $ruas)
                        ->orWhere('nama_bujt', 'like', $ruas);
                })
                ->paginate($this->paginate);
        } else {
            $data = [];
        }

        return view('livewire.sertifikasi.data', [
            'data' => $data
        ])->extends(
            'layouts.app',
        );
    }
}
