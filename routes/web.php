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

Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct')->middleware(['auth']);

Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteProduct')->middleware(['auth']);

Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct')->middleware(['auth']);

Route::put('/product/update/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct')->middleware(['auth']);



Route::get('/artisan/{id}',  [\App\Http\Controllers\ArtisanController::class, 'profile'])->name('artisanProfile');

Route::get('/joinArtisan', [App\Http\Controllers\ArtisanController::class, 'joinUs'])->name('joinArtisan');

Route::post('/joinArtisan', [App\Http\Controllers\ArtisanController::class, 'store'])->name('artisanStore');



