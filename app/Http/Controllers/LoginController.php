<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //ke halaman login
        return view('login');
    }

    public function doLogin(Request $request)
    {
        //melakukan login
        $credential = [
            "username" => $request->username,
            "password" => $request->password
        ];
        if (Auth::attempt($credential)) {
            if(Auth::user()->privilege == 1) return redirect('kasir/transaksi'); //login sebagai kasir yang punya privilege 1
            else return redirect('admin/minuman'); //login sebagai admin yang punya privilege 2. //belum selesai yang ini
        } else {
            return redirect('/')->with('error', 'Username/Password Invalid');
        }
    }

    public function logout(Request $request){
        //logout
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        }
        if(Session::has('transaksi')){
            Session::forget('transaksi');
        }
        return redirect('/');
    }
}
