<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    public function GetAllProducts() {
        $product = ProductModel::all();

        return response()->json($product);
    }

    public function GetProductRecord(Request $request) {
        $ProductRecordID = $request->input('ProductNo');

        $product = ProductModel::where('ProductID', $ProductRecordID)
                               ->where('product_status', 1)
                               ->first(); 

        return response()->json($product);
    }

    public function CreateProductRecord(Request $request) {
        $UserID = session('u_id');

        $request->validate([
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255|unique:tbl_product_record,product_name',
            'product_category' => 'required|string|max:255',
            'product_quantity' => 'required|integer',
            'product_price' => 'required|numeric',
        ]);

        ProductModel::create([
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'product_category' => $request->input('product_category'),
            'product_quantity' => $request->input('product_quantity'),
            'product_price' => $request->input('product_price'),
            'product_status' => 1,
            'created_by' => $UserID
        ]);

        return response()->json(['message' => 'Product record created successfully!']);
    }

    public function EditProductRecord(Request $request) {
        $UserID = session('u_id');
        $ProductRecordID = $request->input('ProductNo');

        $request->validate([
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255|unique:tbl_product_record,product_name,' . $ProductRecordID . ',ProductID',
            'product_category' => 'required|string|max:255',
            'product_quantity' => 'required|integer',
            'product_price' => 'required|numeric',
        ]);

        $product = ProductModel::find($ProductRecordID);

        $product->product_code = $request->input('product_code');
        $product->product_name = $request->input('product_name');
        $product->product_category = $request->input('product_category');
        $product->product_quantity = $request->input('product_quantity');
        $product->product_price = $request->input('product_price');
        $product->modified_by = $UserID;
        $product->date_modified = now()->format('Y-m-d H:i:s');
        $product->save();

        return response()->json(['message' => 'Product record edited successfully!']);
    }

    public function RemoveProductRecord(Request $request) {
        $UserID = session('u_id');
        $ProductRecordID = $request->input('ProductNo');

        $product = ProductModel::find($ProductRecordID);

        $product->product_status = 0;
        $product->modified_by = $UserID;
        $product->date_modified = now()->format('Y-m-d H:i:s');
        $product->save();

        return response()->json(['message' => 'Product record removed successfully!']);
    }

    public function GetAllProductCategory() {
        $category = ProductCategoryModel::all();

        return response()->json($category);
    }

    public function CreateProductCategory(Request $request) {
        $UserID = session('u_id');

        $request->validate([
            'category' => 'required|string|max:255|unique:tbl_product_category,category',
        ]);

        ProductCategoryModel::create([
            'category' => $request->input('category'),
            'category_status' => 1,
            'created_by' => $UserID
        ]);

        return response()->json(['message' => 'Product record created successfully!']);
    }

    public function GetProductQuantityByCategory() {
        $products = ProductModel::with('category')->get();

        $grouped = $products->groupBy(function ($product) {
            return $product->category ? $product->category->category : 'Unknown';
        });

        $categories = $grouped->keys()->toArray();
        $quantities = $grouped->map(function ($items) {
            return $items->sum('product_quantity');
        })->toArray();

        return ['categories' => $categories, 'quantities' => $quantities];
    }

    public function GetTotalInventoryValue() {
        $products = ProductModel::all();
        
        $totalValue = 0;
    
        foreach ($products as $product) {
            $totalValue += $product->product_quantity * $product->product_price;
        }
    
        return ['totalValue' => $totalValue];
    }

    public function GetMostExpensiveProducts() {
        $mostExpensiveProducts = ProductModel::select('ProductID', 'product_name', 'product_price')
            ->orderBy('product_price', 'desc')
            ->take(5)
            ->get();
    
        return response()->json($mostExpensiveProducts);
    }
    
    public function GetRecentProducts() {
        $recentProducts = ProductModel::select('product_name', 'date_created')
            ->orderBy('date_created', 'desc')
            ->take(5)
            ->get();

        return response()->json($recentProducts);
    }

    public function GetProductStatus() {
        $inStockCount = ProductModel::where('product_quantity', '>=', 5)->sum('product_quantity'); 
        $lowStockCount = ProductModel::where('product_quantity', '<', 5)->where('product_quantity', '>', 0)->sum('product_quantity');
        $outOfStockCount = ProductModel::where('product_quantity', 0)->sum('product_quantity');  
    
        return response()->json([
            'inStock' => $inStockCount,
            'lowStock' => $lowStockCount,
            'outOfStock' => $outOfStockCount
        ]);
    }
}
