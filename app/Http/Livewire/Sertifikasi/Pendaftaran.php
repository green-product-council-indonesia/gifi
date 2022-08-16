<?php

namespace App\Http\Livewire\Sertifikasi;

use App\Models\Docreport;
use App\Models\Document;
use App\Models\Registration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class Pendaftaran extends Component
{
    public $currentStep = 1;

    public $nama_bujt, $alamat_operasional, $email_operasional, $noTelp_operasional, $kodePos_operasional, $nama_ruas, $panjang_ruas,  $category_id, $jumlah_rest_area, $jumlah_gerbang_tol, $jumlah_jembatan, $jumlah_jpo, $jumlah_underpass, $jumlah_terowongan, $jumlah_underpass_satwa,  $tgl_mulai_operasional, $tipe_sertifikasi;

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
        'numeric' => 'kolom ini harus berupa angka',
    ];
    public function firstStep()
    {
        $this->validate([
            'nama_bujt' => 'required',
            'alamat_operasional' => 'required',
            'email_operasional' => 'required|email',
            'noTelp_operasional' => 'required',
            'kodePos_operasional' => 'required|numeric',
            'nama_ruas' => 'required',
            'panjang_ruas' => 'required|numeric',
            'tgl_mulai_operasional' => 'required',
            'category_id' => 'required',
            'jumlah_rest_area' => 'required|numeric',
            'jumlah_gerbang_tol' => 'required|numeric',
            'jumlah_jembatan' => 'required|numeric',
            'jumlah_jpo' => 'required|numeric',
            'jumlah_underpass' => 'required|numeric',
            'jumlah_terowongan' => 'required|numeric',
            'jumlah_underpass_satwa' => 'required|numeric',
            'tipe_sertifikasi' => 'required',

            'nama' => 'required',
            'jabatan' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
        ]);

        $this->nextStep();
    }

    public function submit()
    {
        DB::beginTransaction();
        try {
            // Submit Registrasi
            $contact = [
                "cp_1" => [
                    'nama' => $this->nama,
                    'jabatan' => $this->jabatan,
                    'no_hp' => $this->no_hp,
                    'email' => $this->email,
                ],
                'cp_2' => [
                    'nama2' => $this->nama2,
                    'jabatan2' => $this->jabatan2,
                    'no_hp2' => $this->no_hp2,
                    'email2' => $this->email2,
                ]
            ];

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
                'jumlah_jembatan' => $this->jumlah_jembatan,
                'jumlah_jpo' => $this->jumlah_jpo,
                'jumlah_underpass' => $this->jumlah_underpass,
                'jumlah_terowongan' => $this->jumlah_terowongan,
                'jumlah_underpass_satwa' => $this->jumlah_underpass_satwa,

                'tipe_sertifikasi' => $this->tipe_sertifikasi,
                'tgl_pendaftaran' => Carbon::now(),
                'contact' => json_encode($contact, 128),
                'user_id' => Auth::user()->id,
                'status' => 1
            ]);

            // Submit Dokumen Persyaratan
            if ($this->jumlah_rest_area == 0) $document = Document::where('category_id', $this->category_id)->where('kode', 'not like', '%T%')->get();
            else $document = Document::where('category_id', $this->category_id)->get();

            foreach ($document as $doc) {
                if (isset($doc)) $data->document()->attach($doc->id, ['status' => 0, 'document_category_id' => $doc->document_category_id]);
            }

            Docreport::create([
                'registration_id' => $data['id']
            ]);

            // Kirim Email
            // if (config('app.env') === 'production') {
            // Mail Prod 
            // Mail::to([$data->email_operasional, Auth::user()->email])->send(new SertifikasiMail($data->nama_bujt, $this->nama_ruas));
            // Mail::to(['info@gpci.or.id','dahlan@gpci.or.id'])->send(new SertifikasiInternalMail($data->nama_bujt, $this->nama_ruas));
            // } else {
            // Mail Local 
            // Mail::to("nasirudin.sabiq16@mhs.uinjkt.ac.id")->send(new SertifikasiMail($data->nama_bujt, $this->nama_ruas));
            // Mail::to("nasirudin.sabiq16@mhs.uinjkt.ac.id")->send(new SertifikasiInternalMail($data->nama_bujt, $this->nama_ruas));
            // }

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
