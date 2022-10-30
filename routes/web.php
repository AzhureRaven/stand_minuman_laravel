<?php

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
Route::prefix('/kasir')->group(function () {
    Route::get('/transaksi', [KasirController::class,'transaksi']);
    Route::get('/member', [KasirController::class,'member']);
});


