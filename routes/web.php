<?php

use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); 


Route::get('/product/create', function () {
    return view('products.create');
})->middleware(['artisan'])->name('newProduct'); 

Route::get('/joinArtisan', function () {
    return view('artisan.joinArtisan');
})->name('joinArtisan')->middleware(['auth']);



require __DIR__.'/auth.php';


//---PRODUCT ROUTES
Route::get('/', [App\Http\Controllers\ProductController::class, 'getProducts'])->name('home');

Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct')->middleware(['artisan']);

Route::delete('/product/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteProduct')->middleware(['artisan']);

Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'showProduct'])->name('productPage');

Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct')->middleware(['artisan']);

Route::put('/product/update/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct')->middleware(['artisan']);

Route::post('/product/search/', [App\Http\Controllers\ProductController::class, 'search'])->name('searchProduct');

//PRODUCT CATEGORY ROUTES

Route::get('/categorias/{category}', [App\Http\Controllers\ProductController::class, 'getCategory'])->name('category');

//---ARTISAN ROUTES
Route::get('/artisan/{artisan:slug}',  [\App\Http\Controllers\ArtisanController::class, 'profile'])->name('artisanProfile');

Route::get('/profile', [App\Http\Controllers\ArtisanController::class, 'seeProfile'])->name('profile')->middleware(['artisan']);

Route::delete('/artisan/{artisan:slug}',  [\App\Http\Controllers\ArtisanController::class, 'destroy'])->name('deleteProfile')->middleware(['artisan']);

Route::get('/artisan/edit/{artisan:slug}', [App\Http\Controllers\ArtisanController::class, 'edit'])->name('editProfile')->middleware(['artisan']);

Route::put('/artisan/update/{artisan}', [App\Http\Controllers\ArtisanController::class, 'update'])->name('updateArtisan')->middleware(['artisan']);

Route::post('/artisan/store', [App\Http\Controllers\ArtisanController::class, 'store'])->name('artisanStore');

Route::get('/artisans', [App\Http\Controllers\ArtisanController::class, 'getAll'])->name('artisans');

Route::get('/orders', [App\Http\Controllers\ArtisanController::class, 'orders'])->name('orders')->middleware(['artisan']);

Route::post('/orders/archive/{id}', [App\Http\Controllers\ArtisanController::class, 'archiveOrder'])->name('archiveOrder')->middleware(['artisan']);


//---ADMIN ROUTES
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'adminDash'])->middleware('checkAdmin')->name('adminDash');

Route::get('/profiles/{artisan:slug}', [App\Http\Controllers\AdminController::class, 'seeArtisanProfile'])->middleware(['checkAdmin'])->name('profileArtisan');

Route::delete('/profiles/{id}', [App\Http\Controllers\AdminController::class, 'deleteArtisan'])->middleware(['checkAdmin'])->name('adminDeleteProfile');

Route::post('/profiles/{id}', [App\Http\Controllers\AdminController::class, 'aproveArtisan'])->middleware(['checkAdmin'])->name('aproveArtisan');



//---CART ROUTES
Route::get('/cart', [App\Http\Controllers\CartController::class, 'getProducts'])->name('cart')->middleware(['auth']); 

Route::get('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'addProduct'])->name('cartAddProduct')->middleware(['auth']);

Route::get('/cart/increment/{id}', [App\Http\Controllers\CartController::class, 'incrementAmount'])->name('cartIncrementProduct')->middleware(['auth']);

Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'removeProduct'])->name('removeProductCart')->middleware(['auth']);

Route::delete('/all/cart/{id}', [App\Http\Controllers\CartController::class, 'deleteProduct'])->name('deleteProductCart')->middleware(['auth']);

Route::delete('/all/cart/', [App\Http\Controllers\CartController::class, 'deleteAllProducts'])->name('deleteAllProductsCart')->middleware(['auth']);

//--PAYMENT ROUTES
Route::get('/purchase/order', [App\Http\Controllers\PaymentController::class, 'order'])->name('purchaseOrder')->middleware(['auth']);

Route::put('/purchase', [App\Http\Controllers\PaymentController::class, 'purchase'])->name('purchase')->middleware(['auth']);


//--COMMENTS ROUTES

Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('commentAdd')->middleware(['auth']);

Route::post('/reply/store', [App\Http\Controllers\CommentController::class, 'replyStore'])->name('replyAdd')->middleware(['auth']);

//--USER ROUTES
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('userProfile')->middleware(['auth']);

Route::get('/user/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('userEdit')->middleware(['auth']);

Route::patch('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('userUpdate')->middleware(['auth']);

//--RATTINGS
Route::post('/ratting/store/{id}', [App\Http\Controllers\RattingController::class, 'store'])->name('productRatting')->middleware(['auth']);

