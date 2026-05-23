<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\PenjualanController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\ProfilController;
use App\Http\Controllers\Api\Admin\UsahaController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profil', [ProfilController::class, 'show']);
    Route::put('/profil', [ProfilController::class, 'update']);
    Route::post('/profil/logo', [ProfilController::class, 'uploadLogo']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/produk', [ProdukController::class, 'index']);
    Route::post('/produk', [ProdukController::class, 'store']);
    Route::put('/produk/{id}', [ProdukController::class, 'update']);
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::post('/penjualan', [PenjualanController::class, 'store']);
    Route::put('/penjualan/{id}', [PenjualanController::class, 'update']);
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']);

    Route::get('/laporan/harian', [LaporanController::class, 'harian']);
    Route::get('/laporan/bulanan', [LaporanController::class, 'bulanan']);
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf']);
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel']);

    Route::middleware('super_admin')->group(function () {
        Route::get('/admin/usaha', [UsahaController::class, 'index']);
        Route::get('/admin/usaha/{id}', [UsahaController::class, 'show']);
        Route::delete('/admin/usaha/{id}', [UsahaController::class, 'destroy']);
    });
});
