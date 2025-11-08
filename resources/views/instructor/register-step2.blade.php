@extends('layouts.instructor-auth')

@section('title', 'Phone Number - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 500px;">
        <div class="progress-bar">
            <div class="progress-fill" style="width: 40%"></div>
        </div>

        <div class="instructor-icon">📱</div>
        
        <div class="auth-logo instructor-logo">
            <h1>Contact Information</h1>
        </div>
        
        <p class="instructor-subtitle">Step 2 of 5</p>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.register.step2') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-input instructor-input" value="{{ old('phone', session('instructor_registration.phone')) }}" placeholder="e.g., +1 234 567 8900" autofocus>
                <p style="color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-top: 0.5rem;">This helps us and clients reach you easily (optional)</p>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('instructor.register') }}" class="btn-secondary" style="flex: 1; text-align: center; padding: 0.9rem; text-decoration: none;">Back</a>
                <button type="submit" class="btn-primary btn-instructor" style="flex: 1;">Continue</button>
            </div>
        </form>

        <div class="auth-links instructor-links" style="margin-top: 1rem;">
            <a href="#" onclick="event.preventDefault(); document.querySelector('form').submit();">Skip this step →</a>
        </div>
    </div>
@endsection
