<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Barryvdh\DomPDF\Facade\pdf as PDF;
use App\Models\SaldoHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kasKeluars = SaldoHistory::where('status', 'out')
            ->orderBy('id', 'DESC')
            ->get();

        return view('pengeluaran.index', [
            'kasKeluars'     => $kasKeluars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $saldo = Saldo::firstOrFail();
        return view('pengeluaran.create', [
            'saldo' => $saldo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nominal'       => 'required|numeric',
            'keterangan'    => 'required'
        ], [
            'nominal.required'      => 'Form wajib diisi !',
            'nominal.numeric'       => 'Hanya inputan angka yang diizinkan !',
            'keterangan.required'   => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $saldo = Saldo::first();
        if ($request->nominal > $saldo->saldo) {
            return back()->with('error', 'Oopss.. Saldo tidak cukup !');
        }

        $saldo->saldo -= $request->nominal;
        $saldo->save();

        SaldoHistory::create([
            'saldo_id'      => $request->saldo_id,
            'nominal'       => $request->nominal,
            'status'        => $request->status,
            'keterangan'    => $request->keterangan
        ]);

        return redirect('/pengeluaran')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $kaskeluar = SaldoHistory::find($id);
        if (!$kaskeluar) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $nominal = $kaskeluar->nominal;
        $kaskeluar->delete();

        $saldo = Saldo::first();
        $saldo->saldo += $nominal;
        $saldo->save();

        return redirect()->back()->with('success', 'Data berhasil dihapus dan saldo dikembalikan!');
    }

    /**
     * Print data.
     */
    public function cetakBuktiPengeluaran($id)
    {
        $pengeluaran = SaldoHistory::find($id);

        $pdf = PDF::loadView('pengeluaran.bukti-pengeluaran', [
            'pengeluaran'   => $pengeluaran
        ]);

        return $pdf->download('bukti-pengeluaran.pdf');
    }
}
