<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use App\Http\Controllers\Payment\TripayPaymentController;

class CekTagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with(['users' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])
            ->orderBy('id', 'DESC')
            ->get();

        return view('cek-tagihan.index', [
            'tagihans' => $tagihans
        ]);
    }

    public function bayar($siswaId, $tagihanId)
    {
        $user           = User::findOrFail($siswaId);
        $tagihan        = Tagihan::findOrFail($tagihanId);
        $detailTagihan  = Tagihan::with(['users' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }, 'biayas'])->findOrFail($tagihanId);

        $tripay     = new TripayPaymentController;
        $channels   = $tripay->getPaymentChannels();

        return view('cek-tagihan.bayar', [
            'user'          => $user,
            'tagihan'       => $tagihan,
            'channels'      => $channels,
            'detailTagihan' => $detailTagihan
        ]);
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

        $pdf = PDF::loadView('cek-tagihan.cetak-struk', $data);
        return $pdf->stream('struk-pembayaran.pdf');
    }
}
