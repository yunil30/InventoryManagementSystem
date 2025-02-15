<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function ShowHomePage() {
        return view('home');
    }

    public function showLogin() {
        if (Auth::check()) {
            return redirect('/ShowHomePage');
        }

        return view('authentication.login');
    }

    public function userLogin(Request $request) {
        $credentials = $request->validate([
            'user_name' => ['required'], 
            'password' => ['required']   
        ]);
    
        if (Auth::attempt(['user_name' => $credentials['user_name'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            return redirect()->intended('/ShowHomePage');
        }
    
        return back()->withErrors([
            'user_name' => 'The provided credentials are incorrect.'
        ]);
    }

    public function userLogout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
