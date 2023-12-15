<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagihanController extends Controller
{
    public function index()
    {
        return view('tagihan.index', [
            'tagihans'  => Tagihan::orderBy('id', 'DESC')->get()
        ]);
    }

    public function detail()
    {
        $tagihan = Tagihan::with(['biayas', 'kelases', 'siswas'])->orderBy('id', 'DESC')->first();
        return view('tagihan.detail', [
            'tagihan' => $tagihan
        ]);
    }
}
