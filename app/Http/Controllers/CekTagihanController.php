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
        $tagihans = Tagihan::with(['siswas' => function ($query) {
            $query->where('siswa_id', auth()->user()->id);
        }])
            ->orderBy('id', 'DESC')
            ->get();

        return view('cek-tagihan.index', [
            'tagihans' => $tagihans
        ]);
    }
}
