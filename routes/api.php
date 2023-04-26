<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ConfigController;
use App\Http\Controllers\Api\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->name('products.')->group(function () {
    Route::post('/', [ProductController::class, 'index']);
});
Route::prefix('configs')->name('configs.')->group(function () {
    Route::post('/', [ConfigController::class, 'index']);
});
Route::prefix('orders')->name('orders.')->group(function () {
    Route::post('/list', [OrderController::class, 'list']);
    Route::post('/create', [OrderController::class, 'create']);
});