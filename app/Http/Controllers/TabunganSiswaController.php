<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\TabunganHistory;
use App\Http\Controllers\Controller;

class TabunganSiswaController extends Controller
{
    public function index()
    {
        $users = User::with(['siswa', 'tabungan'])->whereNot('id', 1)->get();

        return view('tabungan-siswa.index', [
            'users'     => $users,
            'kelases'   => Kelas::all()
        ]);
    }

    public function filterData(Request $request)
    {
        $kelasId = $request->input('kelas_id');
        $kelases = Kelas::all();

        $users = User::with(['tabungan', 'siswa'])
            ->whereNot('id', 1)
            ->when($kelasId, function ($query) use ($kelasId) {
                $query->whereHas('siswa', function ($subquery) use ($kelasId) {
                    $subquery->where('kelas_id', $kelasId);
                });
            })
            ->get();

        return view('tabungan-siswa.index', compact('users', 'kelases'));
    }



    public function history($id)
    {
        $history = TabunganHistory::where('tabungan_id', $id)->orderBy('id', 'DESC')->get();
        return view('tabungan-siswa.history', [
            'tabunganHistory'   => $history,
        ]);
    }
}
