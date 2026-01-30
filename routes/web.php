<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->middleware('auth')
        ->name('admin.dashboard');

    Route::post('/auth', [AdminController::class, 'auth'])
        ->middleware('throttle:5,1')
        ->name('admin.auth');

    Route::post('/logout', [AdminController::class, 'logout'])
        ->middleware('auth')
        ->name('admin.logout');

    Route::post('/product-store', [ProductController::class, 'store'])
        ->middleware('auth')
        ->name('admin.store');

    Route::get('/product-edit/{id}', [ProductController::class, 'edit'])
        ->middleware('auth')
        ->name('admin.edit');

    Route::post('/product-update/{id}', [ProductController::class, 'update'])
        ->middleware('auth')
        ->name('admin.update');


        Route::delete('/product-delete/{id}', [ProductController::class, 'delete'])
    ->middleware('auth')
    ->name('admin.product.delete');


}); 
