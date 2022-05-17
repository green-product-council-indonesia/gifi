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
                <span style="font-size: 18pt;"><b>Green Infrastructures and Facilities Indonesia</b></span><br>
                <small>JL. Ciputat Raya No.27A, Pondok Pinang, Kebayoran Lama, Jakarta Selatan 12310</small> <br>
                <small>Phone : 021 - 750 9476</small> <br>
                <small>Email : info@gpci.or.id</small>
            </div>
        </div>
        <h2 style="text-align: center;">Formulir Pendaftaran Sertifikasi <br> Green Toll Road Indonesia </h2>
        <h2 style="text-align: center;"></h2>
        <h3>Informasi Badan Usaha Jalan Tol</h3>
        <table>
            <tr>
                <td class="desc">Nama Badan Usaha Jalan Tol</td>
                <td>{{ $data->nama_bujt }}</td>
            </tr>
            <tr>
                <td class="desc">Alamat Operasional</td>
                <td>{{ $data->alamat_operasional }}</td>
            </tr>
            <tr>
                <td class="desc">Email</td>
                <td>{{ $data->email_operasional }}</td>
            </tr>
            <tr>
                <td class="desc">No. Telp</td>
                <td>{{ $data->noTelp_operasional }}</td>
            </tr>
            <tr>
                <td class="desc">Kode Pos</td>
                <td>{{ $data->kodePos_operasional }}</td>
            </tr>
            <tr>
                <td colspan="2">Contact</td>
            </tr>
            @php
                $contact = json_decode($data->contact);
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
        <h3>Informasi Ruas Jalan Tol</h3>
        <table>
            <tr>
                <td class="desc">Nama Ruas Jalan Tol</td>
                <td>{{ $data->nama_ruas }}</td>
            </tr>
            <tr>
                <td class="desc">Panjang Ruas Jalan Tol</td>
                <td>{{ $data->panjang_ruas }}</td>
            </tr>
            <tr>
                <td class="desc">Tgl Mulai Operasional</td>
                <td>
                    {{ Carbon\Carbon::parse($data->tgl_mulai_operasional)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td class="desc">Kategori Sertifikasi</td>
                <td>{{ $data->kategoriSertifikasi->nama_kategori }}</td>
            </tr>
            <tr>
                <td class="desc">Tipe Sertifikasi</td>
                @switch($data->tipe_sertifikasi)
                    @case(1)
                        <td>
                            Pengajuan Baru
                        </td>
                    @break

                    @case(2)
                        <td>
                            Perpanjangan
                        </td>
                    @break

                    @default
                @endswitch
            </tr>
            <tr>
                <td class="desc">Jumlah Rest Area</td>
                <td>{{ $data->jumlah_rest_area }}</td>
            </tr>
            <tr>
                <td class="desc">Jumlah Gerbang Tol</td>
                <td>{{ $data->jumlah_gerbang_tol }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
