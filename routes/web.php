<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [LoginController::class, 'userLogin'])->name('userLogin');
Route::post('/logout', [LoginController::class, 'userLogout'])->name('userLogout');

Route::get('/index', [LoginController::class, 'index']);
Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers']);
Route::get('/CreateUser', [UserController::class, 'CreateUser']);
Route::get('/GetActiveUsers', [UserController::class, 'GetActiveUsers']);
Route::get('/GetUserRecord/{UserID}', [UserController::class, 'GetUserRecord']);

Route::post('/CreateUserRecord', [UserController::class, 'CreateUserRecord'])->name('info.create');
Route::post('/RemoveUserRecord/{UserID}', [UserController::class, 'RemoveUserRecord']);
Route::post('/EditUserRecord/{UserID}', [UserController::class, 'EditUserRecord']);

Route::middleware('auth')->group(function () {
});





