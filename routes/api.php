<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Auth\LoginController;

// Rutas de autenticación
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/user', [LoginController::class, 'user'])->middleware('auth');

// Rutas públicas de productos (para el catálogo público)
Route::get('/public/products', [ProductController::class, 'publicIndex']);
Route::get('/public/products/{id}', [ProductController::class, 'publicShow']);

// Ruta pública para enviar contacto
Route::post('/contact', [ContactController::class, 'store']);

// Rutas protegidas para admin
Route::middleware('auth')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/contacts/unread-count', [ContactController::class, 'unreadCount']);
    Route::put('/contacts/{id}/read', [ContactController::class, 'markAsRead']);
});
