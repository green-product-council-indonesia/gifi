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
            'name' => 'Anas Sabiq',
            'email' => 'nasirudinsabiq@gmail.com',
            'password' => bcrypt('anas1412'),
            'status' => 1,
        ]);
        $superadmin->assignRole('super-admin');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gifi.or.id',
            'password' => bcrypt('admingifi'),
            'status' => 1,
        ]);
        $admin->assignRole('admin');

        $verifikator = User::create([
            'name' => 'verifikator',
            'email' => 'verifikator@gifi.or.id',
            'password' => bcrypt('verifikatorgifi'),
            'status' => 1,
        ]);
        $verifikator->assignRole('verifikator');

        $client = User::create([
            'name' => 'client',
            'email' => 'client@gifi.or.id',
            'password' => bcrypt('clientgifi'),
            'status' => 1,
        ]);
        $client->assignRole('client');

        $client = User::create([
            'name' => 'visitor',
            'email' => 'visitor@gifi.or.id',
            'password' => bcrypt('visitorgifi'),
            'status' => 1,
        ]);
        $client->assignRole('visitor');
    }
}
