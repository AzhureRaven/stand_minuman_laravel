<?php

namespace App\Http\Controllers;

use App\Models\Category_Minuman;
use App\Models\Member;
use App\Models\Minuman;
use App\Models\Topping;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function master_minuman(Request $request)
    {
        $minuman=Minuman::all();
        return view('admin.master_minuman',compact('minuman'));
    }
    public function master_category_minuman(Request $request)
    {
        $category=Category_Minuman::all();
        return view('admin.master_category_minuman',compact('category'));
    }
    public function master_topping(Request $request)
    {
        $topping=Topping::all();
        return view('admin.master_topping',compact('topping'));
    }
    public function master_member(Request $request)
    {
        $member=Member::all();
        return view('admin.master_member',compact('member'));
    }
    public function laporan_penjualan(Request $request)
    {
        // $minuman=Minuman::all();
        return view('admin.laporan_penjualan');
    }
}
