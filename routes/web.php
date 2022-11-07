<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//routing login
Route::get('/', [LoginController::class, 'login']);
Route::post('/do-login', [LoginController::class, 'doLogin']);
Route::get('/logout', [LoginController::class, 'logout']);

//routing kasir
Route::prefix('/kasir')->middleware(['CekPrivilege:1'])->group(function () {
    Route::prefix('/transaksi')->group(function () {
        Route::get('/', [KasirController::class,'transaksi']);
        Route::post('/add-item', [KasirController::class,'addItem']);
        Route::post('/change-diskon', [KasirController::class,'changeDiskon']);
        Route::post('/change-member', [KasirController::class,'changeMember']);
        Route::get('/get-item', [KasirController::class,'getItem']);
        Route::get('/clear-item', [KasirController::class,'clearItem']);
        Route::post('/remove-item', [KasirController::class,'removeItem']);
        Route::post('/do-transaksi', [KasirController::class,'doTransaksi']);
    });
    Route::prefix('/member')->group(function () {
        Route::get('/member', [KasirController::class,'member']);
        Route::post('/add-member', [KasirController::class,'addMember']);
    });
});
Route::prefix('/admin')->middleware(['CekPrivilege:2'])->group(function () {
    Route::get('/minuman',[AdminController::class,'master_minuman']);

    Route::prefix('/category_minuman')->group(function () {
        Route::get('/{id?}',[AdminController::class,'master_category_minuman']);
        Route::post('/simpan',[AdminController::class,'simpan_category_minuman']);
        Route::get('/delete/{id}',[AdminController::class,'delete_category_minuman']);
        Route::get('/restore/{id}',[AdminController::class,'restore_category_minuman']);
    });

    Route::prefix('/users')->group(function () {
        Route::get('/{id?}',[AdminController::class,'master_users']);
        Route::post('/simpan',[AdminController::class,'simpan_users']);
        Route::get('/delete/{id}',[AdminController::class,'delete_users']);
        Route::get('/restore/{id}',[AdminController::class,'restore_users']);
    });

    Route::get('/topping',[AdminController::class,'master_topping']);
    Route::get('/member',[AdminController::class,'master_member']);
    Route::prefix('/laporan_penjualan')->group(function () {
        Route::get('/',[AdminController::class,'laporan_penjualan']);
        Route::post('/filter',[AdminController::class,'filterLaporan']);
        Route::post('/detail',[AdminController::class,'detailLaporan']);
    });

});


