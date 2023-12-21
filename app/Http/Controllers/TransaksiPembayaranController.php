<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Saldo;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SaldoHistory;
use Barryvdh\DomPDF\Facade\pdf as PDF;

class TransaksiPembayaranController extends Controller
{
    public function index()
    {
        $kelas    = Kelas::all();
        $siswas   = Siswa::all();

        return view('transaksi.index', [
            'kelases'   => $kelas,
            'siswas'    => $siswas
        ]);
    }

    public function filterData(Request $request)
    {
        $kelasId = $request->input('kelas_id');
        $kelases = Kelas::all();

        $siswas = Siswa::when($kelasId, function ($query, $kelasId) {
            return $query->where('kelas_id', $kelasId);
        })->get();

        return view('transaksi.index', compact('siswas', 'kelases'));
    }

    public function detail($id)
    {
        $siswa = Siswa::find($id);
        $tagihans = Tagihan::with(['siswas' => function ($query) use ($siswa) {
            $query->where('siswa_id', $siswa->id);
        }])
            ->orderBy('id', 'DESC')
            ->get();

        return view('transaksi.detail', [
            'tagihans'   => $tagihans
        ]);
    }

    public function bayar(Request $request)
    {
        $siswaId = $request->input('siswa_id');
        $tagihanId = $request->input('tagihan_id');

        $siswa      = Siswa::find($siswaId);
        $tagihan    = Tagihan::with(['siswas' => function ($query) use ($siswa) {
            $query->where('siswa_id', $siswa->id);
        }])->find($tagihanId);

        if (!$siswa || !$tagihan) {
            return response()->json(['error' => 'Siswa atau tagihan tidak ditemukan'], 404);
        }

        $nominal = $tagihan->siswas->first()->pivot->total_tagihan;

        $saldo = Saldo::first();
        $saldo->saldo += $nominal;
        $saldo->save();

        $saldoHistory = new SaldoHistory([
            'saldo_id'      => $saldo->id,
            'nominal'       => $nominal,
            'keterangan'    => 'Pembayaran tagihan sekolah oleh admin untuk siswa ' . $siswa->nm_siswa,
            'status'        => 'in'
        ]);
        $saldoHistory->save();

        $siswa->tagihans()->updateExistingPivot($tagihanId, [
            'status'    => 'lunas'
        ]);

        return response()->json(['success' => true]);
    }

    public function cetakStruk($siswaId, $tagihanId)
    {
        $siswa = Siswa::find($siswaId);
        $tagihan    = Tagihan::with(['siswas' => function ($query) use ($siswa) {
            $query->where('siswa_id', $siswa->id);
        }])->find($tagihanId);

        if (!$siswa || !$tagihan) {
            return response()->json(['error' => 'Siswa atau tagihan tidak ditemukan'], 404);
        }

        $data = [
            'siswa'     => $siswa,
            'tagihan'   => $tagihan
        ];

        $pdf = PDF::loadView('transaksi.cetak-struk', $data);
        return $pdf->stream('struk-pembayaran.pdf');
    }
}
