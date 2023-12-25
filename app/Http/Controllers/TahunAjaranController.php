<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tahun-ajaran.index', [
            'thn_ajarans'   => TahunAjaran::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tahun-ajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thn_ajaran'    => 'required',
            'status'        => 'required'
        ], [
            'thn_ajaran.required'   => 'Form wajib diisi !',
            'status.required'       => 'Wajib pilih status !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        TahunAjaran::create([
            'thn_ajaran'    => $request->thn_ajaran,
            'status'        => $request->status
        ]);

        return redirect('/tahun-ajaran')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $thnAjaran = TahunAjaran::find($id);
        return view('tahun-ajaran.edit', [
            'thnAjaran' => $thnAjaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $thnAjaran = TahunAjaran::find($id);
        $validator = Validator::make($request->all(), [
            'thn_ajaran'    => 'required',
            'status'        => 'required'
        ], [
            'thn_ajaran.required'   => 'Form wajib diisi !',
            'status.required'       => 'Wajib pilih status !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $thnAjaran->update([
            'thn_ajaran'    => $request->thn_ajaran,
            'status'        => $request->status
        ]);

        return redirect('/tahun-ajaran')->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $thnAjaran = TahunAjaran::find($id);
        $thnAjaran->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus !');
    }
}
