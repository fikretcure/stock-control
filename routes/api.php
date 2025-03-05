<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware(AuthMiddleware::class)->group(function () {
    Route::prefix('auth')->controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::post('login', 'login')->withoutMiddleware(AuthMiddleware::class);
        Route::get('session', 'session');
    });

    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products',ProductController::class);
    Route::apiResource('suppliers',SupplierController::class);
});
