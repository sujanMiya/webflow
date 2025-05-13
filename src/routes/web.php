<?php

use App\Api\OrdersApi;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return (new OrdersApi())->getOrders();
});
