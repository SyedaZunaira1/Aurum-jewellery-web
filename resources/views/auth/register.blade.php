@extends('layouts.header')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-4" style="overflow: hidden;">
                    <div class="card-header text-center text-white p-4"
                        style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);">
                        <h3 class="mb-0 fw-bold" style="color: #d4af37;">Create Account</h3>
                        <p class="small mb-0 text-white-50">Join Aurum Jewellery today</p>
                    </div>
                    <div class="card-body p-4 p-md-5 bg-light">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 small">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Full Name</label>
                                <input type="text" class="form-control py-2" id="name" name="name" value="{{ old('name') }}"
                                    required autofocus placeholder="John Doe">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input type="email" class="form-control py-2" id="email" name="email"
                                    value="{{ old('email') }}" required placeholder="name@example.com">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control py-2" id="password" name="password" required
                                    placeholder="Create a password">
                                <small class="text-muted">Min. 8 characters</small>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                <input type="password" class="form-control py-2" id="password_confirmation"
                                    name="password_confirmation" required placeholder="Confirm your password">
                            </div>

                            <button type="submit" class="btn w-100 py-2 fw-bold text-white mb-3"
                                style="background: linear-gradient(135deg, #d4af37, #b8941e); border: none; border-radius: 50px; transition: all 0.3s ease;">
                                Register
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="small mb-0">Already have an account? <a href="{{ route('login') }}"
                                    class="fw-bold text-decoration-none" style="color: #1a1a2e;">Login Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection