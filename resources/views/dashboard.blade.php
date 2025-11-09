@extends('layouts.dashboard')

@section('title', 'Dashboard - ElektraFit')

@section('sidebar-nav')
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="active">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('training-sessions.index') }}">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
                <span class="nav-text">Training Sessions</span>
            </a>
        </li>
        <li>
            <a href="#">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span class="nav-text">Instructors</span>
            </a>
        </li>
    </ul>
@endsection

@section('logout-button')
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
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
            <div class="stat-value">{{ $totalSessions }}</div>
            <div class="stat-label">Total Sessions</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏱️</div>
            <div class="stat-value">{{ $totalHours }}</div>
            <div class="stat-label">Total Hours</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-value">{{ $weekSessions }}</div>
            <div class="stat-label">This Week's Sessions</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🔥</div>
            <div class="stat-value">{{ $weekHours }}</div>
            <div class="stat-label">This Week's Hours</div>
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
