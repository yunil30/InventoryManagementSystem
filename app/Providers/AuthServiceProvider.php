<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('auth.user', \App\Http\Middleware\AuthenticateUser::class);
        $this->app['router']->aliasMiddleware('auth.accessLevel', \App\Http\Middleware\CheckAccessLevel::class);
    }
}
