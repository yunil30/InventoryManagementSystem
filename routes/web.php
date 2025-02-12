<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/index', [LoginController::class, 'index']);
// Route::get('/index', [LoginController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [LoginController::class, 'userLogin'])->name('userLogin');
Route::post('/logout', [LoginController::class, 'userLogout'])->name('userLogout');

