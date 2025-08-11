<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;


Route::get('/', action: [HomeController::class, 'index'])->name(name: 'home');




Route::get('/signup', action: [SignupController::class, 'create'])->name(name: 'signup');

Route::get('/login', action: [LoginController::class, 'create'])->name(name: 'login');


Route::get('/car/search', action: [CarController::class, 'search'])->name(name: 'car.search');
Route::get('/car/watchlist', action: [CarController::class, 'watchlist'])->name(name: 'car.watchlist');
Route::resource(name: 'car', controller: CarController::class);
Route::get('/car/{car}/images', [CarController::class, 'carImages'])
        ->name('car.images');
Route::put('/car/{car}/images', [CarController::class, 'updateImages'])
        ->name('car.updateImages');
Route::post('/car/{car}/images', [CarController::class, 'addImages'])
        ->name('car.addImages');


