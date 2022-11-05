<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\DTrans;
use App\Models\HTrans;
use App\Models\Member;
use App\Models\Minuman;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (!Session::has("transaksi")) {
            $transaksi = [];
            $transaksi["dtrans"] = [];
            $transaksi["id_diskon"] = -1;
            $transaksi["id_member"] = -1;
            $transaksi["subtotal"] = 0;
            $transaksi["potongan"] = 0;
            $transaksi["total"] = 0;
            Session::put("transaksi", $transaksi);
        }

        // dump($minuman);
        // dump($topping);
        // dd(Session::get("transaksi.dtrans"));

        return view('kasir.transaksi', compact("minuman", "topping", "member", "diskon"));
    }

    public function doTransaksi(Request $request)
    {
        $transaksi = Session::get("transaksi");
        if(count($transaksi['dtrans']) > 0){
            DB::beginTransaction();
            try {
                $no_nota = DB::selectOne("select genNoNota() as nota");
                $no_nota = $no_nota->nota;

                $htrans = new HTrans();
                $htrans->no_nota = $no_nota;
                $htrans->id_users = Auth::user()->id_users;
                if($transaksi['id_diskon'] != -1) $htrans->id_diskon = $transaksi['id_diskon'];
                if($transaksi['id_member'] != -1) $htrans->id_member = $transaksi['id_member'];
                $htrans->subtotal = $transaksi['subtotal'];
                $htrans->potongan = $transaksi['potongan'];
                $htrans->total = $transaksi['total'];
                $htrans->save();

                foreach ($transaksi['dtrans'] as $key => $dt) {
                    $dtrans = new DTrans();
                    $dtrans->no_nota = $no_nota;
                    $dtrans->id_minuman = $dt['id_minuman'];
                    $dtrans->id_topping = $dt['id_topping'];
                    $dtrans->jumlah = $dt['jumlah'];
                    $dtrans->subtotal_minuman = $dt['subtotal_minuman'];
                    $dtrans->subtotal_topping = $dt['subtotal_topping'];
                    $dtrans->subtotal = $dt['subtotal'];
                    $dtrans->save();
                }
                DB::commit();
                Session::forget('transaksi');
                return redirect('kasir/transaksi')->with('success','Transaksi Berhasil!');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect('kasir/transaksi')->with('error','Transaksi Gagal!');
            }
        }
        else{
            return redirect('kasir/transaksi')->with('error','Tidak ada item!');
        }
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
        $request->validate($rules, $message);

        $minuman = Minuman::find($request->id_minuman);
        $topping = Topping::find($request->id_topping);

        $dtrans = [];
        $dtrans["id_minuman"] = $minuman->id_minuman;
        $dtrans["nama_minuman"] = $minuman->nama;
        $dtrans["subtotal_minuman"] = $minuman->harga * $request->jumlah;
        $dtrans["id_topping"] = $topping->id_topping;
        $dtrans["nama_topping"] = $topping->nama;
        $dtrans["subtotal_topping"] = $topping->harga * $request->jumlah;
        $dtrans["jumlah"] = $request->jumlah;
        $dtrans["subtotal"] = $dtrans["subtotal_minuman"] + $dtrans["subtotal_topping"];

        $transaksi = Session::get("transaksi");
        $transaksi["dtrans"][] = $dtrans;
        Session::put("transaksi", $transaksi);

        return response("Sukses");
    }

    public function getItem(Request $request)
    {
        $transaksi = Session::get("transaksi");
        $subtotal = 0;
        foreach ($transaksi['dtrans'] as $key => $dt) {
            $subtotal += $dt["subtotal"];
        }
        $transaksi["subtotal"] = $subtotal;
        $diskon = 0;
        if ($transaksi["id_member"] > -1) {
            $diskon += 20;
        }
        if ($transaksi["id_diskon"] > -1) {
            $d = Diskon::find($transaksi["id_diskon"]);
            $diskon += $d->potongan;
        }
        $transaksi["potongan"] = $transaksi["subtotal"] * $diskon / 100;
        $transaksi["total"] = $transaksi["subtotal"] - $transaksi["potongan"];
        Session::put("transaksi", $transaksi);

        //modif data untuk tampilan
        $transaksi["data"] = "";
        foreach ($transaksi['dtrans'] as $key => $dtrans) {
            $transaksi["data"] .= "<tr class='align-middle'>";
            $transaksi["data"] .= "<td scope='col'>" . ($key+1) . "</td>";
            $transaksi["data"] .= "<td scope='col'>" . $dtrans["nama_minuman"] . "</td>";
            $transaksi["data"] .= "<td scope='col'>" . $dtrans["nama_topping"] . "</td>";
            $transaksi["data"] .= "<td scope='col'>" . $dtrans["jumlah"] . "</td>";
            $transaksi["data"] .= "<td scope='col' style='text-align: right'>".number_format($dtrans["subtotal_minuman"],2,',','.') . "</td>";
            $transaksi["data"] .= "<td scope='col' style='text-align: right'>".number_format($dtrans["subtotal_topping"],2,',','.') . "</td>";
            $transaksi["data"] .= "<td scope='col' style='text-align: right'>".number_format($dtrans["subtotal"],2,',','.') . "</td>";
            $transaksi["data"] .= "<td scope='col' style='text-align: center'>" .
                    '<button type="button" value=' . $key .
                    ' class="hapus btn btn-danger">Hapus</button>' . "</td>";
            $transaksi["data"] .= "</tr>";
        }
        if(count($transaksi['dtrans']) == 0){
            $transaksi["data"] .= "<tr><td colspan='8'>Tidak ada data</td></tr>";
        }
        $transaksi["subtotal"] = number_format($transaksi["subtotal"],2,',','.');
        $transaksi["potongan"] = number_format($transaksi["potongan"],2,',','.');
        $transaksi["total"] = number_format($transaksi["total"],2,',','.');
        return response()->json(json_encode($transaksi));
    }

    public function clearItem(Request $request)
    {
        $transaksi = [];
        $transaksi["dtrans"] = [];
        $transaksi["id_diskon"] = -1;
        $transaksi["id_member"] = -1;
        $transaksi["subtotal"] = 0;
        $transaksi["potongan"] = 0;
        $transaksi["total"] = 0;
        Session::put("transaksi", $transaksi);
        return response("Sukses");
    }

    public function removeItem(Request $request)
    {
        $transaksi = Session::get("transaksi");
        $id = (int)$request->id;
        unset($transaksi["dtrans"][$id]);
        $transaksi["dtrans"] = array_values($transaksi['dtrans']);
        Session::put("transaksi", $transaksi);
        return response("Sukses");
    }

    public function changeDiskon(Request $request)
    {
        $transaksi = Session::get("transaksi");
        $transaksi["id_diskon"] = (int)$request->id;
        Session::put("transaksi", $transaksi);
        return response("Sukses");
    }

    public function changeMember(Request $request)
    {
        $transaksi = Session::get("transaksi");
        $transaksi["id_member"] = (int)$request->id;
        Session::put("transaksi", $transaksi);
        return response("Sukses");
    }


    //register member
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
        $request->validate($rules, $message);

        $member = new Member();
        $member->nama = $request->nama;
        $member->email = $request->email;
        $result = $member->save();
        if ($result) {
            return redirect("kasir/member")->with("success", "Member berhasil di register!");
        } else {
            return redirect("kasir/member")->with("error", "Member tidak berhasil di register!");
        }
    }
}
