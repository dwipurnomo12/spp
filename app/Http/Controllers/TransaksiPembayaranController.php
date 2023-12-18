<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $tagihan    = Tagihan::find($tagihanId);

        if (!$siswa || !$tagihan) {
            return response()->json(['error' => 'Siswa atau tagihan tidak ditemukan'], 404);
        }

        $siswa->tagihans()->updateExistingPivot($tagihanId, [
            'status'    => 'lunas'
        ]);

        return response()->json(['success' => true]);
    }

    public function cetakStruk($siswa_id, $tagihan_id)
    {
        $siswa = Siswa::find($siswa_id);
        $tagihan = Tagihan::with(['siswas' => function ($query) use ($siswa, $tagihan_id) {
            $query->where('siswa_id', $siswa->id)->where('tagihan_id', $tagihan_id);
        }])
            ->first();

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
