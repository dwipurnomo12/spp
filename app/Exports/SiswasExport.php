<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswasExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $siswas;

    public function __construct($siswas)
    {
        $this->siswas = $siswas;
    }

    public function collection()
    {
        return $this->siswas->map(function ($siswa, $index) {
            return [
                'Nomor'     => $index + 1,
                'Nama'      => $siswa->nm_siswa,
                'NIS'       => $siswa->nis,
                'Kelamin'   => $siswa->j_kelamin,
                'No HP'     => $siswa->no_hp,
                'Alamat'    => $siswa->alamat,
                'Kelas'     => optional($siswa->kelas)->kelas,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIS',
            'Kelamin',
            'No HP',
            'Alamat',
            'Kelas'
        ];
    }
}
