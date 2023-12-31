<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use App\Models\Biaya;
use App\Models\Kelas;
use App\Models\Saldo;
use App\Models\Siswa;
use App\Models\Tingkat;
use App\Models\Tabungan;
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
        User::create([
            'username'  => '9828303',
            'password'  => bcrypt('1234'),
        ]);
        User::create([
            'username'  => '1768299',
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
            'keterangan'    => 'Teknik Kendaraan Ringan A',
            'thn_ajaran_id' => 1
        ]);
        Kelas::create([
            'kelas'         => 'X TKR B',
            'keterangan'    => 'Teknik Kendaraan Ringan B',
            'thn_ajaran_id' => 1
        ]);
        Kelas::create([
            'kelas'         => 'XI TKR A',
            'keterangan'    => 'Teknik Kendaraan Ringan A',
            'thn_ajaran_id' => 1
        ]);
        Kelas::create([
            'kelas'         => 'XI TKR B',
            'keterangan'    => 'Teknik Kendaraan Ringan B',
            'thn_ajaran_id' => 1
        ]);

        Siswa::create([
            'nis'           => '1212321',
            'nm_siswa'      => 'Budiono Siregar',
            'j_kelamin'     => 'laki-laki',
            'alamat'        => 'Karangmulyo, Purwodadi',
            'no_hp'         => '081229098124',
            'thn_angkatan'  => '2022',
            'kelas_id'      => 1,
            'user_id'       => 2,
        ]);
        Siswa::create([
            'nis'           => '9828303',
            'nm_siswa'      => 'Robert Davis Chaniago',
            'j_kelamin'     => 'laki-laki',
            'alamat'        => 'Keduren, Purwodadi',
            'no_hp'         => '08122932324',
            'thn_angkatan'  => '2022',
            'kelas_id'      => 2,
            'user_id'       => 3,
        ]);
        Siswa::create([
            'nis'           => '1768299',
            'nm_siswa'      => 'Mujiyono',
            'j_kelamin'     => 'laki-laki',
            'alamat'        => 'Sumber rejo, Banyuurip',
            'no_hp'         => '08122932994',
            'thn_angkatan'  => '2022',
            'kelas_id'      => 3,
            'user_id'       => 4,
        ]);

        Tabungan::create([
            'tabungan'  => 0.00,
            'user_id'  => 2
        ]);
        Tabungan::create([
            'tabungan'  => 0.00,
            'user_id'  => 3
        ]);
        Tabungan::create([
            'tabungan'  => 0.00,
            'user_id'  => 4
        ]);


        TahunAjaran::create([
            'thn_ajaran'    => '2022/2023',
            'status'        => 'tidak aktif'
        ]);
        TahunAjaran::create([
            'thn_ajaran'    => '2023/2024',
            'status'        => 'aktif'
        ]);

        Biaya::create([
            'jenis_pembayaran'  => 'SPP 1',
            'biaya'             => '150000'
        ]);
        Biaya::create([
            'jenis_pembayaran'  => 'Sumbangan',
            'biaya'             => '50000'
        ]);

        Saldo::create([
            'saldo' => 0.00
        ]);
    }
}