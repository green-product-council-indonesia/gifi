<?php

namespace App\Http\Livewire\Penilaian;

use App\Mail\NotifAngketPenilaian;
use App\Models\Docreport;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use PDF;

class DetailSertifikasi extends Component
{

    use WithFileUploads;
    public $categories;
    public $data_id, $slug, $kategori, $score;

    public $laporan_ringkas_verifikasi, $rekomendasi;

    protected $listeners = [
        'status', 'approveDokumen', 'addCatatan', 'editCatatan', 'editScore'
    ];

    public function mount($id, $slug)
    {
        $this->data_id = $id;
        $this->slug = $slug;

        $this->categories = DocumentCategory::get();
    }
    public function render()
    {
        $data = Registration::with(
            [
                'document' =>
                function ($q) {
                    $q->where('documents.document_category_id', $this->kategori);
                },
                'document.kategoriDokumen.kategori',
                'kategoriSertifikasi',
                'reports'
            ],
        )->where('id', $this->data_id)->first();

        $scoring = DocumentCategory::with([
            'kategori' => function ($q) use ($data) {
                $q->where('category_id', $data->category_id);
            }
        ])->find($this->kategori);

        return view('livewire.penilaian.detail-sertifikasi', [
            'data' => $data,
            'scoring' => $scoring
        ])->extends('layouts.app');
    }

    public function ubahStatus()
    {
        $data = Registration::findOrFail($this->data_id);
        $data->status = 2;
        $data->save();

        return back();
    }

    public function generatePdf($id, $slug)
    {
        $data = [
            'data' => Registration::with('kategoriSertifikasi')->where('id', $id)->first()
        ];
        $pdf = PDF::loadView('livewire.generate-form-gtri', $data)->output();
        // return $pdf->stream('form-gli.pdf');
        return response()->streamDownload(
            fn () => print($pdf),
            'form-gtri-' . $slug . '.pdf'
        );
    }

    protected $messages = [
        'required' => 'kolom :attribute kosong, hgtriarap diisi',
        'mimes' => 'kolom :attribute harus berbentuk PDF atau DOCX',
    ];
    public function assignScore($id, $ruas)
    {
        $doc = Document::with(['registration' => function ($q) use ($ruas) {
            $q->where('registrations.id', $ruas);
        }])->findOrFail($id);

        $bujt = $doc->registration[0];

        $this->validate([
            'score' => 'required|numeric',
        ], [
            'score.required' => 'Kolom harus diisi',
            'score.numeric' => 'Kolom harus berupa angka',
        ]);

        $bujt->pivot->score = $this->score;
        $bujt->pivot->save();

        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        activity()->log('User ' . Auth::user()->name . ' Meng-upload Score di Checklist Dokumen ');
        return back();
    }

    public function uploadLaporan($id)
    {
        $this->validate([
            'laporan_ringkas_verifikasi' => 'required|mimes:pdf|max:8192',
        ]);

        $file = $this->laporan_ringkas_verifikasi;
        $data = Registration::with('reports')->findOrFail($id);

        $filename = 'storage/dokumen_audit/' . $data->slug . '/' . \Str::slug($data->nama_ruas) . '/' . $data->reports->laporan_ringkas_verifikasi;

        if ($data->reports->laporan_ringkas_verifikasi) {
            unlink($filename);
        }

        $nama_file = $data->slug . '-' . \Str::slug($data->nama_ruas) . '-laporan-ringkas-verifikasi';
        $store = $nama_file . '.' . $file->extension();
        $file->storeAs('dokumen_audit/' . $data->slug . '/' . \Str::slug($data->nama_ruas), $store);

        $report = Docreport::where('registration_id', $id)->first();
        $report->laporan_ringkas_verifikasi = $store;
        $report->save();

        activity()->log('User ' . Auth::user()->name . ' Mengupload Laporan Ringkas Verifikasi Brand ' . $data->slug);

        session()->flash('message', 'Laporan Ringkas Verifikasi berhasil diupload');
        return redirect('penilaian/sertifikasi/' . $data->id . '/' . $data->slug);
    }

    public function uploadRekomendasi($id)
    {
        $this->validate([
            'rekomendasi' => 'required|mimes:pdf|max:8192',
        ]);

        DB::beginTransaction();
        try {
            $file = $this->rekomendasi;
            $data = Registration::with('reports')->findOrFail($id);

            $filename = 'storage/dokumen_audit/' . $data->slug . '/' . \Str::slug($data->nama_ruas) . '/' . $data->reports->rekomendasi;

            if ($data->reports->rekomendasi) {
                unlink($filename);
            }

            $nama_file = $data->slug . '-' . \Str::slug($data->nama_ruas) . '-rekomendasi';
            $store = $nama_file . '.' . $file->extension();
            $file->storeAs('dokumen_audit/' . $data->slug . '/' . \Str::slug($data->nama_ruas), $store);

            $report = Docreport::where('registration_id', $id)->first();
            $report->rekomendasi = $store;
            $report->save();

            if (config('app.env') === 'production') {
                // Mail Prod 
                Mail::to(['info@gpci.or.id', 'dahlan@gpci.or.id'])->send(new NotifAngketPenilaian($data->nama_bujt, $data->nama_ruas));
            } else {
                // Mail Local 
                Mail::to("nasirudin.sabiq16@mhs.uinjkt.ac.id")->send(new NotifAngketPenilaian($data->nama_bujt, $data->nama_ruas));
            }

            activity()->log('User ' . Auth::user()->name . ' Mengupload Report Rekomendasi Brand ' . $data->slug);

            session()->flash('message', 'Laporan Rekomendasi berhasil diupload');
            return redirect('penilaian/sertifikasi/' . $data->id . '/' . $data->slug);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            session()->flash('error', 'Oopss.. Something Went Wrong, Please Try Again.');
            return redirect('penilaian/sertifikasi/' . $data->id . '/' . $data->slug);
        }
    }

    public function delete($id, $data, $row)
    {
        $doc = Docreport::with('register')->findOrFail($id);

        $filename = 'storage/dokumen_audit/' . $doc->register->slug . '/' . \Str::slug($doc->register->nama_ruas) . '/' . $data;

        if (isset($doc)) {
            unlink($filename);
        }

        $doc->update([$row => null]);

        $this->dispatchBrowserEvent(
            'alert',
            [
                'type' => 'success',
                'message' => 'Berhasil!'
            ]
        );
        return back();
    }

    public function status()
    {
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
    public function editScore()
    {
    }
}
