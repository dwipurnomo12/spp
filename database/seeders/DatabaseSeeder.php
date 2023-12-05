<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'username'  => 'admin',
            'password'  => bcrypt('1234'),
            'role_id'   => 1
        ]);

        Role::create([
            'role'      => 'admin'
        ]);
        Role::create([
            'role'      => 'siswa'
        ]);

        Kelas::create([
            'kelas'         => 'X TKR A',
            'keterangan'    => 'Teknik Kendaraan Ringan A'
        ]);
        Kelas::create([
            'kelas'         => 'X TKR B',
            'keterangan'    => 'Teknik Kendaraan Ringan B'
        ]);

        Siswa::create([
            'nis'       => '1212321',
            'username'  => '1212321',
            'nm_siswa'  => 'Budiono Siregar',
            'j_kelamin' => 'laki-laki',
            'alamat'    => 'Desa karangmulyo, Purwodadi, Purworejo',
            'no_hp'     => '081229098124',
            'kelas_id'  => 1
        ]);
        Siswa::create([
            'nis'       => '9872661',
            'username'  => '9872661',
            'nm_siswa'  => 'Robert Davis Chaniago',
            'j_kelamin' => 'laki-laki',
            'alamat'    => 'Desa Keduren, Purwodadi, Purworejo',
            'no_hp'     => '0812290091874',
            'kelas_id'  => 1
        ]);
    }
}
