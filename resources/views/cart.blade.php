@extends('layouts.header')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">🛍️ Your Shopping Cart</h1>

    @if(!$cart || count($cart) == 0)
        <p class="text-center">Your cart is empty.</p>
        <p class="text-center"><a href="{{ route('shop') }}" class="btn btn-primary">Shop Now</a></p>
    @else
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            @if($item['image'])
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width:60px; height:60px; object-fit:cover;">
                            @else
                                <img src="https://via.placeholder.com/60x60?text=No+Image" alt="No Image">
                            @endif
                        </td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex justify-content-center">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm me-2" style="width:70px;">
                                <button class="btn btn-sm btn-primary" type="submit">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($subtotal, 2) }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Remove this item?')">Remove</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-end fw-bold">Total:</td>
                    <td colspan="2" class="fw-bold">${{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('shop') }}" class="btn btn-secondary me-2">Continue Shopping</a>
            <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection
