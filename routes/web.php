<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Models\Barang;
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

Route::get('/', [BarangController::class, "index"]);
Route::post('/simpan-barang', [BarangController::class, 'store']);
Route::get('/tampil-barang', [BarangController::class, 'tampilSemuaBarang']);
Route::get('/edit-barang/{id}', [BarangController::class, 'edit']);
Route::delete('/hapus-barang/{id}', [BarangController::class, 'destroy']);
Route::put('/update-barang/{id}', [BarangController::class, 'update']);
Route::put('/tambah-jumlahbarang/{id}', [BarangController::class, 'tambah_jumlahbarang']);


Route::get('/tampil-barangkeluar', [BarangKeluarController::class, 'tampilBarangKeluar']);
Route::post('/submit-barangkeluar', [BarangKeluarController::class, 'store']);

Route::put('/batalkan/{id}', [BarangKeluarController::class, 'batalkan']);