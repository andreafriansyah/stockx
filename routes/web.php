<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ReportController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'actionlogin'])->name('postLogin');
Route::get('/logout', [AuthController::class, 'actionlogout'])->name('logout');

Route::get('/home', [BarangController::class, 'index'])->name('home');
Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index'])->name('indexBarang');
    Route::get('/create', [BarangController::class, 'create'])->name('createBarang');
    Route::post('/store', [BarangController::class, 'store'])->name('storeBarang');
    Route::get('/show/{id}', [BarangController::class, 'show'])->name('showBarang');
    Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('editBarang');
    Route::put('/update/{id}', [BarangController::class, 'update'])->name('updateBarang');
    Route::delete('/delete/{id}', [BarangController::class, 'destroy'])->name('deleteBarang');
    Route::get('/detail-barang/{id}', [BarangController::class, 'getDetail'])->name('detailBarang');
});

Route::group(['prefix' => 'transaksi'], function () {
    Route::get('/masuk', [TransaksiController::class, 'createIn'])->name('transaksiMasuk');
    Route::get('/keluar', [TransaksiController::class, 'createOut'])->name('transaksiKeluar');
    Route::post('/store', [TransaksiController::class, 'store'])->name('storeTransaksi');
}); 

Route::group(['prefix' => 'report'], function () {
    Route::get('/masuk', [ReportController::class, 'indexIn'])->name('reportMasuk');
    Route::get('/keluar', [ReportController::class, 'indexOut'])->name('reportKeluar');
    Route::get('/detail/{id}', [ReportController::class, 'detailTrx'])->name('detailReport');
}); 