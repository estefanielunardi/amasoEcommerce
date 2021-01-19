<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtisanController;





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); 


require __DIR__.'/auth.php';

Route::get('/', [App\Http\Controllers\ProductController::class, 'getProducts'])->name('home');

Route::get('/artisan/{id}',  [\App\Http\Controllers\ArtisanController::class, 'artisanProfile'])->name('artisanProfile');