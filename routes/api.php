<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MahasiswaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/mahasiswa', [MahasiswaApiController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaApiController::class, 'show']);
Route::post('/mahasiswa', [MahasiswaApiController::class, 'store']);
Route::post('/mahasiswa/{id}', [MahasiswaApiController::class, 'update']);
Route::delete('/mahasiswa/{id}', [MahasiswaApiController::class, 'destroy']);

// Route::post('/login', [AuthController::class, 'login']);
