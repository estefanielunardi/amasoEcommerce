<?php

use Illuminate\Support\Facades\Route;





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [App\Http\Controllers\ProductController::class, 'getProducts'])->name('home');