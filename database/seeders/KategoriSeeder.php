<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'id' => 1,
            'nama_kategori' => 'New',
        ]);
        DB::table('categories')->insert([
            'id' => 2,
            'nama_kategori' => 'Existing',
        ]);
    }
}
