<?php

namespace App\Http\Livewire\Penilaian;

use App\Mail\NotifAngketPenilaian;
use App\Models\Brand;
use App\Models\Docrating;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use PDF;

class DetailSertifikasi extends Component
{

    use WithFileUploads;
    public $brand;

    public $laporan_ringkas_verifikasi, $recommendation_for_improvement, $angket_penilaian;

    protected $listeners = [
        'status'
    ];

    public function mount($slug)
    {
        $this->brand = Brand::with('ratings', 'kategoriProduk', 'plant.perusahaan')->where('slug', $slug)->first();
    }
    public function render()
    {
        return view('livewire.penilaian.detail-sertifikasi')->extends('layouts.app');
    }

    public function status()
    {
        //add
    }

    public function generatePdf($slug)
    {
        $data = [
            'brand' => Brand::with('plant.perusahaan', 'kategoriProduk')->where('slug', $slug)->first()
        ];
        $pdf = PDF::loadView('livewire.generate-form-gli', $data)->output();
        // return $pdf->stream('form-gli.pdf');
        return response()->streamDownload(
            fn () => print($pdf),
            'form-gli-' . $slug . '.pdf'
        );
    }

    protected $messages = [
        'required' => 'kolom :attribute kosong, harap diisi',
        'mimes' => 'kolom :attribute harus berbentuk PDF atau DOCX',
    ];

    public function angketPenilaian($id)
    {
        $this->validate([
            'angket_penilaian' => 'required|mimes:pdf,docx|max:8192',
        ]);

        DB::beginTransaction();
        try {
            $file = $this->angket_penilaian;

            $filename = 'storage/dokumen_audit/' . $this->brand->slug . '/' .
                $this->brand->ratings->angket_penilaian;

            if ($this->brand->ratings->angket_penilaian) {
                unlink($filename);
            }

            $nama_file = $this->brand->slug . '-angket-penilaian';
            $data = $nama_file . '.' . $file->extension();
            $file->storeAs('dokumen_audit/' . $this->brand->slug, $data);

            $document = Rating::with('brand')->find($id);
            $document->angket_penilaian = $data;
            $document->save();

            if (config('app.env') === 'production') {
                // Mail Prod 
                Mail::to(['info@gpci.or.id', 'dahlan@gpci.or.id'])->send(new NotifAngketPenilaian($this->brand->plant->perusahaan->nama_perusahaan, $this->brand->nama_brand));
            } else {
                // Mail Local 
                Mail::to("nasirudin.sabiq16@mhs.uinjkt.ac.id")->send(new NotifAngketPenilaian($this->brand->plant->perusahaan->nama_perusahaan, $this->brand->nama_brand));
            }


            DB::commit();
            activity()->log('User ' . Auth::user()->name . ' Mengupload Angket Penilaian Brand ' . $document->brand->nama_brand);

            session()->flash('message', 'Angket Penilaian Berhasil diupload');
            return redirect('penilaian/sertifikasi/' . $this->brand->slug);
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            session()->flash('error', 'Oopss.. Something Went Wrong, Please Try Again.');
            return redirect('penilaian/sertifikasi/' . $this->brand->slug);
        }
    }

    public function resetAngket()
    {
        $this->angket_penilaian = null;
    }

    public function laporanRingkas($id)
    {
        $this->validate([
            'laporan_ringkas_verifikasi' => 'required|mimes:pdf|max:8192',
        ]);

        $file = $this->laporan_ringkas_verifikasi;

        $filename = 'storage/dokumen_audit/' . $this->brand->slug . '/' . $this->brand->ratings->laporan_ringkas_verifikasi;

        if ($this->brand->ratings->laporan_ringkas_verifikasi) {
            unlink($filename);
        }

        $nama_file = $this->brand->slug . '-laporan-ringkas-verifikasi';
        $data = $nama_file . '.' . $file->extension();
        $file->storeAs('dokumen_audit/' . $this->brand->slug, $data);

        $document = Rating::find($id);
        $document->laporan_ringkas_verifikasi = $data;
        $document->save();

        activity()->log('User ' . Auth::user()->name . ' Mengupload Laporan Ringkas Verifikasi Brand ' . $document->brand->slug);

        session()->flash('message', 'Laporan Ringkas Verifikasi berhasil diupload');
        return redirect('penilaian/sertifikasi/' . $this->brand->slug);
    }

    public function rekomendasi($id)
    {
        $this->validate([
            'recommendation_for_improvement' => 'mimes:pdf|max:4096',
        ]);
        $file = $this->recommendation_for_improvement;

        $filename = 'storage/dokumen_audit/' . $this->brand->slug . '/'
            . $this->brand->ratings->recommendation_for_improvement;

        if ($this->brand->ratings->recommendation_for_improvement) {
            unlink($filename);
        }

        $nama_file = $this->brand->slug . '-recommendation-for-improvement';
        $data = $nama_file . '.' . $file->extension();
        $file->storeAs('dokumen_audit/' . $this->brand->slug, $data);

        $document = Rating::find($id);
        $document->recommendation_for_improvement = $data;
        $document->save();

        activity()->log('User ' . Auth::user()->name . ' Mengupload Recommendation For Improvement Brand ' . $document->brand->slug);

        session()->flash('message', 'Recommendation For Improvement berhasil diupload');
        return redirect('penilaian/sertifikasi/' . $this->brand->slug);
    }

    public function download($id)
    {
        $doc = Docrating::findOrFail($id);
        return response()->download(storage_path('app/template_angket/' . $doc->angket_penilaian_doc));
    }

    public function delete($id, $data, $row)
    {
        $doc = Rating::findOrFail($id);

        $filename = 'storage/dokumen_audit/' . $this->brand->slug . '/'
            . $data;

        if (isset($data)) {
            unlink($filename);
        }
        $doc->update([$row => null]);

        session()->flash('message', 'Dokumen berhasil dihapus');
        return redirect('penilaian/sertifikasi/' . $this->brand->slug);
    }
}
