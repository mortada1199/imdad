<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\BrandController;
use App\Http\Controllers\Settings\ColorController;
use App\Http\Controllers\Settings\DriverNationalityController;
use App\Http\Controllers\Settings\ModelController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Settings\SizeController;

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('brands', BrandController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('colors', ColorController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('models', ModelController::class);
});



Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('sizes', SizeController::class);
});


Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('nationality', DriverNationalityController::class);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('preferences', SettingsController::class);
});