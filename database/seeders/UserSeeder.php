<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'super-admin',
            'email' => 'adm@gtri.or.id',
            'password' => bcrypt('admingtri'),
            'status' => 1,
        ]);
        $superadmin->assignRole('super-admin');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gtri.or.id',
            'password' => bcrypt('admingtri'),
            'status' => 1,
        ]);
        $admin->assignRole('admin');

        $verifikator = User::create([
            'name' => 'verifikator',
            'email' => 'verifikator@gtri.or.id',
            'password' => bcrypt('verifikatorgtri'),
            'status' => 1,
        ]);
        $verifikator->assignRole('verifikator');

        $client = User::create([
            'name' => 'client',
            'email' => 'client@gtri.or.id',
            'password' => bcrypt('clientgtri'),
            'status' => 1,
        ]);
        $client->assignRole('client');

        $client = User::create([
            'name' => 'visitor',
            'email' => 'visitor@gtri.or.id',
            'password' => bcrypt('visitorgtri'),
            'status' => 1,
        ]);
        $client->assignRole('visitor');
    }
}
