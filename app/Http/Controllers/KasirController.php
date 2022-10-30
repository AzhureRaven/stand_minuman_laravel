<?php

namespace App\Http\Controllers;

use App\Models\Member;
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

    public function addMember(Request $request)
    {
        //menambah member
        $rules = [
            'email' => 'required | email | max:50',
            'nama' => 'required | max:50',
        ];
        $message = [
            "email.required" => ":attribute harus diisi",
            "email.email" => ":attribute tidak vaild",
            "email.max" => ":attribute maks 50 huruf",
            "nama.required" => ":attribute harus diisi",
            "nama.max" => ":attribute maks 50 huruf",
        ];
        $request->validate($rules,$message);

        $member = new Member();
        $member->nama = $request->nama;
        $member->email = $request->email;
        $result = $member->save();
        if($result){
            return redirect("kasir/member")->with("success","Member berhasil di register!");
        }
        else{
            return redirect("kasir/member")->with("error","Member tidak berhasil di register!");
        }


    }
}
