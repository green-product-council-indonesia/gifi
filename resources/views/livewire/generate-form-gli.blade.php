<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{-- <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}" media="print">
    <!-- Scripts -->
    <script src="{{ url(mix('js/app.js')) }}" defer></script> <title>Document</title> --}}
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .desc {
            width: 30%;
        }

    </style>
</head>

<body>
    <div>
        <div style="">
            <div class="logo" style="float: left; width:10%;">
                <img src="{{ public_path('img/gpci.jpg') }}" style="width: 100%">
            </div>
            <div class="header" style="margin-left: 15%">
                <span style="font-size: 18pt;"><b>Green Product Council Indonesia</b></span><br>
                <small>JL. Ciputat Raya No.27A, Pondok Pinang, Kebayoran Lama, Jakarta Selatan 12310</small> <br>
                <small>Phone : 021 - 750 9476</small> <br>
                <small>Email : info@greenproductcouncilindonesia.org</small>
            </div>
        </div>
        <h2 style="text-align: center;">Formulir Pendaftaran Sertifikasi <br> Green Label Indonesia </h2>
        <h2 style="text-align: center;"></h2>
        <h3>Informasi Perusahaan</h3>
        <table>
            <tr>
                <td class="desc">Nama Perusahaan</td>
                <td>{{ $brand->plant->perusahaan->nama_perusahaan }}</td>
            </tr>
            <tr>
                <td class="desc">Alamat Perusahaan</td>
                <td>{{ $brand->plant->perusahaan->alamat_perusahaan }}</td>
            </tr>
            <tr>
                <td class="desc">Email</td>
                <td>{{ $brand->plant->perusahaan->email_perusahaan }}</td>
            </tr>
            <tr>
                <td class="desc">No. Telp</td>
                <td>{{ $brand->plant->perusahaan->noTelp_perusahaan }}</td>
            </tr>
            <tr>
                <td class="desc">No. Fax</td>
                <td>{{ $brand->plant->perusahaan->noFax_perusahaan }}</td>
            </tr>
            <tr>
                <td class="desc">Kode Pos</td>
                <td>{{ $brand->plant->perusahaan->kodePos_perusahaan }}</td>
            </tr>
            <tr>
                <td class="desc">Akta Notaris</td>
                <td>{{ $brand->plant->perusahaan->aktaNotaris }}</td>
            </tr>
            <tr>
                <td class="desc">Surat Izin Usaha Perdagangan</td>
                <td>{{ $brand->plant->perusahaan->siup }}</td>
            </tr>
            <tr>
                <td class="desc">Tanda Daftar Perusahaan</td>
                <td>{{ $brand->plant->perusahaan->tdp }}</td>
            </tr>
            <tr>
                <td class="desc">NPWP</td>
                <td>{{ $brand->plant->perusahaan->npwp }}</td>
            </tr>
            <tr>
                <td class="desc">No API (Angka Pengenal Importir)</td>
                <td>{{ $brand->plant->perusahaan->api }}</td>
            </tr>
            <tr>
                <td class="desc">Website</td>
                <td>{{ $brand->plant->perusahaan->web }}</td>
            </tr>
            <tr>
                <td colspan="2">Contact</td>
            </tr>
            @php
                $contact = json_decode($brand->plant->perusahaan->contact);
            @endphp
            <tr>
                <td class="desc">Nama</td>
                <td>{{ $contact->cp_1->nama }}</td>
            </tr>
            <tr>
                <td class="desc">Jabatan</td>
                <td>{{ $contact->cp_1->jabatan }}</td>
            </tr>
            <tr>
                <td class="desc">Email</td>
                <td>{{ $contact->cp_1->email }}</td>
            </tr>
            <tr>
                <td class="desc">No. Hp</td>
                <td>{{ $contact->cp_1->no_hp }}</td>
            </tr>
            @if ($contact->cp_2->nama2)
                <tr>
                    <td class="desc">Nama</td>
                    <td>{{ $contact->cp_2->nama2 }}</td>
                </tr>
                <tr>
                    <td class="desc">Jabatan</td>
                    <td>{{ $contact->cp_2->jabatan2 }}</td>
                </tr>
                <tr>
                    <td class="desc">Email</td>
                    <td>{{ $contact->cp_2->email2 }}</td>
                </tr>
                <tr>
                    <td class="desc">No. Hp</td>
                    <td>{{ $contact->cp_2->no_hp2 }}</td>
                </tr>
            @endif
        </table>
        <h3>Informasi Plant</h3>
        <table>
            <tr>
                <td class="desc">Nama Plant</td>
                <td>{{ $brand->plant->nama_plant }}</td>
            </tr>
            <tr>
                <td class="desc">Alamat Plant</td>
                <td>{{ $brand->plant->alamat_plant }}</td>
            </tr>
            <tr>
                <td class="desc">Email Plant</td>
                <td>{{ $brand->plant->email_plant }}</td>
            </tr>
            <tr>
                <td class="desc">No. Telp</td>
                <td>{{ $brand->plant->noTelp_plant }}</td>
            </tr>
            <tr>
                <td class="desc">No Fax</td>
                <td>{{ $brand->plant->noFax_plant }}</td>
            </tr>
            <tr>
                <td class="desc">Kode Pos</td>
                <td>{{ $brand->plant->kodePos_plant }}</td>
            </tr>
            <tr>
                <td colspan="2">Contact</td>
            </tr>
            @php
                $contact = json_decode($brand->plant->contact);
            @endphp
            <tr>
                <td class="desc">Nama</td>
                <td>{{ $contact->nama }}</td>
            </tr>
            <tr>
                <td class="desc">Jabatan</td>
                <td>{{ $contact->jabatan }}</td>
            </tr>
            <tr>
                <td class="desc">Email</td>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <td class="desc">No. Hp</td>
                <td>{{ $contact->no_hp }}</td>
            </tr>
        </table>
        <h3>Informasi Brand</h3>
        <table>
            <tr>
                <td class="desc">Nama Brand</td>
                <td>{{ $brand->nama_brand }}</td>
            </tr>
            <tr>
                <td class="desc">Deskripsi</td>
                <td>{{ $brand->deskripsi_brand }}</td>
            </tr>
            <tr>
                <td class="desc">Kategori Brand</td>
                <td>{{ $brand->kategoriProduk->categories }}</td>
            </tr>
            <tr>
                <td class="desc">Tipe / Model</td>
                <td>{{ $brand->tipe_model }}</td>
            </tr>
            <tr>
                <td class="desc">Merk Dagang</td>
                <td>{{ $brand->merk_dagang }}</td>
            </tr>
            <tr>
                <td class="desc">Tipe Pengemasan / Ukuran</td>
                <td>{{ $brand->pengemasan_ukuran }}</td>
            </tr>
            <tr>
                <td class="desc">Dimensi (P x L x T)</td>
                <td>{{ $brand->dimensi }}</td>
            </tr>
            <tr>
                <td class="desc">Jenis Sertifikasi</td>
                <td>
                    @if ($brand->jenis_sertifikasi = 1)
                        Pengajuan Baru
                    @else
                        Perpanjangan
                    @endif
                </td>
            </tr>
            <tr>
                <td class="desc">Tanggal Pendaftaran</td>
                <td>
                    @isset($brand->tgl_pendaftaran)
                        {{ Carbon\Carbon::parse($brand->tgl_pendaftaran)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    @endisset
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
