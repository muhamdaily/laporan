<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route untuk menampilkan halaman login
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Route untuk menampilkan halaman dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk menampilkan halaman kegiatan harian
    Route::get('kegiatan-harian', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('kegiatan-harian/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');
    Route::post('kegiatan-harian', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('kegiatan-harian/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('kegiatan-harian/{kegiatan}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    // Route untuk menampilkan halaman manajemen pengguna
    Route::get('manajemen-pengguna', [UserController::class, 'index'])->name('user.index');

    // Route untuk laporan kegiatan
    Route::get('laporan-kegiatan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('laporan-kegiatan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
    Route::post('laporan-kegiatan/cetak', [LaporanController::class, 'cetakPdf'])->name('laporan.cetak');
});
