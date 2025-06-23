<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MahasiswaController::class, 'index']);
Route::get('/dashboard', [MahasiswaController::class, 'dashboard']);
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
Route::post('/mahasiswa/update/{nim}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/delete/{nim}', [MahasiswaController::class, 'destroy']);
Route::get('/{nim}', [MahasiswaController::class, 'show']);
