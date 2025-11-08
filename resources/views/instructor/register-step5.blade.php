@extends('layouts.instructor-auth')

@section('title', 'About You - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 500px;">
        <div class="progress-bar">
            <div class="progress-fill" style="width: 100%"></div>
        </div>

        <div class="instructor-icon">✍️</div>
        
        <div class="auth-logo instructor-logo">
            <h1>Tell Us About Yourself</h1>
        </div>
        
        <p class="instructor-subtitle">Step 5 of 5 - Final Step!</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.register.step5') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-input instructor-input" rows="6" placeholder="Tell potential clients about your background, certifications, training philosophy, and what makes you unique..." autofocus>{{ old('bio', session('instructor_registration.bio')) }}</textarea>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-top: 0.5rem;">A compelling bio helps clients connect with you (optional but recommended)</p>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('instructor.register.step4.form') }}" class="btn-secondary" style="flex: 1; text-align: center; padding: 0.9rem; text-decoration: none;">Back</a>
                <button type="submit" class="btn-primary btn-instructor" style="flex: 1;">Complete Registration</button>
            </div>
        </form>

        <div class="auth-links instructor-links" style="margin-top: 1rem;">
            <a href="#" onclick="event.preventDefault(); document.querySelector('form').submit();">Skip this step →</a>
        </div>
    </div>
@endsection
