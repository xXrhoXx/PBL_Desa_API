<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Middleware\JwtMiddleware;


Route::post('/login', [AuthController::class, 'login']);
Route::get('/test', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

// Produk route pakai middleware langsung via class
Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/produks', [ProdukController::class, 'index']);
    Route::get('/produks/{id}', [ProdukController::class, 'show']);
    Route::post('/produks', [ProdukController::class, 'store']);
    Route::put('/produks/{id}', [ProdukController::class, 'update']);
    Route::delete('/produks/{id}', [ProdukController::class, 'destroy']);
});
