<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use App\Models\ItemCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller {
    public function GetAllItems() {
        $item = ItemModel::all();

        return response()->json($item);
    }

    public function GetItemRecord(Request $request) {
        $ItemRecordID = $request->input('ItemNo');

        $item = ItemModel::where('ItemID', $ItemRecordID)
                               ->where('item_status', 1)
                               ->first(); 

        return response()->json($item);
    }

    public function CreateItemRecord(Request $request) {
        $UserID = session('u_id');

        $request->validate([
            'item_code' => 'required|string|max:255',
            'item_name' => 'required|string|max:255|unique:tbl_item_record,item_name',
            'item_category' => 'required|string|max:255',
            'item_quantity' => 'required|integer',
            'item_price' => 'required|numeric',
        ]);

        ItemModel::create([
            'item_code' => $request->input('item_code'),
            'item_name' => $request->input('item_name'),
            'item_category' => $request->input('item_category'),
            'item_quantity' => $request->input('item_quantity'),
            'item_price' => $request->input('item_price'),
            'item_status' => 1,
            'created_by' => $UserID
        ]);

        return response()->json(['message' => 'Item record created successfully!']);
    }

    public function EditItemRecord(Request $request) {
        $UserID = session('u_id');
        $ItemRecordID = $request->input('ItemNo');

        $request->validate([
            'item_code' => 'required|string|max:255',
            'item_name' => 'required|string|max:255|unique:tbl_item_record,item_name,' . $ItemRecordID . ',ItemID',
            'item_category' => 'required|string|max:255',
            'item_quantity' => 'required|integer',
            'item_price' => 'required|numeric',
        ]);

        $item = ItemModel::find($ItemRecordID);

        $item->item_code = $request->input('item_code');
        $item->item_name = $request->input('item_name');
        $item->item_category = $request->input('item_category');
        $item->item_quantity = $request->input('item_quantity');
        $item->item_price = $request->input('item_price');
        $item->modified_by = $UserID;
        $item->date_modified = now()->format('Y-m-d H:i:s');
        $item->save();

        return response()->json(['message' => 'Item record edited successfully!']);
    }

    public function RemoveItemRecord(Request $request) {
        $UserID = session('u_id');
        $ItemRecordID = $request->input('ItemNo');

        $item = ItemModel::find($ItemRecordID);

        $item->item_status = 0;
        $item->modified_by = $UserID;
        $item->date_modified = now()->format('Y-m-d H:i:s');
        $item->save();

        return response()->json(['message' => 'Item was removed successfully!']);
    }

    public function GetAllItemCategory() {
        $category = ItemCategoryModel::all();

        return response()->json($category);
    }

    public function CreateItemCategory(Request $request) {
        $UserID = session('u_id');

        $request->validate([
            'category' => 'required|string|max:255|unique:tbl_item_category,category',
        ]);

        ItemCategoryModel::create([
            'category' => $request->input('category'),
            'category_status' => 1,
            'created_by' => $UserID
        ]);

        return response()->json(['message' => 'Item record created successfully!']);
    }

    public function GetItemQuantityByCategory() {
        $items = ItemModel::with('category')->get();

        $grouped = $items->groupBy(function ($item) {
            return $item->category ? $item->category->category : 'Unknown';
        });

        $categories = $grouped->keys()->toArray();
        $quantities = $grouped->map(function ($items) {
            return $items->sum('item_quantity');
        })->toArray();

        return ['categories' => $categories, 'quantities' => $quantities];
    }

    public function GetTotalInventoryValue() {
        $items = ItemModel::all();
        
        $totalValue = 0;
    
        foreach ($items as $item) {
            $totalValue += $item->item_quantity * $item->item_price;
        }
    
        return ['totalValue' => $totalValue];
    }

    public function GetMostExpensiveItems() {
        $mostExpensiveItems = ItemModel::select('ItemID', 'item_name', 'item_price')
            ->orderBy('item_price', 'desc')
            ->take(5)
            ->get();
    
        return response()->json($mostExpensiveItems);
    }
    
    public function GetRecentItems() {
        $recentItems = ItemModel::select('item_name', 'date_created')
            ->orderBy('date_created', 'desc')
            ->take(5)
            ->get();

        return response()->json($recentItems);
    }

    public function GetItemStatus() {
        $inStockCount = ItemModel::where('item_quantity', '>=', 5)->sum('item_quantity'); 
        $lowStockCount = ItemModel::where('item_quantity', '<', 5)->where('item_quantity', '>', 0)->sum('item_quantity');
        $outOfStockCount = ItemModel::where('item_quantity', 0)->sum('item_quantity');  
    
        return response()->json([
            'inStock' => $inStockCount,
            'lowStock' => $lowStockCount,
            'outOfStock' => $outOfStockCount
        ]);
    }
}
