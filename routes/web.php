<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MarginPenjualanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\KartuStokController;
use App\Http\Controllers\PenjualanController;

Route::get('/', function () {return view('welcome');});


#login
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);

#logout
Route::post('/logout', [AuthController::class, 'logout']);

#dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

#ROLE
Route::get('/role', [RoleController::class, 'index']);
Route::get('/role/create', [RoleController::class, 'create']);
Route::post('/role', [RoleController::class, 'store']);
Route::get('/role/{id}/edit', [RoleController::class, 'edit']);
Route::put('/role/{id}', [RoleController::class, 'update']);
Route::delete('/role/{id}', [RoleController::class, 'destroy']);

#SATUAN
Route::get('/satuan', [SatuanController::class, 'index']);
Route::get('/satuan/create', [SatuanController::class, 'create']);
Route::post('/satuan', [SatuanController::class, 'store']);
Route::get('/satuan/{id}/edit', [SatuanController::class, 'edit']);
Route::put('/satuan/{id}', [SatuanController::class, 'update']);
Route::delete('/satuan/{id}', [SatuanController::class, 'destroy']);

#VENDOR
Route::get('/vendor', [VendorController::class, 'index']);
Route::get('/vendor/create', [VendorController::class, 'create']);
Route::post('/vendor', [VendorController::class, 'store']);
Route::get('/vendor/{id}/edit', [VendorController::class, 'edit']);
Route::put('/vendor/{id}', [VendorController::class, 'update']);
Route::delete('/vendor/{id}', [VendorController::class, 'destroy']);

#USER
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}/edit', [UserController::class, 'edit']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);


#BARANG
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/barang/create', [BarangController::class, 'create']);
Route::post('/barang', [BarangController::class, 'store']);
Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
Route::put('/barang/{id}', [BarangController::class, 'update']);
Route::delete('/barang/{id}', [BarangController::class, 'destroy']);


#MARGIN PENJUALAN
Route::get('/margin-penjualan', [MarginPenjualanController::class, 'index']);
Route::get('/margin-penjualan/create', [MarginPenjualanController::class, 'create']);
Route::post('/margin-penjualan', [MarginPenjualanController::class, 'store']);
Route::get('/margin-penjualan/{id}/edit', [MarginPenjualanController::class, 'edit']);
Route::put('/margin-penjualan/{id}', [MarginPenjualanController::class, 'update']);
Route::delete('/margin-penjualan/{id}', [MarginPenjualanController::class, 'destroy']);
Route::post('/margin-penjualan/{id}/aktifkan', [MarginPenjualanController::class, 'aktifkan']);

#pengadaan
Route::get('/pengadaan', [PengadaanController::class, 'index']);
Route::post('/pengadaan', [PengadaanController::class, 'store']);
Route::get('/pengadaan/{id}/detail', [PengadaanController::class, 'createDetail']);
Route::post('/pengadaan/detail', [PengadaanController::class, 'storeDetail']);
Route::post('/pengadaan/{id}/konfirmasi', [PengadaanController::class, 'konfirmasi']);

#penerimaan
Route::get('/penerimaan', [\App\Http\Controllers\PenerimaanController::class, 'index']);
Route::post('/penerimaan/{id}/proses', [\App\Http\Controllers\PenerimaanController::class, 'proses']);
Route::get('/penerimaan/{id}/detail', [\App\Http\Controllers\PenerimaanController::class, 'detail']);
Route::post('/penerimaan/{id}/terima', [\App\Http\Controllers\PenerimaanController::class, 'terima']);

#Penjualan
Route::get('/penjualan', [PenjualanController::class, 'index']) ->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create']) ->name('penjualan.create');
Route::post('/penjualan', [PenjualanController::class, 'store']) ->name('penjualan.store');
Route::get('/penjualan/{id}/detail', [PenjualanController::class, 'detail']) ->name('penjualan.detail');


#kartu stok
Route::get('/kartu-stok', [KartuStokController::class, 'index']);
