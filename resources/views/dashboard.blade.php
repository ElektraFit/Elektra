@extends('layouts.dashboard')

@section('title', 'Dashboard - ElektraFit')

@section('sidebar-nav')
    <ul>
        <li>
            <a href="#" class="active">
                <span class="nav-icon">🏠</span>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="nav-icon">🎓</span>
                <span class="nav-text">Instructors</span>
            </a>
        </li>
    </ul>
@endsection

@section('logout-button')
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <span class="nav-icon">🚪</span>
            <span class="nav-text">Logout</span>
        </button>
    </form>
@endsection

@section('content')
    <div class="welcome-section">
        <h1 class="welcome-title">
            <span id="typed-text"></span><span class="cursor"></span>
        </h1>
        <p class="welcome-subtitle">Welcome to your fitness journey</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">💪</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Workouts This Month</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🔥</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Calories Burned</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏱️</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Hours Trained</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🎯</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Goals Achieved</div>
        </div>
    </div>

    <div class="content-card">
        <h2 class="card-title">Getting Started</h2>
        <p style="color: rgba(255, 255, 255, 0.7);">Welcome to ElektraFit! Your personalized dashboard is ready. Start by booking a session with one of our instructors or explore our membership plans.</p>
    </div>
@endsection

@section('scripts')
    const userName = "{{ $userName ?? 'Member' }}";
    const typedTextElement = document.getElementById('typed-text');
    let charIndex = 0;

    function typeWriter() {
        if (charIndex < userName.length) {
            typedTextElement.textContent += userName.charAt(charIndex);
            charIndex++;
            setTimeout(typeWriter, 100);
        }
    }

    window.addEventListener('load', typeWriter);
@endsection
