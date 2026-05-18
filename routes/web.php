<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registerForm', function () {
    return view('register');
});

Route::get('/gamble/{user}', function (\App\Models\User $user) {
    return view('gamble', compact('user'));
})->name('gamble_form')->middleware('signed');

Route::post('/register', [UserRegistrationController::class, 'register'])->name('register');
Route::get('/history/{user}', [HistoryController::class, 'getHistories'])->name('get_histories');
