@extends('layouts.dashboard')

@section('title', 'Dashboard - ElektraFit')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="#" icon="🏠" label="Dashboard" :active="true" />
        <x-nav-item href="#" icon="🎓" label="Instructors" />
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
            <span id="typed-text" data-name="{{ $userName ?? 'Member' }}"></span><span class="cursor"></span>
        </h1>
        <p class="welcome-subtitle">Welcome to your fitness journey</p>
    </div>

    <div class="stats-grid">
        <x-dashboard-stat-card icon="💪" value="0" label="Workouts This Month" />
        <x-dashboard-stat-card icon="🔥" value="0" label="Calories Burned" />
        <x-dashboard-stat-card icon="⏱️" value="0" label="Hours Trained" />
        <x-dashboard-stat-card icon="🎯" value="0" label="Goals Achieved" />
    </div>

    <div class="content-card">
        <h2 class="card-title">Getting Started</h2>
        <p style="color: rgba(255, 255, 255, 0.7);">Welcome to ElektraFit! Your personalized dashboard is ready. Start by booking a session with one of our instructors or explore our membership plans.</p>
    </div>
@endsection
