<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransaksiPembayaranController extends Controller
{
    public function index()
    {
        return view('transaksi.index', [
            'tagihans'   => Tagihan::with(['siswas' => function ($query) {
                $query->where('status', 'belum_dibayar');
            }])->first()
        ]);
    }
}
