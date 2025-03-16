<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gates for user records
        Gate::define('create-user-record', function ($user) {
            return $user->access_level == 1; 
        });

        Gate::define('edit-user-record', function ($user) {
            return $user->access_level == 1; 
        });

        Gate::define('remove-user-record', function ($user) {
            return $user->access_level == 1; 
        });

        // Gates for product records
        Gate::define('create-product-record', function ($user) {
            return $user->access_level <= 2; 
        });

        Gate::define('edit-product-record', function ($user) {
            return $user->access_level <= 2; 
        });

        Gate::define('remove-product-record', function ($user) {
            return $user->access_level == 1; 
        });

        // Gates for menu records
        Gate::define('create-menu-record', function ($user) {
            return $user->access_level <= 2; 
        });

        Gate::define('edit-menu-record', function ($user) {
            return $user->access_level <= 2; 
        });

        Gate::define('remove-menu-record', function ($user) {
            return $user->access_level == 1; 
        });

    }
}
