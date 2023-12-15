<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Kelas;
use App\Models\Tagihan;
use App\Models\Tingkat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TambahTagihanController extends Controller
{
    public function index()
    {
        return view('tambah-tagihan.index', [
            'kelases'   => Kelas::all(),
            'biayas'    => Biaya::all()
        ]);
    }

    public function tambahTagihan(Request $request)
    {
        $request->validate([
            'nm_tagihan' => 'required|string|max:255',
            'biaya_id'   => 'required|array',
            'kelas_id'   => 'required|array',
        ]);

        $tagihan = Tagihan::create([
            'nm_tagihan' => $request->input('nm_tagihan'),
        ]);

        $tagihan->biayas()->attach($request->input('biaya_id'));

        $tagihan->kelases()->attach($request->input('kelas_id'));

        foreach ($request->input('kelas_id') as $kelasId) {
            $siswas = Kelas::find($kelasId)->siswas;
            $tagihan->siswas()->attach($siswas, [
                'total_tagihan' => 0.00,
            ]);

            foreach ($siswas as $siswa) {
                $totalBiaya = $tagihan->biayas()->sum('biayas.biaya'); // ganti 'biaya' dengan nama kolom yang benar
                $siswa->tagihans()->updateExistingPivot($tagihan->id, [
                    'total_tagihan' => $totalBiaya,
                ]);
            }
        }

        return redirect('/tambah-tagihan')->with('success', 'Tagihan berhasil ditambahkan');
    }
}
