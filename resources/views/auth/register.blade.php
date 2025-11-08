@extends('layouts.auth')

@section('title', 'Register - ElektraFit')

@section('content')
    <div class="auth-container" style="max-width: 440px;">
        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="ElektraFit">
            <h1>ElektraFit</h1>
            <p>Create your account</p>
        </div>

        @if ($errors->any())
            <div class="status-message error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            
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
