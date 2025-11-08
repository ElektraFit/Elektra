@extends('layouts.auth')

@section('title', 'Login - ElektraFit')

@section('content')
    <div class="auth-container" style="max-width: 440px;">
        <div class="auth-logo">
            <img src="{{ asset('images/logo.png') }}" alt="ElektraFit">
            <h1>ElektraFit</h1>
            <p>Welcome back</p>
        </div>

        @if ($errors->any())
            <div class="status-message error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-primary">Login</button>
        </form>

        <div class="auth-links">
            <a href="{{ route('register') }}">Don't have an account? Sign up</a>
        </div>
    </div>
@endsection
