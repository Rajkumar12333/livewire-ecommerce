<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController,FrontendController};
Route::view('/', 'frontend.index');


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/add-products', [ProductController::class, 'add_page'])->name("add-products");
    Route::get('/products', [ProductController::class, 'list_page'])->name("list-products");
    Route::get('/edit-products/{id}', [ProductController::class, 'edit_page'])->name("edit-products");
    Route::get('/delete-products/{id}', [ProductController::class, 'destroy'])->name("delete-products");

});
Route::get('/shop', [FrontendController::class, 'shop'])->name("shop");
Route::get('/contact', [FrontendController::class, 'contact'])->name("contact");
Route::get('/shop-detail', [FrontendController::class, 'shop_detail'])->name("shop-detail");
Route::get('/shoping-cart', [FrontendController::class, 'shoping_cart'])->name("shoping-cart");
Route::get('/checkout', [FrontendController::class, 'checkout'])->name("checkout");