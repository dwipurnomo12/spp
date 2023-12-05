<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Exports\SiswasExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.index', [
            'kelases'   => Kelas::all(),
            'siswas'    => Siswa::with('kelas')->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function filterData(Request $request)
    {
        $kelasId = $request->input('kelas_id');
        $kelases = Kelas::all();

        $siswas = Siswa::when($kelasId, function ($query, $kelasId) {
            return $query->where('kelas_id', $kelasId);
        })->get();

        return view('siswa.index', compact('siswas', 'kelases'));
    }


    /**s
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create', [
            'kelases'   => Kelas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nm_siswa'  => 'required',
            'nis'       => 'required|unique:siswas',
            'j_kelamin' => 'required',
            'alamat'    => 'required',
            'no_hp'     => 'required',
            'kelas_id'  => 'required'
        ], [
            'nm_siswa.required'  => 'Form wajib diisi !',
            'nis.required'       => 'Form Wajib diisi !',
            'nis.unique'         => 'Data sudah digunakan !',
            'j_kelamin.required' => 'Pilih jenis kelamin !',
            'alamat.required'    => 'Form wajib diisi !',
            'no_hp.required'     => 'Form wajib diisi !',
            'kelas_id.required'  => 'Form Wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Siswa::create([
            'nm_siswa'      => $request->nm_siswa,
            'nis'           => $request->nis,
            'username'      => $request->nis,
            'j_kelamin'     => $request->j_kelamin,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'kelas_id'      => $request->kelas_id,
        ]);

        return redirect('/siswa')->with('success', 'Berhasil menambahkan data baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
        return view('siswa.edit', [
            'siswa'     => $siswa,
            'kelases'   => $kelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::find($id);
        $validator = Validator::make($request->all(), [
            'nm_siswa'  => 'required',
            'nis'       => 'required|unique:siswas,nis,' . $id,
            'j_kelamin' => 'required',
            'alamat'    => 'required',
            'no_hp'     => 'required',
            'kelas_id'  => 'required'
        ], [
            'nm_siswa.required'  => 'Form wajib diisi !',
            'nis.required'       => 'Form Wajib diisi !',
            'nis.unique'         => 'Data sudah digunakan !',
            'j_kelamin.required' => 'Pilih jenis kelamin !',
            'alamat.required'    => 'Form wajib diisi !',
            'no_hp.required'     => 'Form wajib diisi !',
            'kelas_id.required'  => 'Form Wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->nis != $siswa->nis) {
            $siswa->update([
                'nm_siswa'  => $request->nm_siswa,
                'nis'       => $request->nis,
                'username'  => $request->nis,
                'j_kelamin' => $request->j_kelamin,
                'alamat'    => $request->alamat,
                'no_hp'     => $request->no_hp,
                'kelas_id'  => $request->kelas_id,
            ]);
        } else {
            $siswa->update([
                'nm_siswa'  => $request->nm_siswa,
                'j_kelamin' => $request->j_kelamin,
                'alamat'    => $request->alamat,
                'no_hp'     => $request->no_hp,
                'kelas_id'  => $request->kelas_id,
            ]);
        }

        return redirect('/siswa')->with('success', 'Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    /**
     * Exports excel
     */
    public function export(Request $request)
    {
        $kelasId = $request->query('kelas_id');

        if (!$kelasId) {
            $siswas = Siswa::with('kelas')->get();
        } else {
            $siswas = Siswa::with('kelas')->where('kelas_id', $kelasId)->get();
        }

        return Excel::download(new SiswasExport($siswas), 'data_siswa.xlsx');
    }
}
