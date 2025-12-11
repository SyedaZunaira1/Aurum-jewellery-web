<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        // API IMPLEMENTATION
        // We fetch all products and return them as JSON.
        // This data can be consumed by other applications or mobile apps.
        $products = Product::all();
        return response()->json([
            'success' => true,
            'count' => $products->count(),
            'data' => $products
        ]);
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
