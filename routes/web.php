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
    Route::prefix('/transaksi')->group(function () {
        Route::get('/', [KasirController::class,'transaksi']);
        Route::post('/add-item', [KasirController::class,'addItem']);
        Route::post('/change-diskon', [KasirController::class,'changeDiskon']);
        Route::post('/change-member', [KasirController::class,'changeMember']);
        Route::get('/get-item', [KasirController::class,'getItem']);
        Route::post('/remove-item', [KasirController::class,'removeItem']);
    });
    Route::prefix('/member')->group(function () {
        Route::get('/member', [KasirController::class,'member']);
        Route::post('/add-member', [KasirController::class,'addMember']);
    });


});


