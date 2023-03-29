<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\WarehousesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionPaymentController;
use App\Http\Controllers\WarehouseTypeController;
use App\Models\WarehouseType;

Route::middleware(['auth.apikey', 'auth:sanctum'])->group(function () {
    Route::get('checkSubscriptionPayment', [SubscriptionPaymentController::class, 'check_subscription_payment']);
    // Route::get('profiles/filter',[ProfileController::class,'filter']);
    Route::put('profiles/swap/{id}', [ProfileController::class, 'swap_profile']);

    Route::get('profiles/pay', [SubscriptionPaymentController::class, "pay"]);
    Route::get('profiles/checkPayment', [SubscriptionPaymentController::class, "checkPaymentStatus"]);

    Route::put('updateProfile/{id}', [ProfileController::class, 'update']);
    Route::post('profiles/upload-logo',[ProfileController::class,'upload']);

    Route::apiResource('profiles/subscriptionPayment', SubscriptionPaymentController::class);

    Route::apiResource('profiles', ProfileController::class);
    Route::put('profiles/restore/{id}', [ProfileController::class, 'restoreByAccountId']);
});

Route::middleware(['auth.apikey', 'auth:sanctum'])->prefix('warehouses')->group(function () {
    Route::put('verfied/{id}', [WarehousesController::class, 'verfiedLocation']);
    // Route::put('restore/{id}', [WarehousesController::class, 'restoreByLocationId']);
    Route::post('assignwarehousetouser', [WarehousesController::class, 'assignWarehouseToUser']);
    Route::post('unassignwarehousefromuser', [WarehousesController::class, 'unAssignWarehouseFromUser']);

    Route::apiResource('warehouse-types', WarehouseTypeController::class);
    Route::put('warehouse-types/restore/{warehouse_type}', [WarehouseTypeController::class, 'restore']);
    
});
Route::apiResource('warehouses', WarehousesController::class)->middleware(['auth.apikey', 'auth:sanctum']);




// Route::post('checkTheRole', [WarehousesController::class, 'checkTheRole']);
