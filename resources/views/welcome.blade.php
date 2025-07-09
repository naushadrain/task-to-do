@extends('layouts.app')

@section('title')
    Login Register
@endsection

@section('content')
    <div class="container auth-container">
        <div class="auth-card">
            <!-- Login Form Section -->
            <div id="login-form" class="form-section">
                @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                <h2 class="text-center mb-4 fw-bold">Welcome Back!</h2>

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf

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
