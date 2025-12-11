<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // List user orders
    public function index()
    {
        // CRUD Implementation: READ Operation
        // We fetch orders for the logged-in user.
        // "where('user_id', Auth::id())" filters the data.
        // "with('items')" performs Eager Loading of the relationship (More efficient).
        $orders = Order::where('user_id', Auth::id())
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    // Show order details
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())->where('id', $id)->with('items')->firstOrFail();
        return view('orders.show', compact('order'));
    }
}
