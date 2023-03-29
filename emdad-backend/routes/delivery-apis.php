<?php

use App\Http\Controllers\Profile\DriverController;
use App\Http\Controllers\Profile\TruckController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth.apikey','auth:sanctum'])->group(function() {
    Route::apiResource('trucks',TruckController::class);
});

Route::middleware(['auth.apikey','auth:sanctum'])->prefix('trucks')->group(function() {
    Route::put('restore/{id}', [TruckController::class, 'restoretruck']);
    Route::post('suspend/{id}', [TruckController::class, 'suspend']);
});


Route::middleware(['auth.apikey','auth:sanctum'])->group(function() {
    Route::apiResource('drivers',DriverController::class);
    Route::put('drivers/restore/{id}', [DriverController::class, 'restore']);
    Route::post('drivers/suspend/{id}', [DriverController::class, 'suspend']);

});
