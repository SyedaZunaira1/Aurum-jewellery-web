@extends('layouts.header')

@section('content')
<div class="container-fluid py-5 px-3">
    <h1 class="mb-4 text-center">🛍️ Your Shopping Cart</h1>

    @if(!$cart || count($cart) == 0)
        <div class="text-center">
            <p>Your cart is empty.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary">Shop Now</a>
        </div>
    @else
        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
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
                        @php 
                            $subtotal = $item['price'] * $item['quantity']; 
                            $total += $subtotal; 
                        @endphp
                        <tr>
                            <td class="text-break">{{ $item['name'] }}</td>
                            <td>
                                @if($item['image'])
                                    <img src="{{ asset($item['image']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="img-fluid rounded"
                                         style="width:60px; height:60px; object-fit:cover;">
                                @else
                                    <img src="https://via.placeholder.com/60x60?text=No+Image" 
                                         alt="No Image" 
                                         class="img-fluid rounded">
                                @endif
                            </td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" 
                                      class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                                    @csrf
                                    <input type="number" 
                                           name="quantity" 
                                           value="{{ $item['quantity'] }}" 
                                           min="1" 
                                           class="form-control form-control-sm text-center" 
                                           style="max-width:80px;">
                                    <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" 
                                   class="btn btn-sm btn-danger w-100" 
                                   onclick="return confirm('Remove this item?')">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td colspan="2" class="fw-bold">${{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Buttons section -->
        <div class="d-flex flex-wrap justify-content-end gap-2 mt-3">
            <a href="{{ route('shop') }}" class="btn btn-secondary">Continue Shopping</a>
            <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>
    @endif
</div>

<!-- ✅ Responsive adjustments -->
<style>
/* Ensure no horizontal scrollbars */
html, body {
    overflow-x: hidden;
}

/* Make table more flexible */
.table th, .table td {
    font-size: 1rem;
    word-break: break-word;
    vertical-align: middle;
}

/* Buttons and input adjustments */
.btn {
    border-radius: 8px;
}

/* Tablet screens */
@media (max-width: 992px) {
    h1 {
        font-size: 1.8rem;
    }

    .table th, .table td {
        font-size: 0.95rem;
    }

    .btn-sm {
        font-size: 0.85rem;
        padding: 0.35rem 0.6rem;
    }
}

/* Mobile screens */
@media (max-width: 768px) {
    h1 {
        font-size: 1.6rem;
    }

    .table th, .table td {
        font-size: 0.85rem;
        padding: 0.45rem;
    }

    .table img {
        width: 50px;
        height: 50px;
    }

    .form-control-sm {
        width: 70px !important;
    }

    .btn {
        font-size: 0.85rem;
    }

    .d-flex {
        flex-direction: column;
    }

    .d-flex .btn {
        width: 100%;
    }

    .table-responsive {
        overflow-x: auto;
    }
}

/* Extra small (phones like iPhone XR) */
@media (max-width: 480px) {
    h1 {
        font-size: 1.4rem;
    }

    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .table th, .table td {
        font-size: 0.8rem;
        padding: 0.35rem;
    }

    .form-control-sm {
        width: 100% !important;
    }

    .btn {
        width: 100%;
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
    }

    .gap-2 {
        gap: 0.5rem !important;
    }
}
</style>
@endsection
