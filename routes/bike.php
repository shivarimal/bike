<?php

use App\Http\Controllers\BikeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');
// add bike
Route::get('/bike', function () {
    return Inertia::render('bike/create');
})->name('addbike');
//  store
Route::post('/bike',[BikeController::class,"store"])->name('bike.store');