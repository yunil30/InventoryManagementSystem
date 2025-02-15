<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        // Check if user is NOT authenticated
        // if (!Auth::check()) {
        //     // Prevent redirect loop by checking the current route
        //     if ($request->routeIs('login')) {
        //         return $next($request);
        //     }

        //     // Redirect unauthenticated users to login page
        //     return redirect()->route('login');
        // }
        // return $next($request);
    }
}
