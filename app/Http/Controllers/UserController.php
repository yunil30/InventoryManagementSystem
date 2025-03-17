<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use App\Models\MenuModel;
use App\Models\MenuMappingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function ShowListOfUsers() {
        return view('maintenance.ListOfUsers');
    }

    public function ShowListOfMenus() {
        return view('maintenance.ListOfMenus');
    }

    public function ShowUserProfile() {
        return view('UserProfile');
    }

    public function ShowListOfItems() {
        return view('ListOfItems');
    }

    public function ShowListOfRequests() {
        return view('ListOfRequests');
    }

    public function GetMenu() {
        $accessLevel = session('u_level'); 

        $menuMapping = MenuMappingModel::whereJsonContains('access_level', (int)$accessLevel)->get();

        $menuIDs = $menuMapping->pluck('MenuID')->flatten()->map(function ($menuID) {
            return json_decode($menuID);  
        })->flatten()->unique();

        $menus = MenuModel::whereIn('MenuID', $menuIDs)->get();

        return response()->json($menus);
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
