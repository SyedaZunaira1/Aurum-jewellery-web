@extends('layouts.header')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4" style="overflow: hidden;">
                    <div class="card-header text-center text-white p-4"
                        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
                        <h3 class="mb-0 fw-bold" style="color: #d4af37;">Welcome Back</h3>
                        <p class="small mb-0 text-white-50">Login to your account</p>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-light">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 small">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input type="email" class="form-control py-2" id="email" name="email"
                                    value="{{ old('email') }}" required autofocus placeholder="name@example.com">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control py-2" id="password" name="password" required
                                    placeholder="Enter your password">
                            </div>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small" for="remember">Remember me</label>
                                </div>
                                {{-- <a href="#" class="small text-decoration-none" style="color: #1a1a2e;">Forgot
                                    password?</a> --}}
                            </div>

                            <button type="submit" class="btn w-100 py-2 fw-bold text-white mb-3"
                                style="background: linear-gradient(135deg, #d4af37, #b8941e); border: none; border-radius: 50px; transition: all 0.3s ease;">
                                Login
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="small mb-0">Don't have an account? <a href="{{ route('register') }}"
                                    class="fw-bold text-decoration-none" style="color: #1a1a2e;">Register Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection