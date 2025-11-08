@extends('layouts.instructor-auth')

@section('title', 'Instructor Login - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 450px;">
        <div class="back-link">
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>

        <div class="instructor-icon">🎓</div>
        
        <div class="auth-logo instructor-logo">
            <h1>Instructor Portal</h1>
        </div>
        
        <p class="instructor-subtitle">Sign in to access your dashboard</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.login.submit') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input instructor-input" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input instructor-input" required>
            </div>

            <button type="submit" class="btn-primary btn-instructor">Login</button>
        </form>

        <div class="auth-links instructor-links">
            <a href="{{ route('instructor.register') }}">Don't have an account? Register here</a>
        </div>
    </div>
@endsection
