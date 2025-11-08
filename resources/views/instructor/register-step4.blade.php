@extends('layouts.instructor-auth')

@section('title', 'Years of Experience - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 500px;">
        <div class="progress-bar">
            <div class="progress-fill" style="width: 80%"></div>
        </div>

        <div class="instructor-icon">⭐</div>
        
        <div class="auth-logo instructor-logo">
            <h1>Your Experience</h1>
        </div>
        
        <p class="instructor-subtitle">Step 4 of 5</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.register.step4') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">How many years of experience do you have?</label>
                <select name="years_of_experience" class="form-input instructor-input" autofocus>
                    <option value="">Select years...</option>
                    <option value="0-1" {{ old('years_of_experience', session('instructor_registration.years_of_experience')) == '0-1' ? 'selected' : '' }}>Less than 1 year</option>
                    <option value="1-3" {{ old('years_of_experience', session('instructor_registration.years_of_experience')) == '1-3' ? 'selected' : '' }}>1-3 years</option>
                    <option value="3-5" {{ old('years_of_experience', session('instructor_registration.years_of_experience')) == '3-5' ? 'selected' : '' }}>3-5 years</option>
                    <option value="5-10" {{ old('years_of_experience', session('instructor_registration.years_of_experience')) == '5-10' ? 'selected' : '' }}>5-10 years</option>
                    <option value="10+" {{ old('years_of_experience', session('instructor_registration.years_of_experience')) == '10+' ? 'selected' : '' }}>10+ years</option>
                </select>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-top: 0.5rem;">Your experience level helps us match you with suitable clients</p>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('instructor.register.step3.form') }}" class="btn-secondary" style="flex: 1; text-align: center; padding: 0.9rem; text-decoration: none;">Back</a>
                <button type="submit" class="btn-primary btn-instructor" style="flex: 1;">Continue</button>
            </div>
        </form>

        <div class="auth-links instructor-links" style="margin-top: 1rem;">
            <a href="#" onclick="event.preventDefault(); document.querySelector('form').submit();">Skip this step →</a>
        </div>
    </div>
@endsection
