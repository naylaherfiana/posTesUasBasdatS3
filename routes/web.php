<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananController;
use App\Models\Kategori;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard', [PelangganController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [KategoriController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [BarangController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [DiskonController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard', [PemesananController::class, 'dashboard'])->name('dashboard');

Route::controller(KategoriController::class)->prefix('kategori')->group(function () {
    Route::get('', 'index')->name('kategori');
    Route::get('add', 'add')->name('kategori.add');
    Route::post('add', 'store')->name('kategori.add.store');
    Route::get('edit/{id}', 'edit')->name('kategori.edit');
    Route::post('edit/{id}', 'update')->name('kategori.add.update');
    Route::get('destroy/{id}', 'destroy')->name('kategori.destroy');
});

Route::controller(PelangganController::class)->prefix('pelanggan')->group(function () {
    Route::get('', 'index')->name('pelanggan');
    Route::get('add', 'add')->name('pelanggan.add');
    Route::post('add', 'store')->name('pelanggan.add.store');
    Route::get('edit/{id}', 'edit')->name('pelanggan.edit');
    Route::post('edit/{id}', 'update')->name('pelanggan.add.update');
    Route::get('destroy/{id}', 'destroy')->name('pelanggan.destroy');
});

Route::controller(BarangController::class)->prefix('barang')->group(function () {
    Route::get('', 'index')->name('barang');
    Route::get('add', 'add')->name('barang.add');
    Route::post('add', 'store')->name('barang.add.store');
    Route::get('edit/{id}', 'edit')->name('barang.edit');
    Route::post('edit/{id}', 'update')->name('barang.add.update');
    Route::get('destroy/{id}', 'destroy')->name('barang.destroy');
});

Route::controller(DiskonController::class)->prefix('diskon')->group(function () {
    Route::get('', 'index')->name('diskon');
    Route::get('add', 'add')->name('diskon.add');
    Route::post('add', 'store')->name('diskon.add.store');
    Route::get('edit/{id}', 'edit')->name('diskon.edit');
    Route::post('edit/{id}', 'update')->name('diskon.add.update');
    Route::get('destroy/{id}', 'destroy')->name('diskon.destroy');
});

Route::controller(PemesananController::class)->prefix('pemesanan')->group(function () {
    Route::get('', 'index')->name('pemesanan');
    Route::get('add', 'add')->name('pemesanan.add');
    Route::post('add', 'store')->name('pemesanan.add.store');
    Route::get('edit/{id}', 'edit')->name('pemesanan.edit');
    Route::post('edit/{id}', 'update')->name('pemesanan.add.update');
    Route::get('destroy/{id}', 'destroy')->name('pemesanan.destroy');
});
