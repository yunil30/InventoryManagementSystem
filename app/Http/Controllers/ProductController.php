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

    public function Dashboard(Request $request)
    {
        // 1. Product Category Distribution
        $categoryCounts = ProductModel::select('product_category', DB::raw('count(*) as count'))
                                 ->groupBy('product_category')
                                 ->get();

        $categories = [];
        $counts = [];
        foreach ($categoryCounts as $category) {
            $categories[] = $category->category->category;  // Eager load 'category' relationship
            $counts[] = $category->count;
        }

        // 2. Stock Level Distribution (In Stock, Low Stock, Out of Stock)
        $stockStatusCounts = ProductModel::select('product_status', DB::raw('count(*) as count'))
                                    ->groupBy('product_status')
                                    ->get();

        $statusLabels = ['In Stock', 'Out of Stock'];
        $stockCounts = [0, 0]; // Default values
        foreach ($stockStatusCounts as $status) {
            if ($status->product_status == 1) {
                $stockCounts[0] = $status->count; // In Stock
            } else {
                $stockCounts[1] = $status->count; // Out of Stock
            }
        }

        // 3. Total Inventory Value (Price * Quantity)
        $totalInventoryValue = ProductModel::sum(DB::raw('product_price * product_quantity'));

        // 4. Top 5 Most Expensive Products
        $mostExpensiveProducts = ProductModel::orderBy('product_price', 'desc')
                                        ->take(5)
                                        ->get();

        // 5. Recently Added Products
        $recentProducts = ProductModel::orderBy('date_created', 'desc')
                                 ->take(5)
                                 ->get();

        // 6. Price Range Distribution
        $priceRanges = ProductModel::select(DB::raw('
                CASE
                    WHEN product_price <= 10000 THEN "0-10000"
                    WHEN product_price BETWEEN 10001 AND 30000 THEN "10001-30000"
                    ELSE "30000+" 
                END AS price_range'), DB::raw('count(*) as count'))
            ->groupBy('price_range')
            ->get();

        $priceLabels = [];
        $priceCounts = [];
        foreach ($priceRanges as $range) {
            $priceLabels[] = $range->price_range;
            $priceCounts[] = $range->count;
        }

        return response()->json([
            'categoryCounts' => $categoryCounts,
            'stockStatusCounts' => $stockStatusCounts,
            'totalInventoryValue' => $totalInventoryValue,
            'mostExpensiveProducts' => $mostExpensiveProducts,
            'recentProducts' => $recentProducts,
            'priceRangeDistribution' => [
                'labels' => $priceLabels,
                'counts' => $priceCounts
            ]
        ]);
    }

    public function GetCategoryDistribution() {
        // Retrieve the products with the category relationship loaded
        $products = ProductModel::with('category')->get();

        // Group the products by category
        $grouped = $products->groupBy(function ($product) {
            return $product->category ? $product->category->category : 'Unknown'; // Category name or 'Unknown' if not set
        });

        // Get the category names and counts
        $categories = $grouped->keys()->toArray(); // Get the category names (keys of the group)
        $quantities = $grouped->map(function ($items) {
            // Sum up the product quantities for each category
            return $items->sum('product_quantity');
        })->toArray();

        return ['categories' => $categories, 'quantities' => $quantities];
    }
}
