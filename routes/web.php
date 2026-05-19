<?php

use App\Http\Controllers\GambleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserRegistrationController;
use App\Http\Middleware\LinkIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['signed', LinkIsValid::class])->group(function () {
    Route::get('/gamble/{user}', [GambleController::class, 'index'])->name('gamble_form');
    Route::get('/history/{user}', [HistoryController::class, 'getHistories'])->name('get_histories');
    Route::post('/gamble/{user}/play', [GambleController::class, 'getResult'])->name('calculate_gamble');
    Route::post('/link/generate/{user}', [UserRegistrationController::class, 'getNewLink'])->name('generate_link');
    Route::post('/link/revoke/{user}', [UserRegistrationController::class, 'unsignedLink'])->name('unsigned_link');
});

Route::post('/register', [UserRegistrationController::class, 'register'])->name('register');
