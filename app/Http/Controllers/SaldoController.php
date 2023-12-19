<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\SaldoHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaldoController extends Controller
{
    public function index()
    {
        $saldo          = Saldo::first();
        $saldoHistories = SaldoHistory::orderBy('id', 'DESC')->get();
        $kasMasuk       = SaldoHistory::where('status', 'in')
            ->whereMonth('created_at', now()->month)
            ->get();
        $kasKeluar      = SaldoHistory::where('status', 'out')
            ->whereMonth('created_at', now()->month)
            ->get();

        return view('saldo.index', [
            'saldo'             => $saldo,
            'saldoHistories'    => $saldoHistories,
            'kasMasuk'          => $kasMasuk->sum('nominal'),
            'kasKeluar'         => $kasKeluar->sum('nominal')
        ]);
    }
}
