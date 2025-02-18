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
            'inputFirstName' => 'required|string|max:145',
            'inputLastName' => 'required|string|max:145',
            'inputUserName' => 'required|string|max:50|unique:tbl_user_access,user_name',
            'inputUserEmail' => 'required|email|max:50|unique:tbl_user_access,user_email',
            'inputUserPassword' => 'required|string|min:8', 
        ]);

        $hashedPassword = Hash::make($request->input('inputUserPassword'));

        $user = LoginModel::create([
            'first_name' => $request->input('inputFirstName'),
            'last_name' => $request->input('inputLastName'),
            'user_name' => $request->input('inputUserName'),
            'user_email' => $request->input('inputUserEmail'),
            'password' => $hashedPassword,
            'user_role' => 'user',
            'user_status' => 1,
        ]);

        if ($user) {
            session()->flash('success', 'Registration successful! You can now login.');
    
            return redirect('/login'); 
        }

        return response()->json(['message' => 'User created successfully!']);
    }
}
