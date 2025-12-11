@extends('layouts.header')

{{-- Custom Banner Section --}}
@section('banner')
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
@endsection

{{-- Main Content Section --}}
@section('content')

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

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <h2 class="mb-0">Our Collection</h2>
            <a href="{{ route('cart') }}" class="btn btn-dark">🛒 View Cart</a>
        </div>

        {{-- Search and Filter Section --}}
        <div class="card search-filter-card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('shop') }}" class="row g-3">
                    {{-- Search Bar --}}
                    <div class="col-md-6 position-relative">
                        <label for="searchInput" class="form-label fw-bold">
                            <i class="fas fa-search me-2"></i>Search Products
                        </label>
                        <input type="text" id="searchInput" name="search" class="form-control search-input"
                            placeholder="Search by product name..." value="{{ request('search') }}" autocomplete="off">
                        <div id="searchResults" class="search-results-dropdown d-none"></div>
                    </div>

                    {{-- Category Filter --}}
                    <div class="col-md-4">
                        <label for="categorySelect" class="form-label fw-bold">
                            <i class="fas fa-filter me-2"></i>Filter by Category
                        </label>
                        <select id="categorySelect" name="category" class="form-select category-select"
                            aria-label="Filter by category">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-search flex-fill">
                            <i class="fas fa-search"></i> Search
                        </button>
                        @if(request('search') || request('category'))
                            <a href="{{ route('shop') }}" class="btn btn-clear" aria-label="Clear filters">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>

                {{-- Active Filters Display --}}
                @if(request('search') || request('category'))
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted">Active filters:</small>
                        <div class="d-flex gap-2 flex-wrap mt-2">
                            @if(request('search'))
                                <span class="badge bg-info">
                                    <i class="fas fa-search me-1"></i>{{ request('search') }}
                                </span>
                            @endif
                            @if(request('category'))
                                <span class="badge bg-primary">
                                    <i class="fas fa-tag me-1"></i>{{ request('category') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card-elegant h-100">
                        {{-- Improved product image container --}}
                        <div class="shop-product-img-wrapper">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="shop-product-img"
                                    alt="{{ $product->name }}" />
                            @else
                                <img src="https://via.placeholder.com/300x300?text=No+Image" class="shop-product-img"
                                    alt="No Image" />
                            @endif
                            <div class="product-overlay">
                                <a href="{{ route('product.show', $product->id) }}" class="quick-view-link">
                                    <span class="quick-view-badge">Quick View</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title product-name">{{ $product->name }}</h5>
                            <p class="product-price">${{ number_format($product->price, 2) }}</p>
                            <p class="product-description">{{ $product->description }}</p>
                            <div class="mt-auto product-actions">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-view-details w-100 mb-2">
                                    <i class="fas fa-eye me-2"></i>View Details
                                </a>
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-add-cart w-100">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </a>
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
        /* Shop Product Image Styles - Improved Quality */
        .shop-product-img-wrapper {
            width: 100%;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px 20px 0 0;
            position: relative;
        }

        .shop-product-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            padding: 20px;
            transition: transform 0.5s ease;
        }

        /* Product Overlay - appears on hover */
        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(26, 26, 46, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
            border-radius: 20px 20px 0 0;
        }

        .quick-view-link {
            text-decoration: none;
            cursor: pointer;
        }

        .quick-view-badge {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            transform: translateY(20px);
            transition: all 0.4s ease;
            display: inline-block;
        }

        .quick-view-link:hover .quick-view-badge {
            background: linear-gradient(135deg, var(--dark-gold), var(--primary-gold));
            transform: translateY(0) scale(1.05);
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.5);
        }

        /* Elegant Product Card */
        .product-card-elegant {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            background: white;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .product-card-elegant::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .product-card-elegant:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 50px rgba(212, 175, 55, 0.25);
        }

        .product-card-elegant:hover::before {
            transform: scaleX(1);
        }

        .product-card-elegant:hover .shop-product-img {
            transform: scale(1.1);
        }

        .product-card-elegant:hover .product-overlay {
            opacity: 1;
        }

        .product-card-elegant:hover .quick-view-badge {
            transform: translateY(0);
        }

        /* Product Name */
        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 0.75rem;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Product Price */
        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        /* Product Description */
        .product-description {
            font-size: 0.9rem;
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1rem;
            min-height: 60px;
        }

        /* Product Action Buttons */
        .btn-view-details {
            background: white;
            border: 2px solid #1a1a2e;
            color: #1a1a2e;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-view-details:hover {
            background: #1a1a2e;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 26, 46, 0.3);
        }

        .btn-add-cart {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-add-cart:hover {
            background: linear-gradient(135deg, var(--dark-gold), var(--primary-gold));
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
            color: white;
        }

        /* Search and Filter Card Styles */
        .search-filter-card {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .search-filter-card:hover {
            border-color: var(--primary-gold);
            box-shadow: 0 8px 30px rgba(212, 175, 55, 0.15);
        }

        /* Search Input Styling */
        .search-input {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
        }

        /* Category Select Styling */
        .category-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .category-select:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
        }

        /* Search Button - Gold Theme */
        .btn-search {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background: linear-gradient(135deg, var(--dark-gold), var(--primary-gold));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
            color: white;
        }

        /* Clear Button */
        .btn-clear {
            background: #6c757d;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-clear:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
        }

        /* Active Filter Badges */
        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }

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

            0%,
            100% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }
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
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design - Mobile First Approach */

        /* Tablets and below (768px) */
        @media (max-width: 768px) {

            /* Hero Banner */
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

            /* Product Cards - 2 columns on tablets */
            .col-md-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            /* Search Filter Card */
            .search-filter-card .row {
                gap: 1rem;
            }

            .search-filter-card .col-md-6,
            .search-filter-card .col-md-4,
            .search-filter-card .col-md-2 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            /* Product Card Adjustments */
            .product-card-elegant {
                margin-bottom: 1.5rem;
            }

            .shop-product-img-wrapper {
                height: 220px;
            }

            .product-name {
                font-size: 1.1rem;
                min-height: 50px;
            }

            .product-price {
                font-size: 1.3rem;
            }

            .product-description {
                font-size: 0.85rem;
                min-height: 50px;
            }

            /* Buttons */
            .btn-view-details,
            .btn-add-cart {
                padding: 8px 16px;
                font-size: 0.85rem;
            }
        }

        /* Mobile devices (576px and below) */
        @media (max-width: 576px) {

            /* Hero Banner */
            .hero-banner .display-3 {
                font-size: 1.5rem;
            }

            .hero-banner {
                padding: 40px 0;
            }

            /* Product Cards - 1 column on mobile */
            .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            /* Product Card */
            .product-card-elegant {
                margin-bottom: 2rem;
            }

            .shop-product-img-wrapper {
                height: 250px;
            }

            .product-name {
                font-size: 1.2rem;
                min-height: 0;
            }

            .product-price {
                font-size: 1.4rem;
            }

            .product-description {
                font-size: 0.9rem;
                min-height: 0;
            }

            /* Search and Filter */
            .search-filter-card {
                padding: 1rem;
            }

            .btn-search,
            .btn-clear {
                width: 100%;
                margin-top: 0.5rem;
            }

            /* Action Buttons */
            .d-flex.gap-2 {
                flex-direction: column;
                gap: 0.5rem !important;
            }

            /* Typography */
            h2 {
                font-size: 1.5rem;
            }

            /* Container Padding */
            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            /* Quick View Badge */
            .quick-view-badge {
                padding: 10px 20px;
                font-size: 0.85rem;
            }
        }

        /* Extra small devices (400px and below) */
        @media (max-width: 400px) {
            .hero-banner .display-3 {
                font-size: 1.3rem;
            }

            .product-name {
                font-size: 1rem;
            }

            .product-price {
                font-size: 1.2rem;
            }

            .btn-view-details,
            .btn-add-cart {
                padding: 8px 12px;
                font-size: 0.8rem;
            }

            .shop-product-img-wrapper {
                height: 200px;
            }
        }

        /* Landscape orientation fixes for mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .hero-banner {
                padding: 30px 0;
            }

            .hero-banner .display-3 {
                font-size: 1.5rem;
            }

            .shop-product-img-wrapper {
                height: 180px;
            }
        }

        /* Search Dropdown Styles */
        .search-results-dropdown {
            position: absolute;
            top: 100%;
            left: 12px;
            right: 12px;
            z-index: 1000;
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0 0 10px 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            overflow-y: auto;
            margin-top: 5px;
        }

        .search-result-item {
            padding: 10px 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background-color: #f8f9fa;
        }

        .search-result-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .search-result-info h6 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a1a2e;
        }

        .search-result-info small {
            color: var(--primary-gold);
            font-weight: 600;
        }
    </style>

    <script>
        setTimeout(function () {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function (alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000); // 5 seconds

        // Ajax Search Implementation
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const categorySelect = document.getElementById('categorySelect');
            const resultsContainer = document.getElementById('searchResults');
            let debounceTimer;

            function performSearch() {
                const query = searchInput.value.trim();
                const category = categorySelect.value;

                if (query.length < 1) {
                    resultsContainer.classList.add('d-none');
                    resultsContainer.innerHTML = '';
                    return;
                }

                // Show loading state or nothing? standard is to wait
                // Ideally show spinner if desired, but for now just fetch

                // WE ARE USING AJAX HERE
                // We create a URL with the search query parameters
                const params = new URLSearchParams({
                    search: query,
                    category: category
                });

                // SENDING REQUEST TO SERVER (AJAX)
                // "fetch" allows us to get data from the server WITHOUT reloading the page
                fetch("{{ route('products.search') }}?" + params.toString())
                    .then(response => response.json()) // We expect a JSON response (data)
                    .then(data => {
                        resultsContainer.innerHTML = '';

                        if (data.length > 0) {
                            resultsContainer.classList.remove('d-none');

                            // Loop through the data and display results dynamically
                            data.forEach(product => {
                                const imgPath = product.image ? `/storage/${product.image}` : 'https://via.placeholder.com/50';
                                const item = `
                                            <a href="/product/${product.id}" class="search-result-item">
                                                <img src="${imgPath}" alt="${product.name}" class="search-result-img">
                                                <div class="search-result-info">
                                                    <h6>${product.name}</h6>
                                                    <small>$${parseFloat(product.price).toFixed(2)}</small>
                                                </div>
                                            </a>
                                        `;
                                resultsContainer.innerHTML += item;
                            });
                        } else {
                            resultsContainer.classList.remove('d-none');
                            resultsContainer.innerHTML = `
                                        <div class="p-3 text-center text-muted">
                                            <small>No products found matching "${query}"</small>
                                        </div>
                                    `;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                    });
            }

            // Event Listeners with Debounce
            searchInput.addEventListener('keyup', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(performSearch, 300); // 300ms delay
            });

            categorySelect.addEventListener('change', function () {
                // If there is a search term, re-run search with new category
                if (searchInput.value.trim().length > 0) {
                    performSearch();
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (e) {
                if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
                    resultsContainer.classList.add('d-none');
                }
            });

            // Show dropdown again if input is focused and has content
            searchInput.addEventListener('focus', function () {
                if (searchInput.value.trim().length > 0 && resultsContainer.children.length > 0) {
                    resultsContainer.classList.remove('d-none');
                }
            });
        });

    </script>
@endsection