@extends('layouts.header')

@section('content')
<!-- Banner Section -->
<div class="hero-banner position-relative overflow-hidden">
    <div class="banner-overlay"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 mx-auto text-center text-white py-5">
                <h1 class="display-3 fw-bold mb-3 animate-fade-in">✨ Aurum Jewellery Collection ✨</h1>
                <p class="lead mb-4 animate-fade-in-delay">Discover Timeless Elegance & Luxury</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap animate-fade-in-delay-2">
                    <span class="badge bg-light text-dark px-4 py-2 fs-6">💎 Premium Quality</span>
                    <span class="badge bg-light text-dark px-4 py-2 fs-6">🎁 Free Shipping</span>
                    <span class="badge bg-light text-dark px-4 py-2 fs-6">✅ Certified Gold</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>✅ {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>❌ {{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Our Collection</h2>
        <a href="{{ route('cart') }}" class="btn btn-dark">🛒 View Cart</a>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100 product-card">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;"/>
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

<!-- Styles -->
<style>
/* Banner Styles */
.hero-banner {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    position: relative;
    overflow: hidden;
}

.hero-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, rgba(255, 215, 0, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

.banner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="rgba(255,255,255,0.05)"></path></svg>') bottom center no-repeat;
    background-size: 100% 100px;
}

.min-vh-50 {
    min-height: 50vh;
}

/* Animations */
.animate-fade-in {
    animation: fadeInUp 0.8s ease-out;
}

.animate-fade-in-delay {
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.animate-fade-in-delay-2 {
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Product Card Hover Effect */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

/* Badge Styles */
.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-banner .display-3 {
        font-size: 2rem;
    }
    
    .hero-banner .lead {
        font-size: 1rem;
    }
    
    .min-vh-50 {
        min-height: 40vh;
    }
    
    .badge {
        font-size: 0.75rem !important;
        padding: 0.5rem 1rem !important;
    }
}

@media (max-width: 576px) {
    .hero-banner .display-3 {
        font-size: 1.5rem;
    }
}
</style>

<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000); // 5 seconds
</script>
@endsection