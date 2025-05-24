<?php

use App\Http\Controllers\Order\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Site\SiteController;

Route::group(['prefix' => 'v1'], function () {
    Route::get("{site_id}/products", [ProductController::class, 'index']);
    Route::get("{site_id}/products/{product_id}", [ProductController::class, 'show']);
    Route::get("{site_id}/orders", [OrderController::class, 'index']);
    Route::get("{site_id}/orders/{order_id}", [OrderController::class, 'show']);
    Route::get("sites", [SiteController::class, 'index']);
    Route::get("sites/{site_id}", [SiteController::class, 'show']);
});