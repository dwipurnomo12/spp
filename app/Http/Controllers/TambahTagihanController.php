<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahTagihanController extends Controller
{
    public function index()
    {
        return view('tambah-tagihan.index');
    }
}
