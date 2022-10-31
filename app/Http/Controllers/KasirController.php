<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Member;
use App\Models\Minuman;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KasirController extends Controller
{
    public function transaksi(Request $request)
    {
        //ke halaman transaksi
        $minuman = Minuman::get();
        $topping = Topping::get();
        $member = Member::get();
        $diskon = Diskon::get();

        //cek jika session transaksi belum disiapkan
        if(!Session::has("transaksi")){
            $transaksi = [];
            $transaksi["dtrans"] = [];
            $transaksi["id_diskon"] = -1;
            $transaksi["id_member"] = -1;
            $transaksi["subtotal"] = 0;
            $transaksi["potongan"] = 0;
            $transaksi["total"] = 0;
            Session::put("transaksi",$transaksi);
        }

        // dump($minuman);
        // dump($topping);
        // dd(Session::get("transaksi.dtrans"));

        return view('kasir.transaksi',compact("minuman","topping","member","diskon"));
    }

    public function addItem(Request $request)
    {

        $rules = [
            'id_topping' => 'required',
            'id_minuman' => 'required',
            'jumlah' => 'required | numeric | gt:0'
        ];
        $message = [
            "id_topping.required" => ":attribute harus dipilih",
            "id_minuman.required" => ":attribute harus dipilih",
            "jumlah.required" => ":attribute harus diisi",
            "jumlah.numeric" => ":attribute harus angka",
            "jumlah.gt" => ":attribute harus lebih dari 0",
        ];
        $request->validate($rules,$message);

        $minuman = Minuman::find($request->id_minuman);
        $topping = Topping::find($request->id_topping);

        $dtrans = [];
        $dtrans["id_minuman"] = $minuman->id_minuman;
        $dtrans["nama_minuman"] = $minuman->nama;
        $dtrans["subtotal_minuman"] = $minuman->harga*$request->jumlah;
        $dtrans["id_topping"] = $topping->id_topping;
        $dtrans["nama_topping"] = $topping->nama;
        $dtrans["subtotal_topping"] = $topping->harga*$request->jumlah;
        $dtrans["jumlah"] = $request->jumlah;
        $dtrans["subtotal"] = $dtrans["subtotal_minuman"] + $dtrans["subtotal_topping"];

        $transaksi = Session::get("transaksi");
        $transaksi["dtrans"][] = $dtrans;
        Session::put("transaksi",$transaksi);

        return response()->json(json_encode($transaksi));
    }

    public function getItem(Request $request){
        $transaksi = Session::get("transaksi");
        $subtotal = 0;
        foreach ($transaksi['dtrans'] as $key => $dt) {
            $subtotal += $dt["subtotal"];
        }
        $transaksi["subtotal"] = $subtotal;
        $diskon = 0;
        if($transaksi["id_member"] > -1){
            $diskon += 20;
        }
        if($transaksi["id_diskon"] > -1){
            $d = Diskon::find($transaksi["id_diskon"]);
            $diskon += $d->potongan;
        }
        $transaksi["potongan"] = $transaksi["subtotal"]*$diskon/100;
        $transaksi["total"] = $transaksi["subtotal"] - $transaksi["potongan"];
        Session::put("transaksi",$transaksi);
        return response()->json(json_encode($transaksi));
    }

    public function removeItem(Request $request){
        $transaksi = Session::get("transaksi");
        $id = (int)$request->id;
        unset($transaksi["dtrans"][$id]);
        $transaksi["dtrans"] = array_values($transaksi['dtrans']);
        Session::put("transaksi",$transaksi);
        return response()->json(json_encode($transaksi));
    }

    public function changeDiskon(Request $request){
        $transaksi = Session::get("transaksi");
        $transaksi["id_diskon"] = (int)$request->id;
        Session::put("transaksi",$transaksi);
        return response()->json(json_encode($transaksi));
    }

    public function changeMember(Request $request){
        $transaksi = Session::get("transaksi");
        $transaksi["id_member"] = (int)$request->id;
        Session::put("transaksi",$transaksi);
        return response()->json(json_encode($transaksi));
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
