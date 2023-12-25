<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Saldo;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\SaldoHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\pdf as PDF;

class TransaksiPembayaranController extends Controller
{
    public function index()
    {
        $users    =
            User::whereNot('id', 1)->get();
        $kelas    = kelas::all();

        return view('transaksi.index', [
            'users'     => $users,
            'kelases'   => $kelas
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

        return view('transaksi.index', compact('users', 'kelases'));
    }

    public function detail($id)
    {
        $siswa = User::find($id);
        $tagihans = Tagihan::with(['users' => function ($query) use ($siswa) {
            $query->where('user_id', $siswa->id);
        }])
            ->orderBy('id', 'DESC')
            ->get();

        return view('transaksi.detail', [
            'tagihans'   => $tagihans
        ]);
    }

    public function bayar(Request $request)
    {
        $userId    = $request->input('user_id');
        $tagihanId = $request->input('tagihan_id');

        $user       = User::find($userId);
        $tagihan    = Tagihan::with(['users' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->find($tagihanId);

        if (!$user || !$tagihan) {
            return response()->json(['error' => 'Siswa atau tagihan tidak ditemukan'], 404);
        }

        $nominal = $tagihan->users->first()->pivot->total_tagihan;

        $saldo = Saldo::first();
        $saldo->saldo += $nominal;
        $saldo->save();

        $saldoHistory = new SaldoHistory([
            'saldo_id'      => $saldo->id,
            'nominal'       => $nominal,
            'keterangan'    => 'Pembayaran tagihan sekolah oleh admin untuk siswa ' . $user->siswa->nm_siswa,
            'status'        => 'in'
        ]);
        $saldoHistory->save();

        $user->tagihans()->updateExistingPivot($tagihanId, [
            'status'    => 'lunas'
        ]);

        return response()->json(['success' => true]);
    }

    public function cetakStruk($userId, $tagihanId)
    {
        $user       = User::find($userId);
        $tagihan    = Tagihan::with(['users' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->find($tagihanId);

        if (!$user || !$tagihan) {
            return response()->json(['error' => 'user atau tagihan tidak ditemukan'], 404);
        }

        $data = [
            'user'      => $user,
            'tagihan'   => $tagihan
        ];

        $pdf = PDF::loadView('transaksi.cetak-struk', $data);
        return $pdf->stream('struk-pembayaran.pdf');
    }
}
