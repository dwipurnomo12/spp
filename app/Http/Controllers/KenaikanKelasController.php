<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class KenaikanKelasController extends Controller
{
    public function index()
    {
        return view('kenaikan-kelas.index', [
            'siswas'    => Siswa::with('kelas')->orderBy('id', 'DESC')->get(),
            'kelases'   => Kelas::all()
        ]);
    }

    public function getOldData(Request $request)
    {
        $kelasId = $request->input('kelas_id');
        $kelases = Kelas::all();

        $siswas = Siswa::when($kelasId, function ($query, $kelasId) {
            return $query->where('kelas_id', $kelasId);
        })->get();

        return view('kenaikan-kelas.index', compact('siswas', 'kelases'));
    }

    public function update(Request $request)
    {
        $kelasBaru = $request->input('kelas_baru');
        $siswaIds = $request->input('siswa_ids');

        if (!empty($kelasBaru)) {
            if (is_array($siswaIds) && count($siswaIds) > 0) {
                Siswa::whereIn('id', $siswaIds)->update(['kelas_id' => $kelasBaru]);

                return redirect('/kenaikan-kelas')->with('success', 'Data kelas berhasil diperbarui.');
            }

            return redirect('/kenaikan-kelas')->with('error', 'Tidak ada siswa yang dipilih untuk diperbarui.');
        }

        return redirect('/kenaikan-kelas')->with('error', 'Silakan pilih kelas tujuan terlebih dahulu.');
    }
}
