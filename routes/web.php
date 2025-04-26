<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use Illuminate\Contracts\Foundation\MaintenanceMode;
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
    Route::get('/GetItemQuantityByCategory', [ItemController::class, 'GetItemQuantityByCategory']);
    Route::get('/GetTotalInventoryValue', [ItemController::class, 'GetTotalInventoryValue']);
    Route::get('/GetMostExpensiveItems', [ItemController::class, 'GetMostExpensiveItems']);
    Route::get('/GetRecentItems', [ItemController::class, 'GetRecentItems']);
    Route::get('/GetItemStatus', [ItemController::class, 'GetItemStatus']);

    Route::get('/GetMenu', [UserController::class, 'GetMenu']);
    Route::post('/logout', [LoginController::class, 'userLogout'])->name('userLogout');

    Route::middleware(['auth.accessLevel:1'])->group(function () {
        // Users page controllers
        Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers']);
        Route::post('/CreateUserRecord', [MaintenanceController::class, 'CreateUserRecord']);
        Route::post('/EditUserRecord', [MaintenanceController::class, 'EditUserRecord']);
        Route::post('/RemoveUserRecord', [MaintenanceController::class, 'RemoveUserRecord']);
        
        // Menu mapping page controllers
        Route::get('/GetAllMappedMenus', [MaintenanceController::class, 'GetAllMappedMenus']);
        Route::get('/GetMappedMenusByAccess', [MaintenanceController::class, 'GetMappedMenusByAccess']);
        Route::get('/GetAccessMenus', [MaintenanceController::class, 'GetAccessMenus']);
        Route::post('/CreateAccessMenus', [MaintenanceController::class, 'CreateAccessMenus']);
        Route::post('/EditAccessMenus', [MaintenanceController::class, 'EditAccessMenus']);
    });

    Route::middleware(['auth.accessLevel:2'])->group(function () {
        // Users page controllers
        Route::get('/ShowListOfUsers', [UserController::class, 'ShowListOfUsers']);
        Route::get('/GetAllUsers', [MaintenanceController::class, 'GetAllUsers']);
        Route::get('/GetUserRecord', [MaintenanceController::class, 'GetUserRecord']);

        // Menu page controllers
        Route::get('/ShowListOfMenus', [UserController::class, 'ShowListOfMenus']);
        Route::get('/GetAllMenus', [MaintenanceController::class, 'GetAllMenus']);
        Route::get('/GetMenuRecord', [MaintenanceController::class, 'GetMenuRecord']);
        Route::post('/CreateMenuRecord', [MaintenanceController::class, 'CreateMenuRecord']);
        Route::post('/EditMenuRecord', [MaintenanceController::class, 'EditMenuRecord']);
        Route::post('/RemoveMenuRecord', [MaintenanceController::class, 'RemoveMenuRecord']);

        // Item page controllers
        Route::post('/CreateItemRecord', [ItemController::class, 'CreateItemRecord']);
        Route::post('/EditItemRecord', [ItemController::class, 'EditItemRecord']);
        Route::post('/RemoveItemRecord', [ItemController::class, 'RemoveItemRecord']);

        // Menu mapping controllers
        Route::get('/ShowMenuMapping', function () {return view('maintenance.MenuMapping');});
    });

    Route::middleware(['auth.accessLevel:3'])->group(function () {
        // Item page controllers
        Route::get('/GetItemRecord', [ItemController::class, 'GetItemRecord']);
        Route::get('/GetAllItems', [ItemController::class, 'GetAllItems']);

        // Item category controllers
        Route::get('/GetAllItemCategory', [ItemController::class, 'GetAllItemCategory']);
        Route::post('/CreateItemCategory', [ItemController::class, 'CreateItemCategory']);

        Route::get('/', function () {return view('home');});
        Route::get('/', [LoginController::class, 'ShowHomePage']);
        Route::get('/ShowListOfItems', [UserController::class, 'ShowListOfItems']);
        Route::get('/ShowUserProfile', [UserController::class, 'ShowUserProfile']);
        Route::get('/ShowListOfRequests', [UserController::class, 'ShowListOfRequests']);
        Route::get('/GetUserInformation', [UserController::class, 'GetUserInformation']);
        Route::post('/EditUserInfo', [UserController::class, 'EditUserInfo']);
        Route::post('/EditUserContacts', [UserController::class, 'EditUserContacts']);
        Route::post('/ChangePassword', [UserController::class, 'ChangePassword'])->name('userChangePassword');
    });
});










 
