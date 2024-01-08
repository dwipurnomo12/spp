<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TabunganController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        return view('tabungan.index', [
            'tabungan'          => Tabungan::with(['user', 'tabunganHistories'])->where('user_id', $user_id)->firstOrFail()
        ]);
    }
}
