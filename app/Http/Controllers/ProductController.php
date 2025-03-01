<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function GetAllProducts() {
        $product = ProductModel::all();

        return response()->json($product);
    }

    public function CreateProductRecord(Request $request) {
        $request->validate([
            'product_code' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_category' => 'required|string|max:255',
            'product_stock' => 'required|integer',
            'product_price' => 'required|numeric',
        ]);

        ProductModel::create([
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'product_category' => $request->input('product_category'),
            'product_stock' => $request->input('product_stock'),
            'product_price' => $request->input('product_price'),
            'user_status' => 1,
        ]);

        return response()->json(['message' => 'Product record created successfully!']);
    }
}
