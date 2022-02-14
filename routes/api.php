<?php

use Illuminate\Http\Request;
use App\Http\Middleware\CheckToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PresensiController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//API route for login user
Route::post('/login', [App\Http\Controllers\API\LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/profile', [LoginController::class, 'profile']);
    Route::get('/kunci', [LoginController::class, 'soal_kunci']);
    Route::get('/jawabanku', [LoginController::class, 'jawabanku']);
});

// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/ceklogin', [LoginController::class, 'ceklogin']);
