<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController,FrontendController,DepartmentController,ColorController,SizeController,ContactController,UserController};
// Route::view('/', 'frontend.index');
use App\Livewire\Table\UserDatatables;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
    Route::get('/add-products', [ProductController::class, 'add_page'])->name("add-products");
    Route::get('/products', [ProductController::class, 'list_page'])->name("list-products");
    Route::get('/edit-products/{id}', [ProductController::class, 'edit_page'])->name("edit-products");
    Route::get('/delete-products/{id}', [ProductController::class, 'destroy'])->name("delete-products");

    Route::get('/add-department', [DepartmentController::class, 'add_page'])->name("add-department");
    Route::get('/department', [DepartmentController::class, 'list_page'])->name("list-department");
    Route::get('/edit-department/{id}', [DepartmentController::class, 'edit_page'])->name("edit-department");
    Route::get('/delete-department/{id}', [DepartmentController::class, 'destroy'])->name("delete-department");

    Route::get('/add-color', [ColorController::class, 'add_page'])->name("add-color");
    Route::get('/color', [ColorController::class, 'list_page'])->name("list-color");
    Route::get('/edit-color/{id}', [ColorController::class, 'edit_page'])->name("edit-color");
    Route::get('/delete-color/{id}', [ColorController::class, 'destroy'])->name("delete-color");

    Route::get('/add-size', [SizeController::class, 'add_page'])->name("add-size");
    Route::get('/size', [SizeController::class, 'list_page'])->name("list-size");
    Route::get('/edit-size/{id}', [SizeController::class, 'edit_page'])->name("edit-size");
    Route::get('/delete-size/{id}', [SizeController::class, 'destroy'])->name("delete-size");
    Route::get('/contact', [ContactController::class, 'list_page'])->name("list-contact");

    Route::get('/users', UserDatatables::class);
    
   
});
});
Route::get('/shop', [FrontendController::class, 'shop'])->name("shop");
Route::get('/contact', [FrontendController::class, 'contact'])->name("contact");
Route::post('/contact/store', [FrontendController::class, 'contact_store'])->name("contact.store");
Route::get('/shop-detail/{id}', [FrontendController::class, 'shop_detail'])->name("shop-detail");
Route::get('/shoping-cart', [FrontendController::class, 'shoping_cart'])->name("shoping-cart");
Route::get('/checkout', [FrontendController::class, 'checkout'])->name("checkout");
Route::get('/department/{slug}', [FrontendController::class, 'department'])->name("department");
Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name("wishlist");
Route::get('/', [FrontendController::class, 'index'])->name("index");
Route::get('/users/get-users', [UserController::class, 'getUsers'])->name('users.getUsers');