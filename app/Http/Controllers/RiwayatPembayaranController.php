<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPembayaran;
use App\Http\Controllers\Controller;

class RiwayatPembayaranController extends Controller
{
    public function index()
    {
        return view('riwayat-pembayaran.index', [
            'riwayatPembayarans'    => RiwayatPembayaran::orderBy('id', 'DESC')
                ->where('user_id', auth()->user()->id)
                ->get()
        ]);
    }
}
