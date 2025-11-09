@extends('layouts.auth')

@section('title', 'Verify OTP - ElektraFit')

@section('content')
    <div class="auth-container" style="max-width: 440px;">
        <div class="auth-logo">
            <div style="font-size: 3.5rem; margin-bottom: 1rem;">📧</div>
            <h1>Verify Your Email</h1>
        </div>

        <div class="otp-info">
            We've sent a 4-digit verification code to<br>
            <span class="otp-email">{{ session('otp_email') }}</span>
        </div>

        @if ($errors->any())
            <div class="status-message error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="status-message success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.submit') }}">
            @csrf
            
            <input type="hidden" name="email" value="{{ session('otp_email') }}">
            
            <div class="form-group">
                <label class="form-label" style="text-align: center;">Enter OTP Code</label>
                <input type="text" name="otp" class="form-input otp-input" maxlength="4" pattern="[0-9]{4}" required autofocus>
            </div>

            <button type="submit" class="btn-primary">Verify OTP</button>
        </form>

        <div class="auth-links">
            <a href="#" onclick="alert('Resend functionality coming soon!'); return false;">Didn't receive the code? Resend</a>
        </div>
    </div>
@endsection
