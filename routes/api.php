<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as ApiAuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Tambahkan rute untuk login dan logout
Route::post('pengguna/login', [ApiAuthController::class, 'login']);
Route::post('pengguna/logout', [ApiAuthController::class, 'logout']);
