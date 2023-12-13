<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelulusanController extends Controller
{
    public function index()
    {
        return view('kelulusan.index', [
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

        return view('kelulusan.index', compact('siswas', 'kelases'));
    }

    public function prosesLulus(Request $request)
    {
        $siswaIds = $request->input('siswa_ids', []);

        if (is_array($siswaIds) && count($siswaIds) > 0) {
            Siswa::whereIn('id', $siswaIds)->delete();
            return redirect()->back()->with('success', 'Proses kelulusan berhasil');
        }
        return redirect('/kelulusan')->with('error', 'Silahkan pilih siswa yang akan di proses kelulusan !');
    }
}
