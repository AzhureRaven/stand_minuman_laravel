<?php

namespace App\Http\Controllers;

use App\Models\Category_Minuman;
use App\Models\DTrans;
use App\Models\HTrans;
use App\Models\Member;
use App\Models\Minuman;
use App\Models\Topping;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function master_minuman(Request $request)
    {
        $minuman=Minuman::withTrashed()->get();
        $curMinuman=Minuman::withTrashed()->get();
        if($request->id){
            $curMinuman = Minuman::withTrashed()->find($request->id);
        }
        else{
            $curMinuman = [];
        }
        return view('admin.master_minuman',compact('minuman','curMinuman'));
    }
    public function simpan_minuman(Request $request)
    {
        $rules = [
            'nama' => 'required | max:30',
            'gambar'=>'nullable',
            'harga'=>'required|Integer',
        ];
        $message = [
            "nama.required" => ":attribute harus diisi",
            "nama.max" => ":attribute maks 50 huruf",
            "harga.required" => ":attribute harus diisi",
        ];

        $request->validate($rules, $message);

        $id_minuman= $request->id_minuman;
        if($request->type == "Update"){
            $minuman = Minuman::withTrashed()->find($id_minuman);
            $minuman->nama = $request->nama;
            $minuman->gambar = $request->gambar;
            $minuman->harga = $request->harga;
            $minuman->id_category_minuman = $request->category_minuman;
            $result = $minuman->save();
        }
        else{
            $minuman = new Minuman();
            $minuman->nama = $request->nama;
            $minuman->gambar = $request->gambar;
            $minuman->harga = $request->harga;
            $minuman->id_category_minuman = $request->category_minuman;
            $result = $minuman->save();
        }

        if ($result) {
            return redirect('admin/minuman')->with("success", "Minuman Disimpan!");
        } else {
            return redirect('admin/minuman')->with("error", "Minuman Tidak Bisa Disimpan!");
        }
    }

    public function delete_minuman(Request $request)
    {

        $id = $request->id;
        $result = Minuman::find($id)->delete();
        return redirect('admin/minuman')->with("success", "Minuman Dihapus!");
    }

    public function restore_minuman(Request $request)
    {
        $id = $request->id;
        $result = Minuman::withTrashed()->find($id)->restore();
        return redirect('admin/minuman')->with("success", "Minuman Direstore!");
    }



    //category minuman
    public function master_category_minuman(Request $request)
    {
        $category=Category_Minuman::withTrashed()->get();
        if($request->id){
            $curCategory = Category_Minuman::withTrashed()->find($request->id);
        }
        else{
            $curCategory = [];
        }
        return view('admin.master_category_minuman',compact('category','curCategory'));
    }

    public function simpan_category_minuman(Request $request)
    {
        $rules = [
            'nama' => 'required | max:30',
        ];
        $message = [
            "nama.required" => ":attribute harus diisi",
            "nama.max" => ":attribute maks 50 huruf",
        ];

        $request->validate($rules, $message);

        $id_category_minuman = $request->id_category_minuman;
        if($id_category_minuman != 1){
            if($request->type == "Update"){
                $category = Category_Minuman::withTrashed()->find($id_category_minuman);
                $category->nama = $request->nama;
                $result = $category->save();
            }
            else{
                $category = new Category_Minuman();
                $category->nama = $request->nama;
                $result = $category->save();
            }

            if ($result) {
                return redirect('admin/category_minuman')->with("success", "Category Disimpan!");
            } else {
                return redirect('admin/category_minuman')->with("error", "Category Tidak Bisa Disimpan!");
            }

        }
        else{
            return redirect('admin/category_minuman')->with("error", "Category Tidak Bisa Disimpan!");
        }
    }

    public function delete_category_minuman(Request $request)
    {

        $id = $request->id;
        if($id != 1){
            $result = Category_Minuman::find($id)->delete();
            return redirect('admin/category_minuman')->with("success", "Category Dihapus!");
        }
        else{
            return redirect('admin/category_minuman')->with("error", "Category Tidak Dihapus!");
        }
    }

    public function restore_category_minuman(Request $request)
    {

        $id = $request->id;
        if($id != 1){
            $result = Category_Minuman::withTrashed()->find($id)->restore();
            return redirect('admin/category_minuman')->with("success", "Category Direstore!");
        }
        else{
            return redirect('admin/category_minuman')->with("error", "Category Tidak Direstore!");
        }
    }
    public function master_topping(Request $request)
    {
        $topping=Topping::withTrashed()->get();
        $curTopping=Member::withTrashed()->get();
        if($request->id){
            $curTopping = Topping::withTrashed()->find($request->id);
        }
        else{
            $curTopping = [];
        }
        return view('admin.master_topping',compact('topping','curTopping'));
    }
    public function simpan_topping(Request $request)
    {
        $rules = [
            'nama' => 'required | max:30',
            'gambar'=>'nullable',
            'harga'=>'required|Integer',
        ];
        $message = [
            "nama.required" => ":attribute harus diisi",
            "nama.max" => ":attribute maks 50 huruf",
            "harga.required" => ":attribute harus diisi",
        ];

        $request->validate($rules, $message);

        $id_topping= $request->id_topping;
        if($request->type == "Update"){
            $topping = Topping::withTrashed()->find($id_topping);
            $topping->nama = $request->nama;
            $topping->gambar = $request->gambar;
            $topping->harga = $request->harga;
            $result = $topping->save();
        }
        else{
            $topping = new Topping();
            $topping->nama = $request->nama;
            $topping->gambar = $request->gambar;
            $topping->harga = $request->harga;
            $result = $topping->save();
        }

        if ($result) {
            return redirect('admin/topping')->with("success", "Topping Disimpan!");
        } else {
            return redirect('admin/topping')->with("error", "Topping Tidak Bisa Disimpan!");
        }
    }

    public function delete_topping(Request $request)
    {

        $id = $request->id;
        $result = Topping::find($id)->delete();
        return redirect('admin/topping')->with("success", "Topping Dihapus!");
    }

    public function restore_topping(Request $request)
    {
        $id = $request->id;
        $result = Topping::withTrashed()->find($id)->restore();
        return redirect('admin/topping')->with("success", "Topping Direstore!");
    }


    public function master_member(Request $request)
    {
        $member=Member::withTrashed()->get();
        $curMember=Member::withTrashed()->get();
        if($request->id){
            $curMember = Member::withTrashed()->find($request->id);
        }
        else{
            $curMember = [];
        }
        return view('admin.master_member',compact('member','curMember'));
    }

    public function simpan_member(Request $request)
    {
        $rules = [
            'nama' => 'required | max:30',
            'email'=> 'required | email'
        ];
        $message = [
            "nama.required" => ":attribute harus diisi",
            "nama.max" => ":attribute maks 50 huruf",
            "email.required"=>":attribute harus diisi",
            "email.email"=>":attribute harus dalam bentuk email yang valid",
        ];

        $request->validate($rules, $message);

        $id_member= $request->id_member;
        if($request->type == "Update"){
            $member = Member::withTrashed()->find($id_member);
            $member->nama = $request->nama;
            $member->email = $request->email;
            $result = $member->save();
        }
        else{
            $member = new Member();
            $member->nama = $request->nama;
            $member->email = $request->email;
            $result = $member->save();
        }

        if ($result) {
            return redirect('admin/member')->with("success", "Member Disimpan!");
        } else {
            return redirect('admin/member')->with("error", "Member Tidak Bisa Disimpan!");
        }
    }

    public function delete_member(Request $request)
    {

        $id = $request->id;
        $result = Member::find($id)->delete();
        return redirect('admin/member')->with("success", "Member Dihapus!");
    }

    public function restore_member(Request $request)
    {
        $id = $request->id;
        $result = Member::withTrashed()->find($id)->restore();
        return redirect('admin/member')->with("success", "Member Direstore!");
    }


    //laporan
    public function laporan_penjualan(Request $request)
    {
        $htrans = HTrans::all();
        $grandtotal = HTrans::all()->sum('total');
        // $minuman=Minuman::all();
        return view('admin.laporan_penjualan',compact("htrans","grandtotal"));
    }

    public function filterLaporan(Request $request)
    {
        $rules = [
            'tgl_awal' => 'required',
            'tgl_akhir' => 'required',
        ];

        $request->validate($rules);

        $htrans = HTrans::whereBetween("tanggal",[$request->tgl_awal,$request->tgl_akhir])->get();
        $grandtotal = $htrans->sum('total');
        $hresponse = "";
        if(count($htrans)){
            foreach ($htrans as $key => $ht) {
                $hresponse .= '<tr class="align-middle">';
                $hresponse .= '<td scope="col">'. $ht->no_nota .'</td>';
                $hresponse .= '<td scope="col">'. $ht->tanggal .'</td>';
                $hresponse .= '<td scope="col">';
                if($ht->Users) $hresponse .= $ht->Users->nama;
                $hresponse .= '</td>';
                $hresponse .= '<td scope="col">';
                if($ht->Member) $hresponse .= $ht->Member->nama;
                $hresponse .= '</td>';
                $hresponse .= '<td scope="col" style="text-align: right">'. number_format($ht->subtotal,2,',','.') .'</td>';
                $hresponse .= '<td scope="col">';
                if($ht->Diskon) $hresponse .= $ht->Diskon->nama;
                $hresponse .= '</td>';
                $hresponse .= '<td scope="col" style="text-align: right">'. number_format($ht->potongan,2,',','.') .'</td>';
                $hresponse .= '<td scope="col" style="text-align: right">'. number_format($ht->total,2,',','.') .'</td>';
                $hresponse .= '<td scope="col" style="text-align: center"><button type="button"
                value="'. $ht->no_nota .'" class="detail btn btn-success">Detail</button></td>';
                $hresponse .= '</tr>';
            }
            $hresponse .= '<tr>
            <td colspan="7" style="text-align: right">Grand Total:</td>
            <td style="text-align: right" id="grandtotal">'. number_format($grandtotal,2,',','.') .'</td>
            <td></td>
        </tr>';
        }
        else{
            $hresponse = '<tr><td colspan="9">Tidak ada data</td></tr>';
        }
        return response($hresponse);
    }

    public function detailLaporan(Request $request)
    {
        $rules = [
            'no_nota' => 'required',
        ];

        $request->validate($rules);

        $dtrans = DTrans::where("no_nota","=",$request->no_nota)->get();
        $total = $dtrans->sum('subtotal');
        $dresponse = "";
        if(count($dtrans)){
            foreach ($dtrans as $key => $dt) {
                $dresponse .= '<tr class="align-middle">';
                $dresponse .= '<td scope="col">'.($key + 1).'</td>';
                $dresponse .= '<td scope="col">'.$dt->Minuman->nama.'</td>';
                $dresponse .= '<td scope="col">'.$dt->Topping->nama.'</td>';
                $dresponse .= '<td scope="col">'.$dt->jumlah.'</td>';
                $dresponse .= '<td scope="col" style="text-align: right">'. number_format($dt->subtotal_minuman,2,',','.').'</td>';
                $dresponse .= '<td scope="col" style="text-align: right">'. number_format($dt->subtotal_topping,2,',','.').'</td>';
                $dresponse .= '<td scope="col" style="text-align: right">'. number_format($dt->subtotal,2,',','.').'</td>';
                $dresponse .= '</tr>';
            }
            $dresponse .= '<tr>
            <td colspan="6" style="text-align: right">Total:</td>
            <td style="text-align: right" id="subtotal">'.number_format($total,2,',','.').'</td>
        </tr>';
        }
        else{
            $dresponse = '<tr><td colspan="7">Tidak ada data</td></tr>';
        }
        return response($dresponse);
    }
}
