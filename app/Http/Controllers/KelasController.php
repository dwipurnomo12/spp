<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelas.index', [
            'kelases'   => Kelas::with('tingkat')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create', [
            'tingkats'  => Tingkat::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas'         => 'required',
            'tingkat_id'    => 'required',
            'keterangan'    => 'required',
        ], [
            'kelas.required'        => 'Form tidak boleh kosong !',
            'tingkat_id.required'   => 'Form select wajib dipilih !',
            'keterangan.required'   => 'Form tidak boleh kosong !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Kelas::create([
            'kelas'         => $request->kelas,
            'tingkat_id'    => $request->tingkat_id,
            'keterangan'    => $request->keterangan
        ]);

        return redirect('/kelas')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::find($id);
        return view('kelas.edit', [
            'kelas'     => $kelas,
            'tingkats'  => Tingkat::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::find($id);
        $validator = Validator::make($request->all(), [
            'kelas'         => 'required',
            'tingkat_id'    => 'required',
            'keterangan'    => 'required',
        ], [
            'kelas.required'        => 'Form tidak boleh kosong !',
            'tingkat_id.required'   => 'Form select wajib dipilih !',
            'keterangan.required'   => 'Form tidak boleh kosong !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kelas->update([
            'kelas'         => $request->kelas,
            'tingkat_id'    => $request->tingkat_id,
            'keterangan'    => $request->keterangan
        ]);

        return redirect('/kelas')->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus !');
    }
}
