<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UserController;
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
// Default
Route::get('/', [AuthenticatedSessionController::class, 'create']);

// Route::get('/', [AuthenticatedSessionController::class, 'create']);
//klasifikasi
Route::middleware(['auth'])->group(function () {
    // Klasifikasi
    Route::resource('klasifikasi', KlasifikasiController::class)->middleware(['auth']);
// ->middleware(['auth']);
    // User
    Route::resource('users', UserController::class)->middleware(['auth']);

    // Surat Masuk
    Route::resource('surat-masuk', SuratMasukController::class)->middleware(['auth']);
    
    // Surat
    Route::resource('surat', SuratController::class)->middleware(['auth']);

    // Surat Keluar
    Route::resource('surat-keluar', SuratKeluarController::class)->middleware(['auth']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    // Laporans
    Route::get('laporan-surat-masuk', [LaporanController::class, 'surat_masuk'])->middleware(['auth'])->name('laporan-surat-masuk');
    Route::get('laporan-surat-keluar', [LaporanController::class, 'surat_keluar'])->middleware(['auth'])->name('laporan-surat-keluar');
    // Route::get('laporan-surat-keluar', [LaporanController::class, 'surat'])->middleware(['auth'])->name('laporan-surat-keluar');

});
require __DIR__ . '/auth.php';
