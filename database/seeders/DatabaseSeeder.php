<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Biaya;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username'  => 'admin',
            'password'  => bcrypt('1234'),
        ]);

        User::create([
            'username'  => '1212321',
            'password'  => bcrypt('1234'),
        ]);

        Admin::create([
            'user_id'   => 1,
            'name'      => 'Admin'
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
            'nm_siswa'  => 'Budiono Siregar',
            'j_kelamin' => 'laki-laki',
            'alamat'    => 'Desa karangmulyo, Purwodadi, Purworejo',
            'no_hp'     => '081229098124',
            'kelas_id'  => 1,
            'user_id'   => 2,
        ]);

        TahunAjaran::create([
            'thn_ajaran'    => '2022/2024'
        ]);

        Biaya::create([
            'jenis_pembayaran'  => 'SPP',
            'biaya'             => '150000'
        ]);
    }
}
