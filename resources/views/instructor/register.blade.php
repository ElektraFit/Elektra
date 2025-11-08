@extends('layouts.instructor-auth')

@section('title', 'Instructor Registration - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 500px;">
        <div class="back-link">
            <a href="{{ url('/') }}">← Back to Home</a>
        </div>

        <div class="instructor-icon">🎓</div>
        
        <div class="auth-logo instructor-logo">
            <h1>Become an Instructor</h1>
        </div>
        
        <p class="instructor-subtitle">Step 1 of 5 - Basic Information</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.register.step1') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" name="name" class="form-input instructor-input" value="{{ old('name', session('instructor_registration.name')) }}" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address *</label>
                <input type="email" name="email" class="form-input instructor-input" value="{{ old('email', session('instructor_registration.email')) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Date of Birth *</label>
                <input type="date" name="date_of_birth" class="form-input instructor-input" value="{{ old('date_of_birth', session('instructor_registration.date_of_birth')) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password *</label>
                <input type="password" name="password" class="form-input instructor-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password *</label>
                <input type="password" name="password_confirmation" class="form-input instructor-input" required>
            </div>

            <button type="submit" class="btn-primary btn-instructor">Continue</button>
        </form>

        <div class="auth-links instructor-links">
            <a href="{{ route('instructor.login') }}">Already have an account? Login here</a>
        </div>
    </div>
@endsection
