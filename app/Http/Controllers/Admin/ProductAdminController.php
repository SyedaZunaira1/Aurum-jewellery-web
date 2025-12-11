<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $products = $query->paginate(10);
        // Get unique categories from database, with default categories as fallback
        $categories = Product::distinct()->pluck('category')->filter()->sort()->values()->toArray();
        if (empty($categories)) {
            $categories = ['Rings', 'Necklaces', 'Bracelets', 'Anklets'];
        }

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        // Get unique categories from database, with default categories as fallback
        $categories = Product::distinct()->pluck('category')->filter()->sort()->values()->toArray();
        if (empty($categories)) {
            $categories = ['Rings', 'Necklaces', 'Bracelets', 'Anklets'];
        }
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate product data including rating (0-5 scale)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'new_category' => 'nullable|string|max:255',
            'stock' => 'integer',
            'rating' => 'nullable|numeric|min:0|max:5', // Rating between 0 and 5
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Use new category if provided, otherwise use selected category
        if ($request->filled('new_category')) {
            $validated['category'] = $request->new_category;
        } elseif (!$request->filled('category')) {
            // If neither category nor new_category is provided, return error
            return back()->withErrors(['category' => 'Please select a category or add a new one.'])->withInput();
        }

        // Remove new_category from validated data as it's not a database column
        unset($validated['new_category']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Get unique categories from database, with default categories as fallback
        $categories = Product::distinct()->pluck('category')->filter()->sort()->values()->toArray();
        if (empty($categories)) {
            $categories = ['Rings', 'Necklaces', 'Bracelets', 'Anklets'];
        }
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate product data including rating (0-5 scale)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'new_category' => 'nullable|string|max:255',
            'stock' => 'integer',
            'rating' => 'nullable|numeric|min:0|max:5', // Rating between 0 and 5
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Use new category if provided, otherwise use selected category
        if ($request->filled('new_category')) {
            $validated['category'] = $request->new_category;
        } elseif (!$request->filled('category')) {
            // If neither category nor new_category is provided, return error
            return back()->withErrors(['category' => 'Please select a category or add a new one.'])->withInput();
        }

        // Remove new_category from validated data as it's not a database column
        unset($validated['new_category']);


        if ($request->hasFile('image')) {
            // delete old image
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
