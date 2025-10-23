<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Aurum Jewellery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 2px;
        }
        footer {
            background-color: #222;
            color: white;
            padding: 1rem 0;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .badge-cart {
            position: absolute;
            top: -5px;
            right: -10px;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand text-uppercase" href="{{ route('home') }}">Aurum Jewellery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link">Shop</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>

                    <li class="nav-item position-relative">
                        <a href="{{ route('cart') }}" class="nav-link">
                            Cart
                            @php
                                $cart = session('cart', []);
                                $count = array_sum(array_column($cart, 'quantity'));
                            @endphp
                            @if($count > 0)
                                <span class="badge bg-primary badge-cart">{{ $count }}</span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main container -->
    <main class="container my-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Aurum Jewellery. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
