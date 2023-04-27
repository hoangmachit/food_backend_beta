<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\HomeController as HomeAdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [HomeAdminController::class, 'index'])->name('index');
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/create', [ProductController::class, 'create'])->name('create');
        Route::put('/all-status', [ProductController::class, 'allStatus'])->name('allStatus');
        Route::put('/{id}/status', [ProductController::class, 'status'])->name('status');
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('update')->where('id', '[0-9]+');
        Route::delete('/{id}/delete', [ProductController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
    });
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::delete('/{id}/delete', [OrderController::class, 'delete'])->name('delete')->where('id', '[0-9]+');
        Route::put('/status', [OrderController::class, 'status'])->name('status');
    });
    Route::prefix('config')->name('config.')->group(function () {
        Route::get('/', [ConfigController::class, 'index'])->name('index');
        Route::put('/update', [ConfigController::class, 'update'])->name('update');
    });
});
