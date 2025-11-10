@extends('layouts.auth')

@section('title', 'Register - ElektraFit')

@section('content')
    <div class="auth-container" style="max-width: 440px; position: relative; z-index: 100;">
        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="ElektraFit">
            <h1>ElektraFit</h1>
            <p>Create your account</p>
        </div>

        @php
            $selectedPlan = request()->query('plan');
            $planPrices = [
                'basic' => 'KSh 2,500',
                'premium' => 'KSh 5,000',
                'elite' => 'KSh 9,000'
            ];
        @endphp

        @if($selectedPlan && isset($planPrices[strtolower($selectedPlan)]))
            <div style="background: rgba(0, 191, 255, 0.15); border: 1.5px solid rgba(0, 191, 255, 0.4); border-radius: 16px; padding: 1rem; margin-bottom: 1.5rem; text-align: center;">
                <div style="color: #00bfff; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.25rem;">Selected Plan</div>
                <div style="color: #ffffff; font-size: 1.25rem; font-weight: 700;">{{ ucfirst(strtolower($selectedPlan)) }} Membership</div>
                <div style="color: rgba(255, 255, 255, 0.8); font-size: 1.1rem; margin-top: 0.25rem;">{{ $planPrices[strtolower($selectedPlan)] }}/month</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="status-message error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            @if($selectedPlan)
                <input type="hidden" name="plan" value="{{ strtolower($selectedPlan) }}">
            @endif
            
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>

            <button type="submit" class="btn-primary">Register</button>
        </form>

        <div class="auth-links">
            <a href="{{ route('login') }}">Already have an account? Login</a>
        </div>
    </div>
@endsection
