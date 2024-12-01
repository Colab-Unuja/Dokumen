<?php

use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\LembagaController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Rute publik
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'auth_login'])->name('auth_login');
Route::get('logout', [HomeController::class, 'logout'])->name('logout');

// Rute untuk pengguna yang diautentikasi dengan middleware 'auth' dan 'check_akses'
Route::middleware(['auth:user', 'check_akses'])->group(function () {
    // Rute Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [HomeController::class, 'admin'])->name('index');
        Route::resource('karyawan', KaryawanController::class);
        Route::post('karyawan/edit/all', [KaryawanController::class, 'edit_multi'])->name('karyawan.edit.all');
        Route::resource('fakultas', FakultasController::class);
        Route::resource('prodi', ProdiController::class);
        Route::resource('lembaga', LembagaController::class);
        Route::get('unit', [UnitController::class, 'index'])->name('unit.index');
        Route::get('unit/sync', [UnitController::class, 'create'])->name('unit.create');
        Route::get('dosen', [DosenController::class, 'index'])->name('dosen.index');
        Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::resource('surat', SuratController::class);
        Route::post('surat/edit/all', [SuratController::class, 'edit_multi'])->name('surat.edit.all');
    });

    // Rute Karyawan
    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/', [HomeController::class, 'karyawan'])->name('index');
    });

    // Rute Dosen
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/', [HomeController::class, 'dosen'])->name('index');
    });

    // Rute Mahasiswa
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/', [HomeController::class, 'mahasiswa'])->name('index');
    });
});
