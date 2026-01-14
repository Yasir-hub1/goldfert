<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Rutas para el catálogo de productos
Route::get('/productos', function () {
    return view('home');
})->name('products');

Route::get('/productos/{id}', function () {
    return view('home');
})->name('product-detail');

// Ruta oculta para login (no aparece en navegación pública)
Route::get('/admin', function () {
    return view('admin');
})->name('admin');
