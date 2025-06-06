<?php

use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bikes/{bike}/rent', [RentalController::class, 'rentBike']);
    Route::post('/rentals/{rental}/return', [RentalController::class, 'returnBike']);
    Route::get('/rentals/user', [RentalController::class, 'getUserRentals']);
    Route::get('/rentals/{rental}/calculate-price', [RentalController::class, 'calculatePrice']);
});