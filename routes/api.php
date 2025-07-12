<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\RiwayatSKBMController;
use App\Http\Controllers\RiwayatSKDBController;
use App\Http\Controllers\RiwayatSKTMController;
use App\Http\Controllers\RiwayatSPKVController;
use App\Http\Controllers\RiwayatSKKKKController;
use App\Http\Controllers\PerangkatDesaController;


Route::post('/login', [AuthController::class, 'login']);
Route::get('/test', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/riwayat_cetak', [AuthController::class, 'riwayat_cetak']);
    Route::get('/is_admin', [AuthController::class, 'is_admin']);
});

// Produk route pakai middleware langsung via class
// Route API untuk admin, pakai token
Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/produks', [ProdukController::class, 'index']);
    Route::get('/produks/{id}', [ProdukController::class, 'show']);
    Route::post('/produks', [ProdukController::class, 'store']);
    Route::put('/produks/{id}', [ProdukController::class, 'update']);
    Route::delete('/produks/{id}', [ProdukController::class, 'destroy']);
});

// Route API public tanpa token
Route::get('/produk-user', [ProdukController::class, 'produkPublic']);

// riwayat cetak pdf spkv
Route::middleware('auth:api')->group(function () {
    Route::get('/riwayat-spkv', [RiwayatSPKVController::class, 'index']);
    Route::post('/riwayat-spkv', [RiwayatSPKVController::class, 'store']);
    Route::get('/riwayat-spkv/{id}', [RiwayatSPKVController::class, 'show']);
    Route::put('/riwayat-spkv/{id}', [RiwayatSPKVController::class, 'update']);
    Route::delete('/riwayat-spkv/{id}', [RiwayatSPKVController::class, 'destroy']);
});
// riwayat cetak pdf sktm
Route::middleware('auth:api')->group(function () {
    Route::get('/riwayat-sktm', [RiwayatSKTMController::class, 'index']);
    Route::post('/riwayat-sktm', [RiwayatSKTMController::class, 'store']);
    Route::get('/riwayat-sktm/{id}', [RiwayatSKTMController::class, 'show']);
    Route::put('/riwayat-sktm/{id}', [RiwayatSKTMController::class, 'update']);
    Route::delete('/riwayat-sktm/{id}', [RiwayatSKTMController::class, 'destroy']);
});
// riwayat cetak pdf skbm
Route::middleware('auth:api')->group(function () {
    Route::get('/riwayat-skbm', [RiwayatSKBMController::class, 'index']);
    Route::post('/riwayat-skbm', [RiwayatSKBMController::class, 'store']);
    Route::get('/riwayat-skbm/{id}', [RiwayatSKBMController::class, 'show']);
    Route::put('/riwayat-skbm/{id}', [RiwayatSKBMController::class, 'update']);
    Route::delete('/riwayat-skbm/{id}', [RiwayatSKBMController::class, 'destroy']);
});
// riwayat cetak pdf sk hilang kk
Route::middleware('auth:api')->group(function () {
    Route::get('/riwayat-skkkk', [RiwayatSKKKKController::class, 'index']);
    Route::post('/riwayat-skkkk', [RiwayatSKKKKController::class, 'store']);
    Route::get('/riwayat-skkkk/{id}', [RiwayatSKKKKController::class, 'show']);
    Route::put('/riwayat-skkkk/{id}', [RiwayatSKKKKController::class, 'update']);
    Route::delete('/riwayat-skkkk/{id}', [RiwayatSKKKKController::class, 'destroy']);
});
// riwayat cetak pdf sk domisili baru
Route::middleware('auth:api')->group(function () {
    Route::get('/riwayat-skdb', [RiwayatSKDBController::class, 'index']);
    Route::post('/riwayat-skdb', [RiwayatSKDBController::class, 'store']);
    Route::get('/riwayat-skdb/{id}', [RiwayatSKDBController::class, 'show']);
    Route::put('/riwayat-skdb/{id}', [RiwayatSKDBController::class, 'update']);
    Route::delete('/riwayat-skdb/{id}', [RiwayatSKDBController::class, 'destroy']);
});


Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index']);
    Route::post('/perangkat-desa', [PerangkatDesaController::class, 'store']);
    Route::get('/perangkat-desa/{id}', [PerangkatDesaController::class, 'show']);
    Route::put('/perangkat-desa/{id}', [PerangkatDesaController::class, 'update']);
    Route::delete('/perangkat-desa/{id}', [PerangkatDesaController::class, 'destroy']);
});
