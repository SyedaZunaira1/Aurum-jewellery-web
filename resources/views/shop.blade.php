@extends('layouts.header')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">💎 Aurum Jewellery Collection 💎</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>✅ {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Message Alert (optional) -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>❌ {{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="text-end mb-4">
        <a href="{{ route('cart') }}" class="btn btn-dark">🛒 View Cart</a>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;"/>
                        <!-- <img src="C:\xampp\htdocs\SCD_project_Ahsan\Aurum-Jewellery-shop\public\images\Diamond.jpg" class="card-img-top" style="height:200px; object-fit:cover;"/> -->
    
                    @else 
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaNGyPKj9EiEiU-lWhCEcS68FmoDS8NLsRig&s" class="card-img-top"/>
                    @endif
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-primary fw-bold">${{ number_format($product->price, 2) }}</p>
                        <p class="small text-secondary">{{ $product->description }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-dark btn-sm mb-2 w-100">View Details</a>
                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-outline-primary btn-sm w-100">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection

<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000); // 5 seconds
</script>