@extends('layouts.instructor-auth')

@section('title', 'Registration Complete - ElektraFit')

@section('content')
    <div class="auth-container instructor-container" style="max-width: 500px;">
        <div class="instructor-icon" style="font-size: 4rem; animation: bounce 1s ease-in-out;">🎉</div>
        
        <div class="auth-logo instructor-logo">
            <h1>Registration Complete!</h1>
        </div>
        
        <p class="instructor-subtitle">Welcome to the ElektraFit instructor team!</p>

        <div style="background: rgba(168, 85, 247, 0.1); border: 1px solid rgba(168, 85, 247, 0.3); border-radius: 16px; padding: 1.5rem; margin: 2rem 0;">
            <p style="color: rgba(255,255,255,0.9); line-height: 1.6; margin: 0;">
                Your instructor profile has been successfully created. You can now log in to access your dashboard and start connecting with clients.
            </p>
        </div>

        <div style="text-align: center; margin: 2rem 0;">
            <svg width="80" height="80" viewBox="0 0 80 80" style="margin: 0 auto;">
                <circle cx="40" cy="40" r="35" fill="none" stroke="rgba(168, 85, 247, 0.3)" stroke-width="3"/>
                <path d="M25 40 L35 50 L55 30" fill="none" stroke="#a855f7" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <a href="{{ route('instructor.login') }}" class="btn-primary btn-instructor" style="display: block; text-align: center; text-decoration: none;">
            Continue to Login
        </a>

        <p style="text-align: center; color: rgba(255,255,255,0.6); font-size: 0.85rem; margin-top: 1.5rem;">
            Redirecting in <span id="countdown">5</span> seconds...
        </p>
    </div>

    <script>
        let seconds = 5;
        const countdownElement = document.getElementById('countdown');
        
        const countdown = setInterval(() => {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdown);
                window.location.href = "{{ route('instructor.login') }}";
            }
        }, 1000);
    </script>

    <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
@endsection
