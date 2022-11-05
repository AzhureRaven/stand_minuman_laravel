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
    Route::get('/',[AdminController::class,'master_minuman']);
    Route::get('/category_minuman',[AdminController::class,'master_category_minuman']);
    Route::get('/topping',[AdminController::class,'master_topping']);
    Route::get('/member',[AdminController::class,'master_member']);
    Route::get('/laporan_penjualan',[AdminController::class,'laporan_penjualan']);
});


