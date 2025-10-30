@extends('layouts.header')

@section('content')
<div class="container-fluid py-5 px-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body text-center p-5">
                    <!-- Success Icon -->
                    <div class="mb-4">
                        <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-check text-white" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                    
                    <!-- Success Message -->
                    <h1 class="text-success mb-3">🎉 Order Placed Successfully!</h1>
                    <p class="text-muted mb-4 lead">
                        Thank you for your purchase! Your order has been confirmed and will be processed shortly.
                    </p>

                    <!-- Action Buttons -->
                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                        <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                    </div>

                    <!-- Support Info -->
                    <div class="mt-4 pt-3 border-top">
                        <p class="text-muted small mb-2">
                            Need help? <a href="{{ route('contact') }}" class="text-decoration-none">Contact our support team</a>
                        </p>
                        <p class="text-muted small">
                            Or call us: <strong>1-800-AURUM</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles for Thank You Page -->
<style>
.card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: none;
}

.bg-success {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

.btn-outline-secondary {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    transform: translateY(-2px);
}

.alert-info {
    border-radius: 10px;
    border: none;
    background: rgba(23, 162, 184, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .card-body {
        padding: 2rem !important;
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    
    h1 {
        font-size: 1.75rem;
    }
}

@media (max-width: 576px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    .d-flex {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection