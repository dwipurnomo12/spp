<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tabungan;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use Illuminate\Http\Request;
use App\Models\TabunganHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PenarikanController extends Controller
{
    public function index()
    {
        $siswas      = Siswa::with('kelas')->get();
        $tabunganOut = TabunganHistory::with('tabungan')->where('status', 'penarikan')->orderBy('id', 'DESC')->get();
        return view('penarikan.index', [
            'tabunganOut'   => $tabunganOut,
            'siswas'        => $siswas
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

        $status     = 'penarikan';
        $siswaId    = $request->siswa_id;

        $tabungan   = Tabungan::where('siswa_id', $siswaId)->first();
        if (!$tabungan) {
            return back()->with('error', 'Data tabungan tidak ditemukan');
        }

        if ($request->nominal > $tabungan->tabungan) {
            return back()->with('error', 'Saldo tidak cukup untuk penarikan ini');
        }

        $tabungan->tabungan -= $request->nominal;
        $tabungan->save();

        TabunganHistory::create([
            'tabungan_id'   => $tabungan->id,
            'nominal'       => $request->nominal,
            'status'        => $status
        ]);

        return redirect('/penarikan')->with('success', 'Penarikan berhasil tersimpan dan saldo otomatis berkurang');
    }

    public function cetakBuktiPenarikan($id)
    {
        $buktiPenarikan = TabunganHistory::with('tabungan')->where('status', 'penarikan')->orderBy('id', 'DESC')
            ->findOrFail($id);

        $pdf = PDF::loadView('penarikan.bukti-penarikan', [
            'buktiPenarikan'    => $buktiPenarikan
        ]);

        return $pdf->download('bukti-penarikan.pdf');
    }
}
