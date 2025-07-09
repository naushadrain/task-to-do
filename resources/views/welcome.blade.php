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
                <form>
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <p class="text-center text-muted">Don't have an account? <a href="{{route('register.index')}}" class="auth-switch-link">Sign Up</a></p>
                </form>
            </div>

            

        </div>
    </div>
@endsection