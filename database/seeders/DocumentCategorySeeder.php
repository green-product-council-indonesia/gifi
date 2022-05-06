<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Prasyarat',
            'Aspek Perencanaan',
            'Aspek Konstruksi',
            'Aspek Material Konstruksi',
            'Aspek Akses, Kelayakan Dan Pelayanan',
            'Aspek Efisiensi Energi',
            'Aspek Efisiensi Air',
            'Aspek Lingkungan',
            'Aspek Kerjasama Kewilayahan',
        ];
        $id = 1;
        for ($i = 0; $i < sizeof($data); $i++) {
            # code...
            DB::table('document_categories')->insert([
                'id' => $id++,
                'nama_kategori_dokumen' => $data[$i],
            ]);
        }
        //

    }
}
