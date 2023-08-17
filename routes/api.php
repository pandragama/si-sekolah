<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// use App\Http\Controllers\PostController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\NilaiController;

// Route::resource('posts', PostController::class)->only([
//    'destroy', 'show', 'store', 'update'
// ]);

Route::resource('kelas', KelasController::class)->only([
    'destroy', 'show', 'store', 'update'
]);

Route::resource('siswa', SiswaController::class)->only([
    'destroy', 'show', 'store', 'update'
]);

Route::resource('nilai', NilaiController::class)->only([
    'destroy', 'show', 'store', 'update'
]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
