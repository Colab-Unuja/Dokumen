<?php

use App\Http\Controllers\RedisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/redis/store', [RedisController::class, 'store']);
Route::get('/redis/show/{key}', [RedisController::class, 'show']);
Route::delete('/redis/destroy/{key}', [RedisController::class, 'destroy']);
Route::get('/redis/exists/{key}', [RedisController::class, 'exists']);
Route::post('/redis/increment', [RedisController::class, 'increment']);
Route::post('/redis/decrement', [RedisController::class, 'decrement']);
Route::get('/redis/get-all/{pattern?}', [RedisController::class, 'getAll']);
