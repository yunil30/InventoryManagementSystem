<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [LoginController::class, 'userLogin'])->name('userLogin');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('showRegister');
    Route::post('/register', [RegisterController::class, 'userRegister'])->name('userRegister');
});

Route::middleware(\App\Http\Middleware\AuthenticateUser::class)->group(function () {
    Route::get('/', function () {return view('welcome');});
    Route::get('/ShowHomePage', [LoginController::class, 'ShowHomePage']);
    Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers']);
    Route::get('/ShowListOfProducts', [UserController::class, 'ShowListOfProducts']);
    Route::get('/CreateUser', [UserController::class, 'CreateUser']);
    Route::get('/GetActiveUsers', [UserController::class, 'GetActiveUsers']);
    Route::get('/GetUserRecord/{UserID}', [UserController::class, 'GetUserRecord']);
    Route::get('/ShowUserProfile', [UserController::class, 'ShowUserProfile']);
    Route::get('/GetUserInformation', [UserController::class, 'GetUserInformation']);

    Route::post('/logout', [LoginController::class, 'userLogout'])->name('userLogout');
    Route::post('/CreateUserRecord', [UserController::class, 'CreateUserRecord'])->name('info.create');
    Route::post('/RemoveUserRecord/{UserID}', [UserController::class, 'RemoveUserRecord']);
    Route::post('/EditUserRecord/{UserID}', [UserController::class, 'EditUserRecord']);

    Route::get('/GetAllProducts', [ProductController::class, 'GetAllProducts']);
    Route::post('/CreateProductRecord', [ProductController::class, 'CreateProductRecord']);

    Route::get('/GetAllProductCategory', [ProductController::class, 'GetAllProductCategory']);
    Route::post('/CreateProductCategory', [ProductController::class, 'CreateProductCategory']);

    Route::post('/EditUserInfo', [UserController::class, 'EditUserInfo']);
    Route::post('/EditUserContacts', [UserController::class, 'EditUserContacts']);
    Route::post('/ChangePassword', [UserController::class, 'ChangePassword']);
});
