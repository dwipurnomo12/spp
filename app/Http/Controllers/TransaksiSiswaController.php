<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\RiwayatPembayaran;
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
        $method     = $request->method;

        $tripay         = new TripayPaymentController;
        $transaction    = $tripay->requestTransaction($tagihanId, $method);

        RiwayatPembayaran::create([
            'user_id'       => auth()->user()->id,
            'tagihan_id'    => $tagihanId->id,
            'reference'     => $transaction->reference,
            'merchant_ref'  => $transaction->merchant_ref,
            'total_amount'  => $transaction->amount,
            'status'        => $transaction->status
        ]);

        // return redirect()->route('transaksi-siswa.detail', [
        //     'reference' => $transaction->reference
        // ]);

        return redirect($transaction->checkout_url);
    }
}
