<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\OrderController;


Route::get("/", [OrderController::class, "index"])->name("index");

Route::post("pay/{order}", [OrderController::class, "pay"])->name("pay");
Route::get("failed", [OrderController::class, "failed"])->name("failed");
