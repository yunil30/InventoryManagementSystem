<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MaintenanceController extends Controller {
    public function GetAllUsers() {
        $users = LoginModel::where('user_status', 1)->get();

        return response()->json($users);
    }

    public function GetUserRecord(Request $request) {
        $UserRecordID = $request->input('UserID');

        $user = LoginModel::where('UserID', $UserRecordID)->where('user_status', 1)->first(); 

        return response()->json($user);
    }

    public function CreateUserRecord(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:145',
            'last_name' => 'required|string|max:145',
            'user_name' => 'required|string|max:50|unique:tbl_user_access,user_name',
            'user_email' => 'required|email|max:50|unique:tbl_user_access,user_email',
            'contact_number' => 'required',
            'password' => 'required|string|min:8', 
            'user_role' => 'required|string|in:user,admin',
            'access_level' => 'required',
        ]);

        $hashedPassword = Hash::make($request->input('password'));

        LoginModel::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'user_email' => $request->input('user_email'),
            'contact_number' => $request->input('contact_number'),
            'password' => $hashedPassword,
            'user_role' => $request->input('user_role'),
            'access_level' => $request->input('access_level'),
            'user_status' => 1,
        ]);

        return response()->json(['message' => 'User created successfully!']);
    }

    public function EditUserRecord(Request $request) {
        $UserID = session('u_id');
        $UserRecordID = $request->input('UserID');

        $request->validate([
            'first_name' => 'required|string|max:145',
            'last_name' => 'required|string|max:145',
            'user_name' => 'required|string|max:50|unique:tbl_user_access,user_name,' . $UserRecordID . ',UserID',
            'user_email' => 'required|email|max:50|unique:tbl_user_access,user_email,' . $UserRecordID . ',UserID',
            'contact_number' => 'required',
            'user_role' => 'required|string|in:user,admin',
            'access_level' => 'required',
        ]);
    
        $user = LoginModel::find($UserRecordID);
    
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->user_email = $request->input('user_email');
        $user->contact_number = $request->input('contact_number');
        $user->user_role = $request->input('user_role');
        $user->access_level = $request->input('access_level');
        $user->modified_by = $UserID;
        $user->date_modified = now()->format('Y-m-d H:i:s');
        $user->save();
    
        return response()->json(['message' => 'User information updated successfully!']);
    }

    public function RemoveUserRecord(Request $request) {
        $UserID = session('u_id');
        $UserRecordID = $request->input('UserID');

        $user = LoginModel::find($UserRecordID);
    
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        $user->user_status = 0;
        $user->modified_by = $UserID;
        $user->date_modified = now()->format('Y-m-d H:i:s');
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully!']);
    }
}
