<?php

namespace App\Http\Controllers;

use App\Models\LoginModel;
use App\Models\MenuMappingModel;
use App\Models\MenuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MaintenanceController extends Controller {
    // Maintenance controllers for list of users
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
        try {
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
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function EditUserRecord(Request $request) {
        try {
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
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function RemoveUserRecord(Request $request) {
        try {
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
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    // Maintenance controllers for list of menus
    public function GetAllMenus() {
        $menus = MenuModel::where('menu_status', 1)->get();

        return response()->json($menus);
    }

    public function GetMenuRecord(Request $request) {
        $MenuRecordID = $request->input('MenuID');

        $menu = MenuModel::where('MenuID', $MenuRecordID)->where('menu_status', 1)->first(); 

        return response()->json($menu);
    }

    public function CreateMenuRecord(Request $request) {
        try {
            $UserID = session('u_id');

            $request->validate([
                'menu_name' => 'required|string|max:45|unique:tbl_user_menu,menu_name',
                'menu_page' => 'required|string|max:45',
                'menu_type' => 'required|string|max:45',
                'parent_menu' => 'required|int|max:100',
                'menu_index' => 'required|int|max:100',
            ]);
    
            MenuModel::create([
                'menu_name' => $request->input('menu_name'),
                'menu_page' => $request->input('menu_page'),
                'menu_type' => $request->input('menu_type'),
                'parent_menu' => $request->input('parent_menu'),
                'menu_index' => $request->input('menu_index'),
                'created_by' => $UserID,
                'menu_status' => 1,
            ]);
    
            return response()->json(['message' => 'Menu created successfully!']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function EditMenuRecord(Request $request) {
        try {
            $UserID = session('u_id');
            $MenuRecordID = $request->input('MenuID');
    
            $request->validate([
                'menu_name' => 'required|string|max:45|unique:tbl_user_menu,menu_name,' . $MenuRecordID . ',MenuID',
                'menu_page' => 'required|string|max:45',
                'menu_type' => 'required|string|max:45',
                'parent_menu' => 'required|int|max:100',
                'menu_index' => 'required|int|max:100',
            ]);
    
            $menu = MenuModel::find($MenuRecordID);
    
            $menu->menu_name = $request->input('menu_name');
            $menu->menu_page = $request->input('menu_page');
            $menu->menu_type = $request->input('menu_type');
            $menu->parent_menu = $request->input('parent_menu');
            $menu->menu_index = $request->input('menu_index');
            $menu->modified_by = $UserID;
            $menu->date_modified = now()->format('Y-m-d H:i:s');
            $menu->save();
        
            return response()->json(['message' => 'Menu record edited successfully!']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function RemoveMenuRecord(Request $request) {
        try {
            $UserID = session('u_id');
            $MenuRecordID = $request->input('MenuID');
    
            $menu = MenuModel::find($MenuRecordID);
        
            if (!$menu) {
                return response()->json(['message' => 'Menu not found.'], 404);
            }
        
            $menu->menu_status = 0;
            $menu->modified_by = $UserID;
            $menu->date_modified = now()->format('Y-m-d H:i:s');
            $menu->save();
        
            return response()->json(['message' => 'Menu status updated successfully!']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    // Maintenance controllers menu mapping
    public function GetAllMappedMenus() {
        $menus = MenuMappingModel::all();

        return response()->json($menus);
    }

    public function GetAccessMenus() {
        $menus = MenuModel::select('MenuID', 'menu_name')->where('menu_status', 1)->get(); 
 
        return response()->json($menus);
    }
}
