<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart
    // Show cart
    // PURPOSE: Retrieve the cart from the SESSION and show it to the user.
    public function show()
    {
        $cart = session()->get('cart', []); // "session()" is a temporary storage for the user.
        return view('cart', compact('cart'));
    }

    // Add product to cart
    // Add product to cart
    // PURPOSE: Add a product to the session cart array.
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Logic: If item exists, increase quantity. If not, add it as new.
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image, // relative to public folder
            ];
        }

        session()->put('cart', $cart); // Save the updated array back to session.
        return redirect()->back()->with('success', "{$product->name} added to cart!");
    }

    // Update quantity
    // Update quantity
    // PURPOSE: Change the quantity of an item in the cart.
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $quantity = (int) $request->input('quantity', 1);
            $cart[$id]['quantity'] = max(1, $quantity); // Ensure quantity is at least 1.
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated!');
        }
        return redirect()->back()->with('error', 'Product not found in cart!');
    }

    // Remove product
    // Remove product
    // PURPOSE: Delete a specific item from the cart session.
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]); // "unset" removes the item from the array.
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Item removed successfully!');
    }
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart')->with('error', 'Cart is empty!');
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // CRUD Implementation: CREATE Operation
        // We are creating a new record in the "orders" table.
        // We use the "Auth::id()" to link this order to the currently logged-in user (RELATIONSHIP).
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        // Create Order Items (RELATIONSHIP)
        // We iterate through the cart and create a record in "order_items" table for each product.
        // We link these items to the main Order using "$order->id".
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('thankyou')->with('success', 'Your order has been placed successfully! Order ID: #' . $order->id);
    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
