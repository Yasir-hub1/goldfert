<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\LoginController;

// Rutas de autenticación
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/user', [LoginController::class, 'user'])->middleware('auth');

// Rutas de productos (protegidas)
Route::middleware('auth')->group(function () {
    Route::apiResource('products', ProductController::class);
});
