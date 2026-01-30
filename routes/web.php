<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');






Route::prefix('admin')->group(function () {

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');

Route::post('/auth', [AdminController::class, 'auth'])->middleware('throttle:5,1')->name('admin.auth');


Route::post('/logout', [AdminController::class, 'logout'])->middleware('auth')->name('admin.logout');

Route::post('/product-store', [ProductController::class, 'store'])->middleware('auth')->name('admin.store');

});






