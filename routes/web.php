<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtisanController;





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); 

Route::get('/product/create', function () {
    return view('products.create');
})->middleware(['auth'])->name('newProduct'); 


require __DIR__.'/auth.php';

Route::get('/', [App\Http\Controllers\ProductController::class, 'getProducts'])->name('home');

Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');


Route::get('/artisan/{id}',  [\App\Http\Controllers\ArtisanController::class, 'profile'])->name('artisanProfile');

Route::get('/joinArtisan', [App\Http\Controllers\ArtisanController::class, 'joinUs'])->name('joinArtisan');

Route::post('/joinArtisan', [App\Http\Controllers\ArtisanController::class, 'store'])->name('artisanStore');



