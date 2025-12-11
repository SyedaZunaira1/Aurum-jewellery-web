<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Aurum Jewellery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-gold: #b8941e;
            --deep-navy: #1a1a2e;
            --navy-blue: #16213e;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
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
        .navbar-custom {
            background: linear-gradient(135deg, var(--deep-navy) 0%, var(--navy-blue) 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-bottom: 3px solid var(--primary-gold);
            padding: 1rem 0;
        }

        .navbar-custom .navbar-brand {
            color: var(--primary-gold);
            font-weight: 900;
            font-size: 1.8rem;
            letter-spacing: 2px;
            text-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
        }

        .navbar-custom .admin-name {
            color: var(--primary-gold);
            font-weight: 600;
            font-size: 1rem;
        }

        .navbar-custom .btn-logout {
            background: transparent;
            border: 2px solid var(--primary-gold);
            color: var(--primary-gold);
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
        }

        .navbar-custom .btn-logout:hover {
            background: var(--primary-gold);
            color: var(--deep-navy);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
        }

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, var(--deep-navy), var(--navy-blue));
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-card h1 {
            color: var(--primary-gold);
            margin-bottom: 0.5rem;
            font-size: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .welcome-card p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-gold), var(--dark-gold));
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
            border-color: var(--primary-gold);
        }

        .stat-card h3 {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--deep-navy), var(--navy-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-card p {
            color: #666;
            margin-bottom: 0;
            font-size: 0.95rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-card.featured {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
        }

        .stat-card.featured h3,
        .stat-card.featured p {
            color: var(--deep-navy);
        }

        .stat-card.featured::before {
            background: var(--deep-navy);
        }

        /* Action Buttons */
        .action-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid var(--primary-gold);
        }

        .action-card h3 {
            color: var(--deep-navy);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            font-size: 1rem;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--deep-navy), var(--navy-blue));
            color: white;
        }

        .btn-success-custom {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            color: var(--deep-navy);
        }

        .btn-home {
            background: white;
            color: var(--deep-navy);
            border: 2px solid var(--deep-navy);
        }

        .btn-home:hover {
            background: var(--deep-navy);
            color: white;
        }

        /* Animations */
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

        .welcome-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-card {
            animation: fadeInUp 0.6s ease-out;
        }

        .stat-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .stat-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .action-card {
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-card h1 {
                font-size: 1.8rem;
            }

            .stat-card h3 {
                font-size: 2rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom">
        <div class="container-fluid px-4">
            <span class="navbar-brand">
                <i class="fas fa-gem me-2"></i>Aurum Admin
            </span>
            <div class="d-flex align-items-center gap-3">
                <span class="admin-name">
                    <i class="fas fa-user-shield me-2"></i>{{ Auth::guard('admin')->user()->name }}
                </span>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="welcome-card">
            <h1>Welcome back, {{ Auth::guard('admin')->user()->name }}! 👋</h1>
            <p>Manage your exquisite jewellery collection and inventory from your command center</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card featured">
                <h3>{{ $totalProducts }}</h3>
                <p><i class="fas fa-gem me-2"></i>Total Products</p>
            </div>
            @foreach($categoryCounts as $category => $count)
                <div class="stat-card">
                    <h3>{{ $count }}</h3>
                    <p>
                        @if($category == 'Rings')
                            💍
                        @elseif($category == 'Necklaces')
                            📿
                        @elseif($category == 'Bracelets')
                            ⚜️
                        @elseif($category == 'Anklets')
                            🔗
                        @else
                            ✨
                        @endif
                        {{ $category }}
                    </p>
                </div>
            @endforeach
        </div>

        <div class="action-card">
            <h3><i class="fas fa-bolt me-2"></i>Quick Actions</h3>
            <div class="action-buttons">
                <a href="{{ route('admin.products.index') }}" class="action-btn btn-primary-custom">
                    <i class="fas fa-box"></i> View All Products
                </a>
                <a href="{{ route('admin.products.create') }}" class="action-btn btn-success-custom">
                    <i class="fas fa-plus-circle"></i> Add New Product
                </a>
                <a href="{{ route('admin.profile') }}" class="action-btn" style="background: #6c757d; color: white;">
                    <i class="fas fa-user-edit"></i> Manage Profile
                </a>
                <a href="{{ route('home') }}" class="action-btn btn-home">
                    <i class="fas fa-home"></i> Go to Home
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>