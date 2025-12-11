@extends('layouts.header')
{{-- "extends" means this file uses 'layouts/header.blade.php' as its base structure (Parent). --}}

@section('content')
    {{-- "section" inserts the code below into the '@yield(content)' part of the header file. --}}
    {{-- Featured Products Header with CTA --}}
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-3">💎 Featured Jewellery Collection 💎</h1>
        <p class="lead text-muted mb-4">Discover our handpicked selection of exquisite pieces</p>
        <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-5 py-3 shop-now-btn">
            <i class="fas fa-shopping-bag me-2"></i>Visit Our Shop to Purchase
        </a>
    </div>

    {{-- Featured Products Grid --}}
    <div class="row">
        {{-- "@forelse" is a loop. It goes through every product. if list is empty, it runs "@empty". --}}
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm product-card-home">
                    {{-- Product Image --}}
                    <div class="card-img-wrapper">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-card-img"
                                alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x300?text=No+Image" class="card-img-top product-card-img"
                                alt="No Image">
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="card-body text-center d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-primary fw-bold fs-5">${{ number_format($product->price, 2) }}</p>

                        {{-- Preview Only Badge --}}
                        <span class="badge bg-info text-white mb-2">Preview Only</span>

                        {{-- Action: View in Shop --}}
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary btn-sm mt-auto">
                            <i class="fas fa-store me-1"></i>View in Shop
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No featured products available at the moment.</p>
            </div>
        @endforelse
    </div>

    {{-- Call to Action Section --}}
    <div class="text-center mt-5 pt-4 border-top">
        <h3 class="mb-3">Ready to Shop?</h3>
        <p class="text-muted mb-4">Explore our complete collection and add items to your cart</p>
        <a href="{{ route('shop') }}" class="btn btn-dark btn-lg px-5 py-3">
            <i class="fas fa-gem me-2"></i>Browse Full Collection
        </a>
    </div>

    {{-- Home Page Styles --}}
    <style>
        /* Shop Now Button - Eye-catching */
        .shop-now-btn {
            background: linear-gradient(135deg, #d4af37, #b8941e);
            border: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
            transition: all 0.3s ease;
        }

        .shop-now-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(212, 175, 55, 0.6);
            background: linear-gradient(135deg, #b8941e, #d4af37);
        }

        /* Card image wrapper for consistent sizing */
        .card-img-wrapper {
            width: 100%;
            height: 250px;
            overflow: hidden;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Product card image - better quality */
        .product-card-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            padding: 10px;
        }

        /* Card hover effect */
        .product-card-home {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid transparent;
        }

        .product-card-home:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
            border-color: #d4af37;
        }

        /* Preview Badge */
        .badge.bg-info {
            background: linear-gradient(135deg, #17a2b8, #138496) !important;
            font-size: 0.75rem;
            padding: 5px 12px;
            letter-spacing: 0.5px;
        }

        /* Responsive adjustments */
        /* Tablet (768px and below) */
        @media (max-width: 768px) {
            .display-4 {
                font-size: 2.5rem;
            }

            .lead {
                font-size: 1.1rem;
            }

            .shop-now-btn {
                font-size: 0.9rem;
                padding: 12px 30px !important;
            }

            /* Product Grid - 2 columns */
            .col-md-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* Mobile (576px and below) */
        @media (max-width: 576px) {
            .display-4 {
                font-size: 2rem;
            }

            .shop-now-btn {
                width: 100%;
                padding: 15px !important;
            }

            /* Product Grid - 1 column */
            .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .card-img-wrapper {
                height: 220px;
            }

            /* Button stack on mobile */
            .d-flex.gap-2 {
                flex-direction: column;
            }
        }

        /* Small Mobile (375px and below) */
        @media (max-width: 375px) {
            .display-4 {
                font-size: 1.8rem;
            }

            .card-img-wrapper {
                height: 180px;
            }
        }
    </style>
@endsection