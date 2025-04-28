<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DataOrangTuaController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\PerkembanganAnakController;
use App\Http\Controllers\ImunisasiController;
use App\Http\Controllers\VitaminController;
use App\Http\Controllers\StuntingController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Support\Facades\Route;

// Menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Proses login
Route::post('/login', [LoginController::class, 'login']);
// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');

// Petugas
Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas');
Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
Route::put('/petugas/{id}', [PetugasController::class, 'update'])->name('petugas.update');
Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

// Jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

// Artikel
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/search', [ArtikelController::class, 'search'])->name('artikel.search');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

// Data Orang Tua
Route::resource('orangtua', DataOrangTuaController::class);

// Data Anak
Route::resource('anak', DataAnakController::class);

// Perkembangan Anak
Route::get('/perkembangan', [PerkembanganAnakController::class, 'index'])->name('perkembangan.index');
Route::get('/perkembangan/create', [PerkembanganAnakController::class, 'create'])->name('perkembangan.create');
Route::post('/perkembangan', [PerkembanganAnakController::class, 'store'])->name('perkembangan.store');
Route::get('/perkembangan/{id}', [PerkembanganAnakController::class, 'show'])->name('perkembangan.show');
Route::get('/perkembangan/{id}/edit', [PerkembanganAnakController::class, 'edit'])->name('perkembangan.edit');
Route::put('/perkembangan/{id}', [PerkembanganAnakController::class, 'update'])->name('perkembangan.update');
Route::delete('/perkembangan/{id}', [PerkembanganAnakController::class, 'destroy'])->name('perkembangan.destroy');

// Imunisasi
Route::resource('imunisasi', ImunisasiController::class);

// Vitamin
Route::resource('vitamin', VitaminController::class);

// Stunting
Route::resource('stunting', StuntingController::class);

Route::get('/perkembangan', [PerkembanganAnakController::class, 'index'])->name('perkembangan.index');
Route::get('/imunisasi', [ImunisasiController::class, 'index'])->name('imunisasi.index');
Route::get('/orangtua', [DataOrangTuaController::class, 'index'])->name('orangtua.index');
Route::get('/anak', [DataAnakController::class, 'index'])->name('anak.index');
Route::get('/vitamin', [VitaminController::class, 'index'])->name('vitamin.index');
Route::get('/stunting', [StuntingController::class, 'index'])->name('stunting.index');

// Data Pengguna
Route::resource('pengguna', PenggunaController::class);

