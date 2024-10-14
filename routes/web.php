<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/add-products', [AgentController::class, 'add_page'])->name("add-products");
    Route::get('/products', [AgentController::class, 'list_page'])->name("list-products");
    Route::get('/edit-products/{id}', [AgentController::class, 'edit_page'])->name("edit-products");

});
