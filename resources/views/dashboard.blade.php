@extends('layouts.dashboard')

@section('title', 'Dashboard - ElektraFit')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="{{ route('dashboard') }}" icon="�" label="Dashboard" :active="true" />
        <x-nav-item href="{{ route('training-sessions.index') }}" icon="💪" label="Training Sessions" />
        <x-nav-item href="#" icon="🎓" label="Instructors" />
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
            <span id="typed-text" data-name="{{ $userName ?? 'Member' }}"></span><span class="cursor"></span>
        </h1>
        <p class="welcome-subtitle">Welcome to your fitness journey</p>
    </div>

    <div class="stats-grid">
        <x-dashboard-stat-card icon="💪" value="{{ $totalSessions }}" label="Total Sessions" />
        <x-dashboard-stat-card icon="⏱️" value="{{ $totalHours }}" label="Total Hours" />
        <x-dashboard-stat-card icon="📅" value="{{ $weekSessions }}" label="This Week's Sessions" />
        <x-dashboard-stat-card icon="🔥" value="{{ $weekHours }}" label="This Week's Hours" />
    </div>

    <div class="content-card">
        <h2 class="card-title">Getting Started</h2>
        <p style="color: rgba(255, 255, 255, 0.7);">Welcome to ElektraFit! Your personalized dashboard is ready. Start by booking a session with one of our instructors or explore our membership plans.</p>
    </div>
@endsection
