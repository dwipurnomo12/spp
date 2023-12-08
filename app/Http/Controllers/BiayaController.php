<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('biaya.index', [
            'biayas'    => Biaya::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('biaya.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_pembayaran'  => 'required',
            'biaya'             => 'required'
        ], [
            'jenis_pembayaran.required' => 'Form wajib diisi !',
            'biaya.required'            => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Biaya::create([
            'jenis_pembayaran'  => $request->jenis_pembayaran,
            'biaya'             => $request->biaya
        ]);

        return redirect('/biaya')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $biaya = Biaya::find($id);
        return view('biaya.edit', [
            'biaya' => $biaya
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $biaya = Biaya::find($id);
        $validator = Validator::make($request->all(), [
            'jenis_pembayaran'  => 'required',
            'biaya'             => 'required'
        ], [
            'jenis_pembayaran.required' => 'Form wajib diisi !',
            'biaya.required'            => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $biaya->update([
            'jenis_pembayaran'  => $request->jenis_pembayaran,
            'biaya'             => $request->biaya
        ]);

        return redirect('/biaya')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $biaya = Biaya::find($id);
        $biaya->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus !');
    }
}