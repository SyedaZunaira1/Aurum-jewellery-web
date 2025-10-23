<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Homepage – featured 4 products
    public function index()
    {
        $products = Product::take(4)->get(); // Collection
        return view('home', compact('products'));
    }

    // Shop page – all products with pagination
    public function shop()
    {
        $products = Product::paginate(12); // Paginator
        return view('shop', compact('products'));
    }

    // Single product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }
}
