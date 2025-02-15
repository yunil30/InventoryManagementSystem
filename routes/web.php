<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [LoginController::class, 'userLogin'])->name('userLogin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ShowHomePage', [LoginController::class, 'ShowHomePage']);
    Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers']);
    Route::get('/CreateUser', [UserController::class, 'CreateUser']);
    Route::get('/GetActiveUsers', [UserController::class, 'GetActiveUsers']);
    Route::get('/GetUserRecord/{UserID}', [UserController::class, 'GetUserRecord']);

    Route::post('/logout', [LoginController::class, 'userLogout'])->name('userLogout');
    Route::post('/CreateUserRecord', [UserController::class, 'CreateUserRecord'])->name('info.create');
    Route::post('/RemoveUserRecord/{UserID}', [UserController::class, 'RemoveUserRecord']);
    Route::post('/EditUserRecord/{UserID}', [UserController::class, 'EditUserRecord']);
});





