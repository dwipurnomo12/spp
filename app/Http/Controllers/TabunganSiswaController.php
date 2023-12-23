<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TabunganHistory;

class TabunganSiswaController extends Controller
{
    public function index()
    {
        return view('tabungan-siswa.index', [
            'siswas'    => Siswa::all(),
            'kelases'   => Kelas::all()
        ]);
    }

    public function filterData(Request $request)
    {
        $kelasId = $request->input('kelas_id');
        $kelases = Kelas::all();

        $siswas = Siswa::when($kelasId, function ($query, $kelasId) {
            return $query->where('kelas_id', $kelasId);
        })->get();

        return view('tabungan-siswa.index', compact('siswas', 'kelases'));
    }

    public function history($id)
    {
        $history = TabunganHistory::where('tabungan_id', $id)->get();
        return view('tabungan-siswa.history', [
            'tabunganHistory'   => $history,
        ]);
    }
}
