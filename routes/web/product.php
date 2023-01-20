<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductController;

Route::get("/", [ProductController::class, "index"])->name('product.index');

Route::post("order/{product}", [ProductController::class, "order"])->name("product.order");
