<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Siswa([
            'nm_siswa'  => $row['nama'],
            'nis'       => $row['nis'],
            'j_kelamin' => $row['jenis_kelamin'],
            'no_hp'     => $row['no_hp'],
            'alamat'    => $row['alamat'],
            'kelas_id'  => $row['kelas_id'],
        ]);
    }
}
