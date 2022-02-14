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
Route::post('/login', [App\Http\Controllers\API\LoginController::class, 'postlogin']);
Route::post('/login/post', [App\Http\Controllers\API\LoginController::class, 'postlogin']);
Route::get('/login', [App\Http\Controllers\API\LoginController::class, 'getlogin']);
Route::post('/auth-login', [App\Http\Controllers\API\AuthController::class, 'postlogin']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [LoginController::class, 'user']);
});

// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/ceklogin', [LoginController::class, 'ceklogin']);
