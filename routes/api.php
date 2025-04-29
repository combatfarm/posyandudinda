<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\JadwalApiController;
use App\Http\Controllers\Api\ArtikelApiController;
use App\Http\Controllers\Api\StuntingApiController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Tambahkan rute untuk login dan logout
Route::post('pengguna/login', [ApiAuthController::class, 'login']);
Route::post('pengguna/logout', [ApiAuthController::class, 'logout']);

//Jadwal
Route::get('jadwal', [JadwalApiController::class, 'index']);
Route::get('jadwal/{id}', [JadwalApiController::class, 'show']);

//Artikel
Route::get('artikel/{id}', [ArtikelApiController::class, 'show']);
Route::get('artikel', [ArtikelApiController::class, 'index']);

// Stunting
Route::get('stunting', [StuntingApiController::class, 'index']);
Route::post('stunting', [StuntingApiController::class, 'store']);
