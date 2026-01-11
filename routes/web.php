<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Ruta oculta para login (no aparece en navegación pública)
Route::get('/admin', function () {
    return view('admin');
})->name('admin');
