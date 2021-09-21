<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Admin Section routing
|--------------------------------------------------------------------------
|
*/
    
Route::prefix('admin')->group(function () {
    
    Route::get('/', [HomeController::class, 'index'])->middleware('auth');

    Auth::routes();
    // User listing and add edit interface
    Route::resource('/user', UserController::class);

     // Category listing and add edit interface
    Route::resource('/category', CategoryController::class);

     // Product listing and add edit interface
    Route::resource('/product', ProductController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
});
