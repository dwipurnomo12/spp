<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with('biayas')->orderBy('id', 'DESC')->get();
        return view('tagihan.index', [
            'tagihans'  => $tagihans
        ]);
    }

    public function destroy(String $id)
    {
        $tagihan = Tagihan::find($id);
        $tagihan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus !');
    }
}
