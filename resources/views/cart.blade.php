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
                                    <img src="{{ asset('storage/' . $item['image']) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="img-fluid rounded cart-product-img">
                                @else
                                    <img src="https://via.placeholder.com/60x60?text=No+Image" 
                                         alt="No Image" 
                                         class="img-fluid rounded">
                                @endif
                            </td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                {{-- Auto-update quantity input --}}
                                <form action="{{ route('cart.update', $id) }}" 
                                      method="POST" 
                                      class="quantity-form d-flex justify-content-center align-items-center">
                                    @csrf
                                    <input type="number" 
                                           name="quantity" 
                                           value="{{ $item['quantity'] }}" 
                                           min="1" 
                                           class="form-control form-control-sm text-center quantity-input max-width-80"
                                           data-product-id="{{ $id }}"
                                           aria-label="Quantity for {{ $item['name'] }}">
                                </form>
                            </td>
                            <td class="subtotal-{{ $id }}">${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" 
                                   class="btn btn-sm btn-remove w-100" 
                                   onclick="return confirm('Remove this item?')">
                                   <i class="fas fa-trash-alt me-1"></i>Remove
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Total:</td>
                        <td colspan="2" class="fw-bold" id="cart-total">${{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Buttons section with theme colors -->
        <div class="d-flex flex-wrap justify-content-end gap-2 mt-3">
            <a href="{{ route('shop') }}" class="btn btn-continue-shopping">
                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
            </a>
            <a href="{{ route('checkout') }}" class="btn btn-checkout">
                <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
            </a>
        </div>
    @endif
</div>

{{-- Auto-update JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all quantity inputs
    const quantityInputs = document.querySelectorAll('.quantity-input');
    
    quantityInputs.forEach(input => {
        // Auto-submit on change
        input.addEventListener('change', function() {
            const form = this.closest('.quantity-form');
            if (form) {
                form.submit();
            }
        });
        
        // Optional: Auto-submit on blur (when user clicks away)
        input.addEventListener('blur', function() {
            const form = this.closest('.quantity-form');
            if (form && this.value !== this.defaultValue) {
                form.submit();
            }
        });
    });
});
</script>

{{-- Responsive adjustments with theme colors --}}
<style>
/* Theme color variables */
:root {
    --primary-gold: #d4af37;
    --dark-gold: #b8941e;
    --deep-navy: #1a1a2e;
    --navy-blue: #16213e;
}

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

/* Theme-colored buttons */
.btn {
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

/* Continue Shopping Button - Gold Theme */
.btn-continue-shopping {
    background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.btn-continue-shopping:hover {
    background: linear-gradient(135deg, var(--dark-gold), var(--primary-gold));
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(212, 175, 55, 0.5);
    color: white;
}

/* Checkout Button - Navy Theme */
.btn-checkout {
    background: linear-gradient(135deg, var(--deep-navy), var(--navy-blue));
    border: none;
    color: white;
    box-shadow: 0 4px 15px rgba(26, 26, 46, 0.3);
}

.btn-checkout:hover {
    background: linear-gradient(135deg, var(--navy-blue), var(--deep-navy));
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(26, 26, 46, 0.5);
    color: white;
}

/* Remove Button - Subtle dark theme */
.btn-remove {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    border: none;
    color: white;
    transition: all 0.3s ease;
    font-size: 0.85rem;
}

.btn-remove:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
    color: white;
}

/* Quantity input styling */
.quantity-input {
    transition: border-color 0.3s ease;
    border: 2px solid #e0e0e0;
}

.max-width-80 {
    max-width: 80px;
}

.cart-product-img {
    width: 60px;
    height: 60px;
    object-fit: contain;
    padding: 5px;
    background: #f8f9fa;
}

.quantity-input:focus {
    border-color: var(--primary-gold);
    box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
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
