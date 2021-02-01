<?php

use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); 


Route::get('/product/create', function () {
    return view('products.create');
})->middleware(['artisan'])->name('newProduct'); 

Route::get('/joinArtisan', function () {
    return view('joinArtisan');
})->name('joinArtisan')->middleware(['auth']);

require __DIR__.'/auth.php';


//---PRODUCT ROUTES
Route::get('/', [App\Http\Controllers\ProductController::class, 'getProducts'])->name('home');

Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct')->middleware(['artisan']);

Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteProduct')->middleware(['artisan']);

Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct')->middleware(['artisan']);

Route::put('/product/update/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct')->middleware(['artisan']);

//---ARTISAN ROUTES
Route::get('/artisan/{artisan:slug}',  [\App\Http\Controllers\ArtisanController::class, 'profile'])->name('artisanProfile');

Route::get('/profile', [App\Http\Controllers\ArtisanController::class, 'seeProfile'])->name('profile')->middleware(['artisan']);

Route::delete('/artisan/{artisan:slug}',  [\App\Http\Controllers\ArtisanController::class, 'destroy'])->name('deleteProfile')->middleware(['artisan']);

Route::get('/artisan/edit/{artisan:slug}', [App\Http\Controllers\ArtisanController::class, 'edit'])->name('editProfile')->middleware(['artisan']);

Route::put('/artisan/update/{artisan}', [App\Http\Controllers\ArtisanController::class, 'update'])->name('updateArtisan')->middleware(['artisan']);

Route::post('/artisan/store', [App\Http\Controllers\ArtisanController::class, 'store'])->name('artisanStore');

Route::get('/artisans', [App\Http\Controllers\ArtisanController::class, 'getAll'])->name('artisans');


//---ADMIN ROUTES
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'adminDash'])->middleware('checkAdmin')->name('adminDash');

Route::get('/profiles/{artisan:slug}', [App\Http\Controllers\AdminController::class, 'seeArtisanProfile'])->middleware(['checkAdmin'])->name('profileArtisan');

Route::delete('/profiles/{id}', [App\Http\Controllers\AdminController::class, 'deleteArtisan'])->middleware(['checkAdmin'])->name('AdminDeleteProfile');



//---CART ROUTES
Route::get('/cart', [App\Http\Controllers\CartController::class, 'getProducts'])->name('cart')->middleware(['auth']); 

Route::get('/cart', [App\Http\Controllers\CartController::class, 'getProducts'])->name('cart')->middleware(['auth']); 

Route::get('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'addProduct'])->name('cartAddProduct')->middleware(['auth']);

Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'removeProduct'])->name('removeProductCart')->middleware(['auth']);

