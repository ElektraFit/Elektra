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
        
        <p class="instructor-subtitle">Join our team of elite fitness professionals</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.register.submit') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input instructor-input" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input instructor-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number <span class="optional-label">(optional)</span></label>
                <input type="tel" name="phone" class="form-input instructor-input" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Specialization <span class="optional-label">(optional)</span></label>
                <input type="text" name="specialization" class="form-input instructor-input" placeholder="e.g., Strength Training, Yoga, CrossFit" value="{{ old('specialization') }}">
            </div>

            <div class="form-group">
                <label class="form-label">Bio <span class="optional-label">(optional)</span></label>
                <textarea name="bio" class="form-input instructor-input" placeholder="Tell us about your experience and expertise">{{ old('bio') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input instructor-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input instructor-input" required>
            </div>

            <button type="submit" class="btn-primary btn-instructor">Register</button>
        </form>

        <div class="auth-links instructor-links">
            <a href="{{ route('instructor.login') }}">Already have an account? Login here</a>
        </div>
    </div>
@endsection
