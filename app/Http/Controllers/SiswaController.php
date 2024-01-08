<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tabungan;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use App\Exports\SiswasExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            'nm_siswa'      => 'required',
            'nis'           => 'required|unique:siswas',
            'j_kelamin'     => 'required',
            'alamat'        => 'required',
            'no_hp'         => 'required',
            'kelas_id'      => 'required',
            'thn_angkatan'  => 'required'
        ], [
            'nm_siswa.required'     => 'Form wajib diisi !',
            'nis.required'          => 'Form Wajib diisi !',
            'nis.unique'            => 'Data sudah digunakan !',
            'j_kelamin.required'    => 'Pilih jenis kelamin !',
            'alamat.required'       => 'Form wajib diisi !',
            'no_hp.required'        => 'Form wajib diisi !',
            'kelas_id.required'     => 'Form Wajib diisi !',
            'thn_angkatan.required' => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username'      => $request->nis,
            'password'      => bcrypt('1234'),
        ]);

        Tabungan::create([
            'tabungan'  => 0.00,
            'user_id'   => $user->id,
        ]);

        Siswa::create([
            'nm_siswa'      => $request->nm_siswa,
            'nis'           => $request->nis,
            'j_kelamin'     => $request->j_kelamin,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'kelas_id'      => $request->kelas_id,
            'user_id'       => $user->id,
            'thn_angkatan'  => $request->thn_angkatan
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
            'nm_siswa'      => 'required',
            'nis'           => 'required|unique:siswas,nis,' . $id,
            'j_kelamin'     => 'required',
            'alamat'        => 'required',
            'no_hp'         => 'required',
            'kelas_id'      => 'required',
            'thn_angkatan'  => 'required'
        ], [
            'nm_siswa.required'  => 'Form wajib diisi !',
            'nis.required'       => 'Form Wajib diisi !',
            'nis.unique'         => 'Data sudah digunakan !',
            'j_kelamin.required' => 'Pilih jenis kelamin !',
            'alamat.required'    => 'Form wajib diisi !',
            'no_hp.required'     => 'Form wajib diisi !',
            'kelas_id.required'  => 'Form Wajib diisi !',
            'thn_angkatan'       => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->nis != $siswa->nis) {
            $siswa->update([
                'nm_siswa'      => $request->nm_siswa,
                'nis'           => $request->nis,
                'j_kelamin'     => $request->j_kelamin,
                'alamat'        => $request->alamat,
                'no_hp'         => $request->no_hp,
                'kelas_id'      => $request->kelas_id,
                'thn_angkatan'  => $request->thn_angkatan
            ]);
        } else {
            $siswa->update([
                'nm_siswa'      => $request->nm_siswa,
                'j_kelamin'     => $request->j_kelamin,
                'alamat'        => $request->alamat,
                'no_hp'         => $request->no_hp,
                'kelas_id'      => $request->kelas_id,
                'thn_angkatan'  => $request->thn_angkatan
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
        $siswa->forceDelete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }

    /**
     * Exports data siswa excel
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

    public function import(Request $request)
    {
        $request->validate([
            'file'  => 'required|file|mimes:xlsx,xls'
        ], [
            'file.required'     => 'Tidak boleh kosong !',
            'file.file'         => 'Harus ber-type file !',
            'file.mimes'        => 'Format yang di izinkan xlsx, xls'
        ]);

        $file = $request->file('file');
        Excel::import(new SiswaImport, $file);
        return redirect('/siswa')->with('success', 'Data berhasil diimpor.');
    }

    public function downloadExcel(Request $request, $filename)
    {
        $path = storage_path("format excel/{$filename}");
        if (!Storage::exists("format excel/{$filename}")) {
            abort(404);
        }

        return response()->download($path);
    }
}
