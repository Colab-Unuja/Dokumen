<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('login', [HomeController::class, 'login'])->name('login');
Route::post('login', [HomeController::class, 'auth_login'])->name('auth_login');
Route::get('logout', [HomeController::class, 'logout'])->name('logout');
