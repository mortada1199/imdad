<?php

use App\Http\Controllers\Coupon\CouponController;
use App\Http\Controllers\emdad\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\emdad\ProductController;

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::put('products/restore/{id}', [ProductController::class, 'restore']);
    Route::post('products/company-products', [ProductController::class, 'setCompanyProduct']);
    Route::post('products/change-Product-Status', [ProductController::class, 'changeProductStatus']);
});


Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::put('categories/RetryApproval', [CategoryController::class, 'RetryRejectedCategories']);
    Route::put('categories/changeCategoryStatus', [CategoryController::class, 'changeCategoryStatus']);
    Route::put('categories/restore/{id}', [CategoryController::class, 'restore']);
    Route::get('categories/serviceOrproduct', [CategoryController::class,'filterCategory']);
    Route::post('categories/company-categories', [CategoryController::class, 'setFavoriteCategories']);
    Route::post('categories/approveCategory', [CategoryController::class, 'approveCategory']);
    Route::post('categories/rejectCategory', [CategoryController::class, 'rejectCategory']);
    Route::get('categories/getCategoryProfile', [CategoryController::class, 'getCategoryProfile']);
    Route::Put('categories/activation/{id}' , [CategoryController::class, 'activate']);

    
    Route::apiResource('categories', CategoryController::class);
});


Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('measures')->group(function () {
    Route::get('get-all-unit-of-measure', [CouponController::class, 'Unit_of_measures']);
});
