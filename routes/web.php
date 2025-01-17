<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController,FrontendController,DepartmentController,ColorController,SizeController,ContactController,UserController,
    WishlistController,CartController};
// Route::view('/', 'frontend.index');
use App\Livewire\Table\UserDatatables;
use App\Livewire\{UserDashboard,UserWishlist};

use App\Livewire\Backend\User\CartList;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\RoleManagement;
use App\Livewire\PermissionManagement;
use App\Livewire\AssignPermissions;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])
    ->name('dashboard');
Route::get('/user-dashboard', UserDashboard::class)
    ->middleware(['auth', 'verified', RoleMiddleware::class . ':user'])
    ->name('user.dashboard');
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/roles', RoleManagement::class)->name('roles.index');
Route::get('/permissions', PermissionManagement::class)->name('permissions.index');
Route::get('/assign-permissions', AssignPermissions::class)->name('assign.permissions');
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

    Route::get('/users', UserDatatables::class)->name('list-users');
    Route::get('/wishlist', UserDatatables::class)->name('list-user-wishlist');

    Route::get('/users/get-users', [UserController::class, 'getUsers'])->name('users.getUsers');
    Route::get('/get-product', [ProductController::class, 'getProduct'])->name('users.getProduct');
    Route::get('/get-department', [DepartmentController::class, 'getDepartment'])->name('users.getDepartment');
    Route::get('/get-color', [ColorController::class, 'getColor'])->name('users.getColor');
    Route::get('/get-size', [SizeController::class, 'getSize'])->name('users.getSize');
    Route::get('/get-contact', [ContactController::class, 'getContact'])->name('users.getContact');
    Route::get('/get-wishlist', [WishlistController::class, 'getWishlist'])->name('getContent.getWishlist');
    Route::get('/get-cart', [CartController::class, 'getCart'])->name('getContent.getCart');
    
});
Route::prefix('user')->group(function () {
    Route::get('/wishlist', UserWishlist::class)->name('list-user-wishlist');
    Route::get('/cart', CartList::class)->name('list-user-wishlist');
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
