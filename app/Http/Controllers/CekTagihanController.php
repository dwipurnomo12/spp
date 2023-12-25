<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\pdf as PDF;

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
