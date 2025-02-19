<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function ShowHomePage() {
        return view('home');
    }

    public function showLogin() {
        return view('authentication.login');
    }

    public function userLogin(Request $request) {
        $credentials = $request->validate([
            'inputUserName' => ['required'], 
            'inputUserPassword' => ['required']   
        ]);
    
        if (Auth::attempt(['user_name' => $credentials['inputUserName'], 'password' => $credentials['inputUserPassword']])) {
            $request->session()->regenerate();

            return redirect()->intended('/ShowHomePage');
        }
    
        return back()->withErrors([
            'ErrorMessage' => 'Invalid username and password.'
        ]);
    }

    public function userLogout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
