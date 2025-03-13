<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    // Login page controllers
    Route::get('/login', [LoginController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [LoginController::class, 'userLogin'])->name('userLogin');

    // Registration page controllers
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('showRegister');
    Route::post('/register', [RegisterController::class, 'userRegister'])->name('userRegister');

    Route::get('/reset', [LoginController::class, 'showResetPassword'])->name('showResetPassword');
});

Route::middleware(['auth.user'])->group(function () {
    Route::get('/GetProductQuantityByCategory', [ProductController::class, 'GetProductQuantityByCategory']);
    Route::get('/GetTotalInventoryValue', [ProductController::class, 'GetTotalInventoryValue']);
    Route::get('/GetMostExpensiveProducts', [ProductController::class, 'GetMostExpensiveProducts']);
    Route::get('/GetRecentProducts', [ProductController::class, 'GetRecentProducts']);
    Route::get('/GetProductStatus', [ProductController::class, 'GetProductStatus']);

    Route::get('/GetMenu', [UserController::class, 'GetMenu']);
    Route::post('/logout', [LoginController::class, 'userLogout'])->name('userLogout');

    Route::middleware(['auth.accessLevel:1'])->group(function () {
        // Users page controllers
        Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers']);
        Route::get('/GetAllUsers', [MaintenanceController::class, 'GetAllUsers']);
        Route::get('/GetUserRecord', [MaintenanceController::class, 'GetUserRecord']);
        Route::post('/CreateUserRecord', [MaintenanceController::class, 'CreateUserRecord']);
        Route::post('/EditUserRecord', [MaintenanceController::class, 'EditUserRecord']);
        Route::post('/RemoveUserRecord', [MaintenanceController::class, 'RemoveUserRecord']);

        // Menu page controllers
        Route::get('/ShowListOfMenus', [UserController::class, 'ShowListOfMenus']);
        Route::get('/GetAllMenus', [MaintenanceController::class, 'GetAllMenus']);
        Route::get('/GetMenuRecord', [MaintenanceController::class, 'GetMenuRecord']);
        Route::post('/CreateMenuRecord', [MaintenanceController::class, 'CreateMenuRecord']);
        Route::post('/EditMenuRecord', [MaintenanceController::class, 'EditMenuRecord']);
        Route::post('/RemoveMenuRecord', [MaintenanceController::class, 'RemoveMenuRecord']);

        // Menu mapping controllers
        Route::get('/ShowMenuMapping', function () {return view('maintenance.MenuMapping');});
    });

    Route::middleware(['auth.accessLevel:2'])->group(function () {
        // Product page controllers
        Route::get('/GetProductRecord', [ProductController::class, 'GetProductRecord']);
        Route::get('/GetAllProducts', [ProductController::class, 'GetAllProducts']);
        Route::post('/CreateProductRecord', [ProductController::class, 'CreateProductRecord']);
        Route::post('/EditProductRecord', [ProductController::class, 'EditProductRecord']);
        Route::post('/RemoveProductRecord', [ProductController::class, 'RemoveProductRecord']);

        // Product category controllers
        Route::get('/GetAllProductCategory', [ProductController::class, 'GetAllProductCategory']);
        Route::post('/CreateProductCategory', [ProductController::class, 'CreateProductCategory']);
    });

    Route::middleware(['auth.accessLevel:3'])->group(function () {
        Route::get('/', function () {return view('home');});
        Route::get('/', [LoginController::class, 'ShowHomePage']);
        Route::get('/ShowListOfProducts', [UserController::class, 'ShowListOfProducts']);
        Route::get('/ShowUserProfile', [UserController::class, 'ShowUserProfile']);
        Route::get('/GetUserInformation', [UserController::class, 'GetUserInformation']);
        Route::post('/EditUserInfo', [UserController::class, 'EditUserInfo']);
        Route::post('/EditUserContacts', [UserController::class, 'EditUserContacts']);
        Route::post('/ChangePassword', [UserController::class, 'ChangePassword']);
    });
});










 
