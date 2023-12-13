<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel
{
    protected $headerRow = true;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->headerRow) {
            $this->headerRow = false;
            return null;
        }

        $kelas = Kelas::firstOrCreate([
            'kelas'      => $row[6]
        ]);

        if (!$kelas->exists) {
            $kelas->keterangan = 'Tambahkan Keterangan Kelas';
            $kelas->save();
        }

        $user = User::create([
            'username' => $row[8],
            'password' => Hash::make($row[9]),
        ]);

        $siswa =  new Siswa([
            'nm_siswa'      => $row[1],
            'nis'           => $row[2],
            'j_kelamin'     => $row[3],
            'no_hp'         => $row[4],
            'alamat'        => $row[5],
            'kelas_id'      => $kelas->id,
            'thn_angkatan'  => intval($row[7]),
            'user_id'       => $user->id
        ]);

        $siswa->user()->associate($user);
        $siswa->save();

        return $siswa;
    }
}
