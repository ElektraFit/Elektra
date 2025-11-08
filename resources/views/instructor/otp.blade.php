@extends('layouts.instructor-auth')

@section('title', 'Verify OTP - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 450px;">
        <div class="instructor-icon" style="font-size: 3.5rem;">📧</div>
        
        <div class="auth-logo instructor-logo">
            <h1>Verify Your Email</h1>
        </div>
        
        <div class="otp-info">
            We've sent a 4-digit verification code to<br>
            <span class="otp-email" style="color: #8a2be2;">{{ session('instructor_otp_email') ?? session('instructor_email') }}</span>
        </div>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('instructor.otp.verify') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label" style="text-align: center;">Enter OTP Code</label>
                <input type="text" name="otp" class="form-input instructor-input otp-input" maxlength="4" pattern="[0-9]{4}" required autofocus>
            </div>

            <button type="submit" class="btn-primary btn-instructor">Verify OTP</button>
        </form>

        <div class="auth-links instructor-links" style="color: rgba(255, 255, 255, 0.6); font-size: 0.9rem;">
            Didn't receive the code? <a href="#" onclick="alert('Resend functionality coming soon!'); return false;">Resend OTP</a>
        </div>
    </div>
@endsection
