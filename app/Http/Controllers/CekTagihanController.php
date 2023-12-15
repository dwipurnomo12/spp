<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CekTagihanController extends Controller
{
    public function index()
    {
        // Mendapatkan siswa yang sedang login
        $siswa = Auth::user()->id;

        // Mengambil tagihan terkait dengan siswa yang sedang login
        $tagihan = Tagihan::with(['biayas', 'kelases', 'siswas'])
            ->whereHas('siswas', function ($query) use ($siswa) {
                $query->where('siswa_id', $siswa);
            })->first();

        return view('cek-tagihan.index', [
            'tagihan' => $tagihan
        ]);
    }
}