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

        // Search by Product Name
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);
        // Get unique categories from database, with default categories as fallback
        $categories = Product::distinct()->pluck('category')->filter()->sort()->values()->toArray();
        if (empty($categories)) {
            $categories = ['Rings', 'Necklaces', 'Bracelets', 'Anklets'];
        }

        return view('admin.products.index', compact('products', 'categories'));
    }

    // Delete Category Implementation
    // This allows moving products to 'Uncategorized' or deleting them completely.
    // ACTION: 'move' -> Updates category of products. 'delete' -> Deletes products & images.
    public function deleteCategory(Request $request)
    {
        $request->validate([
            'category' => 'required|string|exists:products,category',
            'action' => 'required|in:move,delete'
        ]);

        $category = $request->input('category');
        $action = $request->input('action');

        if ($action == 'delete') {
            // Delete all products in this category
            $products = Product::where('category', $category)->get();
            $count = $products->count();

            foreach ($products as $product) {
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->delete();
            }
            return redirect()->route('admin.products.index')->with('success', "Category '$category' removed. $count products were permanently deleted.");
        } else {
            // Move products to 'Uncategorized'
            $count = Product::where('category', $category)->update(['category' => 'Uncategorized']);
            return redirect()->route('admin.products.index')->with('success', "Category '$category' removed. $count products moved to 'Uncategorized'.");
        }
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
