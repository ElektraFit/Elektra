@extends('layouts.dashboard')

@section('title', 'Instructor Dashboard - ElektraFit')

@section('sidebar-class', 'instructor-sidebar')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="#" icon="■" label="Dashboard" :active="true" />
        <x-nav-item href="#" icon="▲" label="My Clients" />
        <x-nav-item href="#" icon="●" label="Schedule" />
        <x-nav-item href="#" icon="♦" label="Classes" />
        <x-nav-item href="{{ route('instructor.profile') }}" icon="⚙" label="Settings" />
    </ul>
@endsection

@section('logout-button')
    <form method="POST" action="{{ route('instructor.logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <span class="nav-icon">→</span>
            <span class="nav-text">Logout</span>
        </button>
    </form>
@endsection

@section('content')
    <div class="welcome-section instructor-welcome">
        <h1 class="welcome-title">
            <span id="typed-text" data-name="{{ session('instructor_name') ?? 'Instructor' }}"></span><span class="cursor"></span>
        </h1>
        <p class="welcome-subtitle">Here's your teaching overview</p>
    </div>

    <div class="stats-grid">
        <x-dashboard-stat-card icon="▲" value="24" label="Active Clients" :instructor="true" />
        <x-dashboard-stat-card icon="●" value="8" label="Classes This Week" :instructor="true" />
        <x-dashboard-stat-card icon="★" value="4.9" label="Average Rating" :instructor="true" />
        <x-dashboard-stat-card icon="♦" value="156" label="Total Sessions" :instructor="true" />
    </div>

    <div class="content-card" style="border-color: rgba(138, 43, 226, 0.2);">
        <h2 class="card-title" style="color: #8a2be2;">Upcoming Sessions</h2>
        <p style="color: rgba(255, 255, 255, 0.6);">No sessions scheduled yet. Check back later!</p>
    </div>
@endsection
