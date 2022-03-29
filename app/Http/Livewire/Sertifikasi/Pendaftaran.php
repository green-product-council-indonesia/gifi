<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Document;
use App\Models\Registration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pendaftaran extends Component
{
    public $currentStep = 1;

    public $nama_bujt, $alamat_operasional, $email_operasional, $noTelp_operasional, $kodePos_operasional, $nama_ruas, $panjang_ruas,  $category_id, $jumlah_rest_area, $jumlah_gerbang_tol, $tgl_mulai_operasional, $tipe_sertifikasi;

    public $nama, $jabatan, $no_hp, $email;
    public $nama2, $jabatan2, $no_hp2, $email2;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.sertifikasi.pendaftaran')->extends('layouts.app');
    }

    public function prevStep()
    {
        $this->currentStep--;
    }

    public function nextStep()
    {
        $this->currentStep++;
    }

    protected $messages = [
        'required' => 'kolom :attribute kosong, harap diisi',
        'min' => ':attribute harus diisi minimal :min karakter',
        'max' => ':attribute harus diisi maksimal :max karakter',
        'numeric' => ':attribute harus berupa angka',
        'unique:companies' => ':attribute sudah digunakan, silahkan gunakan email yang lain'
    ];
    public function firstStep()
    {
        // $this->validate([
        //     'nama_bujt' => 'required',
        //     'alamat_operasional' => 'required',
        //     'email_operasional' => 'required|email',
        //     'noTelp_operasional' => 'required',
        //     'kodePos_operasional' => 'required|numeric',
        //     'nama_ruas' => 'required',
        //     'panjang_ruas' => 'required|numeric',
        //     'tgl_mulai_operasional' => 'required',
        //     'category_id' => 'required',
        //     'jumlah_rest_area' => 'required|numeric',
        //     'jumlah_gerbang_tol' => 'required|numeric',
        //     'tipe_sertifikasi' => 'required',

        //     'nama' => 'required',
        //     'jabatan' => 'required',
        //     'no_hp' => 'required',
        //     'email' => 'required|email',
        // ]);

        $this->nextStep();
    }

    public function submit()
    {
        DB::beginTransaction();
        try {
            // Produk
            $data = Registration::create([
                'nama_bujt' => $this->nama_bujt,
                'slug' => Str::slug($this->nama_bujt),
                'alamat_operasional' => $this->alamat_operasional,
                'email_operasional' => $this->email_operasional,
                'noTelp_operasional' => $this->noTelp_operasional,
                'kodePos_operasional' => $this->kodePos_operasional,
                'nama_ruas' => $this->nama_ruas,
                'panjang_ruas' => $this->panjang_ruas,
                'tgl_mulai_operasional' => Carbon::parse($this->tgl_mulai_operasional),
                'category_id' => $this->category_id,
                'jumlah_rest_area' => $this->jumlah_rest_area,
                'jumlah_gerbang_tol' => $this->jumlah_gerbang_tol,
                'tipe_sertifikasi' => $this->tipe_sertifikasi,
                'tgl_pendaftaran' => Carbon::now(),
                'user_id' => Auth::user()->id,
                'status' => 1
            ]);

            $document = Document::get()->where('category_id', $this->category_id);

            foreach ($document as $doc) {
                if (isset($doc)) {
                    $data->document()->attach($doc->id, ['status' => 0]);
                }
            }

            if (config('app.env') === 'production') {
                // Mail Prod 
                // Mail::to([$data->email_operasional, Auth::user()->email])->send(new SertifikasiMail($data->nama_bujt, $this->nama_ruas));
                // Mail::to(['info@gpci.or.id', 'ketut.putra@iapmoindonesia.org', 'vera.febriyani@iapmoindonesia.org', 'rista.dianameci@iapmoindonesia.org', 'dahlan@gpci.or.id'])->send(new SertifikasiInternalMail($company->nama_perusahaan, $this->nama_brand));
            } else {
                // Mail Local 
                // Mail::to("nasirudin.sabiq16@mhs.uinjkt.ac.id")->send(new SertifikasiMail($data->nama_bujt, $this->nama_ruas));
                // Mail::to("nasirudin.sabiq16@mhs.uinjkt.ac.id")->send(new SertifikasiInternalMail($data->nama_bujt, $this->nama_ruas));
            }


            DB::commit();

            session()->flash('message', 'Post successfully updated.');
            activity()->log('User ' . Auth::user()->name . ' Mendaftar ' . $data->nama_bujt . ' Dengan Ruas ' . $data->nama_ruas);

            return redirect('/sertifikasi/data');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            session()->flash('error', 'Oopss.. Something Went Wrong, Please Try Again.');
            return redirect('/sertifikasi/data');
        }
    }
}
