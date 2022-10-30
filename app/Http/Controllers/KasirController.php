<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function transaksi(Request $request)
    {
        //ke halaman transaksi
        return view('kasir.transaksi');
    }

    public function member(Request $request)
    {
        //ke halaman register member baru
        return view('kasir.member');
    }
}
