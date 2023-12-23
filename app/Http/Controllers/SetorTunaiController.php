<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use Illuminate\Http\Request;
use App\Models\TabunganHistory;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SetorTunaiController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas')->get();
        return view('setor-tunai.index', [
            'TabunganIn'    => TabunganHistory::with('tabungan')->where('status', 'setor')->orderBy('id', 'DESC')->get(),
            'siswas'        => $siswas,
        ]);
    }

    public function getDataSiswa($siswa_id)
    {
        $tabungan = Tabungan::where('siswa_id', $siswa_id)->first();

        return response()->json($tabungan);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nominal'   => 'required|numeric'
        ], [
            'nominal.required'  => 'Form wajib diisi!',
            'nominal.numeric'   => 'Form wajib diisi!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $status     = 'setor';
        $siswaId    = $request->siswa_id;

        $tabungan   = Tabungan::where('siswa_id', $siswaId)->first();
        if (!$tabungan) {
            return back()->with('error', 'Data tabungan tidak ditemukan');
        }

        $tabungan->tabungan += $request->nominal;
        $tabungan->save();

        TabunganHistory::create([
            'tabungan_id'   => $tabungan->id,
            'nominal'       => $request->nominal,
            'status'        => $status
        ]);

        return redirect('/setor-tunai')->with('success', 'Setoran berhasil tersimpan dan saldo tabungan bertambah');
    }

    public function cetakBuktiSetoran($id)
    {
        $buktiSetoran = TabunganHistory::with('tabungan')->where('status', 'setor')->orderBy('id', 'DESC')
            ->findOrFail($id);

        $pdf = PDF::loadView('setor-tunai.bukti-setoran', [
            'buktiSetoran'  => $buktiSetoran
        ]);

        return $pdf->download('bukti-setoran.pdf');
    }
}
