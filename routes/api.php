<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RiwayatSKBMController;
use App\Http\Controllers\RiwayatSKDBController;
use App\Http\Controllers\RiwayatSKTMController;
use App\Http\Controllers\RiwayatSPKVController;
use App\Http\Controllers\RiwayatSKKKKController;


Route::post('/login', [AuthController::class, 'login']);
Route::get('/test', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/riwayat_cetak', [AuthController::class, 'riwayat_cetak']);
    Route::get('/is_admin', [AuthController::class, 'is_admin']);
});

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

