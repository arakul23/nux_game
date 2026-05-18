<?php

use App\Http\Controllers\GambleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/gamble/{user}', [GambleController::class, 'index'])->name('gamble_form')->middleware('signed');
Route::get('/history/{user}', [HistoryController::class, 'getHistories'])->name('get_histories');
Route::get('/calculate/gamble/{user}', [GambleController::class, 'getResult'])->name('calculate_gamble');
Route::get('/link/generate/{user}', [UserRegistrationController::class, 'getLink'])->name('generate_link');
Route::get('/link/unsigned/{user}', [UserRegistrationController::class, 'unsignedLink'])->name('unsigned_link');

Route::post('/register', [UserRegistrationController::class, 'register'])->name('register');
