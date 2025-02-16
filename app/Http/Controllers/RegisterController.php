<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    public function showRegister() {
        return view('authentication.register');
    }    

    public function userRegister(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:145',
            'last_name' => 'required|string|max:145',
            'user_name' => 'required|string|max:50|unique:tbl_user_access,user_name',
            'user_email' => 'required|email|max:50|unique:tbl_user_access,user_email',
            'password' => 'required|string|min:8', 
        ]);

        $hashedPassword = Hash::make($request->input('password'));

        $user = LoginModel::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'user_email' => $request->input('user_email'),
            'password' => $hashedPassword,
            'user_role' => 'user',
            'user_status' => 1,
        ]);

        if ($user) {
            session()->flash('success', 'Registration successful! You can now log in.');
    
            return redirect('/login'); 
        }

        return response()->json(['message' => 'User created successfully!']);
    }
}
