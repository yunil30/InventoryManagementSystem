<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function ShowListOfUsers() {
        return view('ListOfUsers');
    }

    public function ShowUserProfile() {
        return view('UserProfile');
    }

    public function ShowListOfProducts() {
        return view('ListOfProducts');
    }

    public function GetActiveUsers() {
        $users = LoginModel::where('user_status', 1)->get();

        return response()->json($users);
    }

    public function GetUserRecord($UserID) {
        $user = LoginModel::where('UserID', $UserID)->where('user_status', 1)->first(); 

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
        ]);
    
        $user = LoginModel::find($UserRecordID);
    
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->user_email = $request->input('user_email');
        $user->contact_number = $request->input('contact_number');
        $user->user_role = $request->input('user_role');
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

    public function GetUserInformation() {
        $UserID = session('u_id');

        $userRecord = LoginModel::where('UserID',  $UserID)->first();
  
        return $userRecord->toArray();
    }

    public function EditUserInfo(Request $request) {
        $UserID = session('u_id');

        $request->validate([
            'first_name' => 'required|string|max:145',
            'last_name' => 'required|string|max:145',
            'user_name' => 'required|string|max:50|unique:tbl_user_access,user_name,' . $UserID . ',UserID',
        ]);

        $user = LoginModel::find($UserID);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->modified_by = $UserID;
        $user->date_modified = now()->format('Y-m-d H:i:s');
        $user->save();
    
        return response()->json(['message' => 'User information updated successfully!']);
    }

    public function EditUserContacts(Request $request) {
        $UserID = session('u_id');

        $request->validate([
            'user_email' => 'required|email|max:50|unique:tbl_user_access,user_email,' . $UserID . ',UserID',
            'contact_number' => 'required',
        ]);

        $user = LoginModel::find($UserID);

        $user->user_email = $request->input('user_email');
        $user->contact_number = $request->input('contact_number');
        $user->modified_by = $UserID;
        $user->date_modified = now()->format('Y-m-d H:i:s');
        $user->save();
    
        return response()->json(['message' => 'User information updated successfully!']);
    }

    public function ChangePassword(Request $request) {
        $UserID = session('u_id');

        $request->validate([
            'password' => 'required|string|min:8', 
        ]);

        $hashedPassword = Hash::make($request->input('password'));

        $user = LoginModel::find($UserID);

        $user->password = $hashedPassword;
        $user->modified_by = $UserID;
        $user->date_modified = now()->format('Y-m-d H:i:s');
        $user->save();

        return response()->json(['message' => 'User password changed successfully!']);
    }
}
