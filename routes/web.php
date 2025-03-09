<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [LoginController::class, 'userLogin'])->name('userLogin');
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('showRegister');
    Route::post('/register', [RegisterController::class, 'userRegister'])->name('userRegister');
});

Route::middleware(['auth.user'])->group(function () {
    Route::get('/GetMenu', [UserController::class, 'GetMenu']);
    Route::post('/logout', [LoginController::class, 'userLogout'])->name('userLogout');

    Route::middleware(['auth.accessLevel:1'])->group(function () {
        Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers']);
        Route::get('/ShowListOfMenus', [UserController::class, 'ShowListOfMenus']);
        Route::get('/GetAllUsers', [MaintenanceController::class, 'GetAllUsers']);
        Route::get('/GetUserRecord', [MaintenanceController::class, 'GetUserRecord']);
        Route::post('/CreateUserRecord', [MaintenanceController::class, 'CreateUserRecord']);
        Route::post('/EditUserRecord', [MaintenanceController::class, 'EditUserRecord']);
        Route::post('/RemoveUserRecord', [MaintenanceController::class, 'RemoveUserRecord']);
        Route::get('/GetAllMenus', [MaintenanceController::class, 'GetAllMenus']);
    });

    Route::middleware(['auth.accessLevel:2'])->group(function () {
        Route::get('/GetProductRecord', [ProductController::class, 'GetProductRecord']);
        Route::get('/GetAllProducts', [ProductController::class, 'GetAllProducts']);
        Route::post('/CreateProductRecord', [ProductController::class, 'CreateProductRecord']);
        Route::post('/EditProductRecord', [ProductController::class, 'EditProductRecord']);
        Route::post('/RemoveProductRecord', [ProductController::class, 'RemoveProductRecord']);
        Route::get('/GetAllProductCategory', [ProductController::class, 'GetAllProductCategory']);
        Route::post('/CreateProductCategory', [ProductController::class, 'CreateProductCategory']);
    });

    Route::middleware(['auth.accessLevel:3'])->group(function () {
        Route::get('/', function () {return view('home');});
        Route::get('/ShowHomePage', [LoginController::class, 'ShowHomePage']);
        Route::get('/ShowListOfProducts', [UserController::class, 'ShowListOfProducts']);
        Route::get('/ShowUserProfile', [UserController::class, 'ShowUserProfile']);
        Route::get('/GetUserInformation', [UserController::class, 'GetUserInformation']);
        Route::post('/EditUserInfo', [UserController::class, 'EditUserInfo']);
        Route::post('/EditUserContacts', [UserController::class, 'EditUserContacts']);
        Route::post('/ChangePassword', [UserController::class, 'ChangePassword']);
    });
});










 
