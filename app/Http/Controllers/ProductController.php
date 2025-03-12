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

    public function Dashboard(Request $request) {
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

    public function testing()
    {
        // Retrieve all product records from the database
        $products = ProductModel::all();
    
        // Initialize an array to store products with their statuses
        $productStatuses = [];
    
        foreach ($products as $product) {
            // Determine the product status based on quantity and product status
            $status = $this->getProductStatus($product);
    
            // Add the product and its status to the result array
            $productStatuses[] = [
                'product_code' => $product->product_code,
                'product_name' => $product->product_name,
                'product_quantity' => $product->product_quantity,
                'product_status' => $product->product_status, // product_status = 1 (active), 0 (inactive)
                'status' => $status, // This is the calculated status (In Stock, Low Stock, or Out of Stock)
            ];
        }
    
        // Return the product status data as JSON
        return response()->json($productStatuses);
    }
    
    // Helper method to determine the product status
    private function getProductStatus($product)
    {
        // Define the stock status based on product quantity
        if ($product->product_quantity == 0) {
            return 'Out of Stock'; // If quantity is 0, it's out of stock
        }
    
        if ($product->product_quantity < 5) {
            return 'Low Stock'; // If quantity is below 5, it's low stock
        }
    
        return 'In Stock'; // If quantity is 5 or more, it's in stock
    }
    
    
}
