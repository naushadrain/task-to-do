@extends('layouts.app')

@section('title')
    Login Register
@endsection

@section('content')
    <div class="container auth-container">
        <div class="auth-card">
            <!-- Login Form Section -->
            <div id="login-form" class="form-section">
                <h2 class="text-center mb-4 fw-bold">Welcome Back!</h2>

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="mb-3">
                        <label for="loginInput" class="form-label">Email or Phone Number</label>
                        <input type="text" name="login" class="form-control" id="loginInput" placeholder="Enter email or phone" value="{{ old('login') }}" required>
                        @error('login')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <p class="text-center text-muted">
                        Don't have an account? <a href="{{ route('register.index') }}" class="auth-switch-link">Sign Up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
