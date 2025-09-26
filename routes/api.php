<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;

Route::prefix('users')->group(function () {
    Route::post('/create', [UserController::class, 'create']);
    Route::post('/login', [UserController::class, 'login']);
    
});

Route::middleware('auth:sanctum')->prefix('users')->group(function () {
    Route::post('/getActiveUser', [UserController::class, 'getActiveUser']);
});

Route::middleware('auth:sanctum')->prefix('flight')->group(function () {
    Route::post('/flights', [FlightController::class, 'getFlights']);
});