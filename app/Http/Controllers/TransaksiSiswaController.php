<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\TripayPaymentController;

class TransaksiSiswaController extends Controller
{
    public function detail($reference)
    {
        $tripay = new TripayPaymentController();
        $detail = $tripay->detailTransaction($reference);

        return view('transaksi-siswa.detail', [
            'detail'    => $detail
        ]);
    }

    public function store(Request $request)
    {
        $tagihanId  = Tagihan::find($request->tagihan_id);
        $method    = $request->method;

        $tripay         = new TripayPaymentController;
        $transaction    = $tripay->requestTransaction($tagihanId, $method);

        return redirect()->route('transaksi-siswa.detail', [
            'reference' => $transaction->reference
        ]);
    }
}
