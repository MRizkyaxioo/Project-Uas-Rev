<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/dashboard', [MahasiswaController::class, 'dashboard']);

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
Route::post('/mahasiswa/update/{nim}', [MahasiswaController::class, 'update']);
Route::delete('/mahasiswa/delete/{nim}', [MahasiswaController::class, 'destroy']);
Route::get('/{nim}', [MahasiswaController::class, 'show']);
