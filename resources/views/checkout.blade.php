@extends('layouts.header')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">🛒 Checkout</h1>

    <div class="row">
        <!-- Order Summary -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    @foreach($cart as $id => $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total:</strong>
                        <strong>${{ number_format($total, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Delivery Information</h5>
                </div>
                <div class="card-body">
                   <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
        <input type="tel" class="form-control" id="phone" name="phone" required>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-success btn-lg" onclick="return confirm('Place Your Order?')">
            Place Order
        </button>
        <a href="{{ route('cart') }}" class="btn btn-secondary">
            Back to Cart
        </a>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    $('#chkOutbtn').on('click', function() {
       Swal.fire({
                        icon: 'success',
                        title: 'Order Placed!',
                        text: data.message,
                        confirmButtonText: 'Continue Shopping'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("shop") }}';
                        }
                    });
    });
    
});
</script>
@endsection