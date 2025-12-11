<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Homepage – featured products (limited to 8)
    // PURPOSE: This function gets 8 products from the database to show on the Home Page.
    public function index()
    {
        $products = Product::take(8)->get(); // "take(8)" limits the result to 8 items.
        return view('home', compact('products')); // Send them to 'home' view.
    }

    // Shop page – all products with pagination, category filter, and search
    // Shop page – all products with pagination, category filter, and search
    // PURPOSE: This is the main shop logic. It handles showing products, filtering by category, and searching.
    public function shop(Request $request)
    {
        $query = Product::query(); // Start building a query to fetch products.

        // Search Logic: If 'search' word is present in URL, add a WHERE clause.
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Category Logic: If 'category' is selected, add a WHERE clause.
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Pagination: Show 12 products per page using "paginate(12)".
        // "appends" keeps the current filters (search/category) in the URL links when changing pages.
        $products = $query->paginate(12)->appends($request->query());

        // Get unique categories for the dropdown menu.
        // "pluck('category')" gets only the category column. "distinct()" gets unique values.
        $categories = Product::distinct()->pluck('category')->filter()->sort()->values()->toArray();
        if (empty($categories)) {
            $categories = ['Rings', 'Necklaces', 'Bracelets', 'Anklets'];
        }

        return view('shop', compact('products', 'categories'));
    }

    // Ajax Search
    // Ajax Search
    // PURPOSE: This function is called by JAVASCRIPT to update the search results dropdown INSTANTLY.
    // KEYWORD: "AJAX" means it happens in the background without reloading the page.
    public function ajaxSearch(Request $request)
    {
        $query = Product::query();

        // Check if user typed something
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        // Check if a category is filtered
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Return only top 5 matches as JSON (Data format for JavaScript)
        // We select specific columns to keep it fast.
        $products = $query->take(5)->get(['id', 'name', 'price', 'image', 'category']);

        return response()->json($products);
    }

    // Single product
    // Single product
    // PURPOSE: Shows the details page of ONE specific product.
    // "findOrFail" tries to find the product ID, if not found, it shows 404 Error automatically.
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product', compact('product'));
    }
}
