<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reset Password - Aurum Jewellery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .btn-gold {
            background: #d4af37;
            color: white;
            font-weight: 600;
            border: none;
        }

        .btn-gold:hover {
            background: #b8941e;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark">Reset Password</h3>
                        <p class="text-muted small">Enter your admin email to receive a reset link</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-gold py-2">Send Reset Link</button>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('admin.login') }}" class="text-decoration-none text-muted small">Back to
                                Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>