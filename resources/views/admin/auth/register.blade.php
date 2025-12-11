<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - Aurum Jewellery</title>
    <!-- Bootstrap CSS for responsive design and form styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* CSS Variables for consistent color scheme across admin panel */
        :root {
            --primary-gold: #d4af37;
            /* Main gold color for branding */
            --dark-gold: #b8941e;
            /* Darker gold for hover effects */
            --deep-navy: #1a1a2e;
            /* Deep navy for background gradient */
            --navy-blue: #16213e;
            /* Navy blue for background gradient */
        }

        /* Full-screen centered layout with gradient background */
        body {
            background: linear-gradient(135deg, var(--deep-navy) 0%, var(--navy-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Main registration form container with card design */
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            padding: 40px;
            max-width: 450px;
            width: 100%;
            border: 1px solid var(--primary-gold);
        }

        /* Header section styling */
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: var(--deep-navy);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .register-header p {
            color: #666;
            font-size: 14px;
        }

        /* Form input styling with focus effects */
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        /* Gold border highlight when input is focused */
        .form-control:focus {
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
        }

        /* Register button with gradient and hover animation */
        .btn-register {
            background: linear-gradient(135deg, var(--primary-gold), var(--dark-gold));
            border: none;
            padding: 12px;
            font-weight: 600;
            color: #fff;
            transition: transform 0.2s;
            border-radius: 8px;
        }

        /* Button hover effect - lifts up with shadow */
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.4);
            color: #fff;
        }

        /* Login link styling at bottom of form */
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .login-link a {
            color: var(--dark-gold);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
            color: var(--primary-gold);
        }

        /* Error message alert styling */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- Page Header -->
        <div class="register-header">
            <h2>✨ Create Admin Account</h2>
            <p>Aurum Jewellery Admin Panel</p>
        </div>

        <!-- Display validation errors if any -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Form - submits to admin.register.submit route -->
        <form method="POST" action="{{ route('admin.register.submit') }}">
            @csrf <!-- CSRF token for security against cross-site request forgery -->

            <!-- Full Name Input Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required
                    autofocus>
            </div>

            <!-- Email Input Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Password Input Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <small class="text-muted">Minimum 6 characters</small>
            </div>

            <!-- Password Confirmation Field -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-register w-100">Create Account</button>
        </form>

        <!-- Link to Login Page for existing users -->
        <div class="login-link">
            Already have an account? <a href="{{ route('admin.login') }}">Login here</a>
        </div>
    </div>

    <!-- Bootstrap JavaScript for interactive components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>