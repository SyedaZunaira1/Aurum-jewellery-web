@extends('layouts.header')

@section('content')
    <div class="container py-5">
        <div class="row">
            {{-- Product Image Section - Improved sizing and quality --}}
            <div class="col-md-6 mb-4">
                <div class="product-image-container">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="product-detail-image img-fluid rounded shadow">
                    @else
                        <img src="https://via.placeholder.com/600x600?text=No+Image" alt="No Image"
                            class="product-detail-image img-fluid rounded shadow">
                    @endif
                </div>
            </div>

            {{-- Product Details Section --}}
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
                <p class="text-primary fw-bold fs-4 mb-3">${{ number_format($product->price, 2) }}</p>
                <p class="text-muted mb-3">{{ $product->description ?: 'No description available.' }}</p>
                <p class="mb-2"><strong>Category:</strong> {{ $product->category ?: 'N/A' }}</p>
                <p class="mb-3"><strong>Stock:</strong> {{ $product->stock ?? 0 }}</p>

                {{-- Dynamic Star Rating System --}}
                <div class="mb-4">
                    <strong>Rating:</strong>
                    <span class="ms-2">
                        {{-- Loop through 5 stars and display gold or gray based on rating --}}
                        @php
                            $rating = $product->rating ?? 0; // Get rating from database, default to 0
                            $fullStars = floor($rating); // Number of full gold stars
                            $hasHalfStar = ($rating - $fullStars) >= 0.5; // Check if half star needed
                        @endphp

                        {{-- Display full gold stars --}}
                        @for($i = 1; $i <= $fullStars; $i++)
                            <span class="star-gold">★</span>
                        @endfor

                        {{-- Display half star if applicable --}}
                        @if($hasHalfStar)
                            <span class="star-gold">☆</span>
                        @endif

                        {{-- Display remaining gray stars --}}
                        @for($i = ceil($rating); $i < 5; $i++)
                            <span class="star-gray">★</span>
                        @endfor

                        {{-- Display numeric rating --}}
                        <span class="ms-2 text-muted">({{ number_format($rating, 1) }}/5)</span>
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 d-flex gap-2 flex-wrap">
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-lg">
                        🛒 Add to Cart
                    </a>
                    <a href="{{ route('shop') }}" class="btn btn-secondary btn-lg">
                        ← Back to Shop
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Page Styles --}}
    <style>
        /* Product Image Container - Improved quality and aspect ratio */
        .product-image-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #f8f9fa;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .product-image-container:hover {
            transform: scale(1.02);
        }

        /* Product Detail Image - Better quality, no distortion */
        .product-detail-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
            object-position: center;
            display: block;
            background: #fff;
            padding: 20px;
        }

        /* Star Rating Styles */
        .star-gold {
            color: #ffd700;
            font-size: 24px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .star-gray {
            color: #e9ecef;
            font-size: 24px;
        }

        /* Responsive Design - Mobile First */

        /* Tablets (768px and below) */
        @media (max-width: 768px) {
            .product-image-container {
                max-width: 100%;
                margin-bottom: 2rem;
            }

            .product-detail-image {
                max-height: 400px;
            }

            h2 {
                font-size: 1.8rem;
            }

            .text-primary.fs-4 {
                font-size: 1.5rem !important;
            }

            .btn-lg {
                padding: 10px 20px;
                font-size: 1rem;
            }
        }

        /* Mobile (576px and below) */
        @media (max-width: 576px) {
            .product-detail-image {
                max-height: 350px;
                padding: 10px;
            }

            h2 {
                font-size: 1.5rem;
                text-align: center;
            }

            .col-md-6 {
                text-align: center;
            }

            /* Center align text elements on mobile */
            p.text-primary,
            p.text-muted,
            p.mb-2,
            p.mb-3,
            .mb-4 {
                /* Rating container */
                text-align: center;
            }

            /* Responsive Buttons */
            .d-flex.gap-2 {
                flex-direction: column;
                gap: 1rem !important;
            }

            .btn-lg {
                width: 100%;
                padding: 12px;
            }

            /* Star Rating */
            .star-gold,
            .star-gray {
                font-size: 20px;
            }
        }

        /* Small Mobile (375px and below) */
        @media (max-width: 375px) {
            .product-detail-image {
                max-height: 280px;
            }

            h2 {
                font-size: 1.3rem;
            }
        }
    </style>
@endsection