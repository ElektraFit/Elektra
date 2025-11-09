@extends('layouts.instructor-auth')

@section('title', 'Specialization - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 500px;">
        <div class="progress-bar">
            <div class="progress-fill" style="width: 60%"></div>
        </div>

        <div class="instructor-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="7"></circle>
                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
            </svg>
        </div>
        
        <div class="auth-logo instructor-logo">
            <h1>Your Expertise</h1>
        </div>
        
        <p class="instructor-subtitle">Step 3 of 5</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.register.step3') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">What's your specialization?</label>
                <input type="text" name="specialization" class="form-input instructor-input" value="{{ old('specialization', session('instructor_registration.specialization')) }}" placeholder="e.g., Strength Training, Yoga, CrossFit, HIIT" autofocus>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-top: 0.5rem;">Help clients find you by sharing your main area of expertise</p>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('instructor.register.step2.form') }}" class="btn-secondary" style="flex: 1; text-align: center; padding: 0.9rem; text-decoration: none;">Back</a>
                <button type="submit" class="btn-primary btn-instructor" style="flex: 1;">Continue</button>
            </div>
        </form>

        <div class="auth-links instructor-links" style="margin-top: 1rem;">
            <a href="#" onclick="event.preventDefault(); document.querySelector('form').submit();">Skip this step →</a>
        </div>
    </div>
@endsection
