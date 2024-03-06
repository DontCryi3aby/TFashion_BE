<?php

use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\CustomerController;
use App\Http\Controllers\V1\FeedbackController;
use App\Http\Controllers\V1\GalleryController;
use App\Http\Controllers\V1\OrderController;
use App\Http\Controllers\V1\OrderDetailsController;
use App\Http\Controllers\V1\ProductController;
use App\Http\Controllers\V1\ReviewController;
use App\Http\Controllers\V1\RoleController;
use App\Http\Controllers\V1\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('feedbacks', FeedbackController::class);
    Route::apiResource('galleries', GalleryController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('order_details', OrderDetailsController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('sizes', SizeController::class);
    Route::apiResource('product_quantities', SizeController::class);
});