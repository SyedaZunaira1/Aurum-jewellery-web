<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Aurum Jewellery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-gold: #b8941e;
            --light-gold: #f4e5c3;
            --deep-navy: #1a1a2e;
            --navy-blue: #16213e;
            --dark-blue: #0f3460;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            overflow-x: hidden;
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Elegant Navbar */
        .navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            letter-spacing: 3px;
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            letter-spacing: 4px;
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            position: relative;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 80%;
        }

        .nav-link:hover {
            color: var(--primary-gold) !important;
            transform: translateY(-2px);
        }

        .badge-cart {
            position: absolute;
            top: -5px;
            right: -10px;
            background: linear-gradient(135deg, #ff6b6b, #ff4757) !important;
            box-shadow: 0 2px 10px rgba(255, 75, 87, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Stunning Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, var(--deep-navy) 0%, var(--navy-blue) 50%, var(--dark-blue) 100%);
            position: relative;
            overflow: hidden;
            padding: 80px 0;
            margin-bottom: 0;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(212, 175, 55, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 40%);
            animation: shimmer 4s ease-in-out infinite;
        }

        .hero-banner::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 100px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%23f8f9fa"></path></svg>') bottom center no-repeat;
            background-size: 100% 100px;
        }

        @keyframes shimmer {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }
        }

        .hero-banner .container {
            position: relative;
            z-index: 2;
        }

        .hero-banner h1 {
            font-size: 3.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, #ffffff, var(--light-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease-out;
            letter-spacing: 2px;
        }

        .hero-banner p {
            animation: fadeInUp 0.8s ease-out 0.2s both;
            font-size: 1.3rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hero-banner .badges {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-banner .badge {
            font-weight: 600;
            letter-spacing: 1px;
            padding: 12px 24px !important;
            border-radius: 50px;
            font-size: 0.9rem !important;
            background: rgba(255, 255, 255, 0.95) !important;
            color: var(--deep-navy) !important;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
        }

        .hero-banner .badge:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 8px 30px rgba(212, 175, 55, 0.4);
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold)) !important;
            color: white !important;
        }

        /* Decorative Elements */
        .hero-banner .diamond-icon {
            position: absolute;
            color: rgba(212, 175, 55, 0.1);
            font-size: 100px;
            animation: float 6s ease-in-out infinite;
        }

        .diamond-1 {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .diamond-2 {
            top: 70%;
            right: 15%;
            animation-delay: 2s;
        }

        .diamond-3 {
            top: 40%;
            right: 5%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(10deg);
            }
        }

        /* Main Content Styling */
        main {
            background: transparent;
            position: relative;
            z-index: 1;
        }

        /* Enhanced Cards */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
        }

        .card-img-top {
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-body {
            position: relative;
        }

        .card-title {
            font-weight: 700;
            color: var(--deep-navy);
            margin-bottom: 10px;
        }

        /* Buttons */
        .btn {
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .btn-dark {
            background: linear-gradient(135deg, var(--deep-navy), var(--dark-blue));
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-dark:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, var(--dark-blue), var(--navy-blue));
        }

        .btn-outline-dark {
            border: 2px solid var(--deep-navy);
            color: var(--deep-navy);
            background: transparent;
        }

        .btn-outline-dark:hover {
            background: var(--deep-navy);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(26, 26, 46, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-gold);
            color: var(--primary-gold);
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            border-color: var(--dark-gold);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.4);
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            animation: slideInDown 0.5s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--deep-navy), var(--navy-blue));
            color: white;
            padding: 2rem 0;
            margin-top: 80px;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 0;
            right: 0;
            height: 50px;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="%231a1a2e"></path></svg>') top center no-repeat;
            background-size: 100% 50px;
        }

        footer p {
            margin: 0;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
        }

        /* Section Headers */
        h2 {
            font-weight: 700;
            color: var(--deep-navy);
            position: relative;
            padding-bottom: 15px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
            border-radius: 2px;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-gold);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-banner h1 {
                font-size: 2rem;
            }

            .hero-banner p {
                font-size: 1rem;
            }

            .hero-banner {
                padding: 50px 0;
            }

            .hero-banner .badge {
                font-size: 0.75rem !important;
                padding: 8px 16px !important;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-banner h1 {
                font-size: 1.5rem;
            }

            .btn {
                padding: 10px 20px;
                font-size: 0.85rem;
            }
        }

        /* Loading Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        body {
            animation: fadeIn 0.5s ease-in;
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand text-uppercase" href="{{ route('home') }}">
                <i class="fas fa-gem"></i> Aurum Jewellery
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home me-1"></i>
                            Home</a></li>
                    <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link"><i
                                class="fas fa-store me-1"></i> Shop</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link"><i
                                class="fas fa-envelope me-1"></i> Contact</a></li>

                    <li class="nav-item position-relative">
                        <a href="{{ route('cart') }}" class="nav-link">
                            <i class="fas fa-shopping-cart me-1"></i> Cart
                            @php
                                $cart = session('cart', []);
                                $count = array_sum(array_column($cart, 'quantity'));
                            @endphp
                            @if($count > 0)
                                <span class="badge badge-cart">{{ $count }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        @auth
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button"
                                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('orders.index') }}">
                                            <i class="fas fa-box-open me-2"></i> My Orders
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="nav-link"><i class="fas fa-sign-in-alt me-1"></i>
                                Login</a>
                        @endauth
                    </li>
                    <li class="nav-item">
                        @if(Auth::guard('admin')->check())
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-warning fw-bold" href="#" role="button"
                                    id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-shield me-1"></i> {{ Auth::guard('admin')->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                                        </a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('admin.logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('admin.login') }}" class="nav-link"><i class="fas fa-lock me-1"></i> Admin</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Banner -->
    @hasSection('banner')
        @yield('banner')
    @else
        <div class="hero-banner">
            <i class="fas fa-gem diamond-icon diamond-1"></i>
            <i class="fas fa-gem diamond-icon diamond-2"></i>
            <i class="fas fa-gem diamond-icon diamond-3"></i>

            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto text-center text-white">
                        <h1 class="display-3 fw-bold mb-3">✨ Aurum Jewellery Collection ✨</h1>
                        <p class="lead mb-4">Discover Timeless Elegance & Luxury Craftsmanship</p>
                        <div class="badges d-flex justify-content-center gap-3 flex-wrap">
                            <span class="badge"><i class="fas fa-gem me-2"></i>Premium Quality</span>
                            <span class="badge"><i class="fas fa-shipping-fast me-2"></i>Free Shipping</span>
                            <span class="badge"><i class="fas fa-certificate me-2"></i>Certified Gold</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main container -->
    <main class="container my-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-2"><i class="fas fa-gem me-2"></i>Aurum Jewellery - Where Luxury Meets Elegance</p>
            <p>&copy; {{ date('Y') }} Aurum Jewellery. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>