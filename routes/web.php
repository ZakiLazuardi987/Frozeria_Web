<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Frozeria Stok Opname
|--------------------------------------------------------------------------
*/

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('barang.index');
});

// Dashboard & manajemen barang
Route::resource('barang', BarangController::class);

// Manajemen kategori
Route::resource('kategori', KategoriController::class)->except(['show']);

// Halaman bantuan
Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan.index');