@extends('layouts.dashboard')

@section('title', 'Instructor Dashboard - ElektraFit')

@section('sidebar-class', 'instructor-sidebar')

@section('sidebar-nav')
    <ul>
        <li>
            <a href="#" class="active">
                <span class="nav-icon">📊</span>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="nav-icon">👥</span>
                <span class="nav-text">My Clients</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="nav-icon">📅</span>
                <span class="nav-text">Schedule</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="nav-icon">💪</span>
                <span class="nav-text">Classes</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="nav-icon">⚙️</span>
                <span class="nav-text">Settings</span>
            </a>
        </li>
    </ul>
@endsection

@section('logout-button')
    <form method="POST" action="{{ route('instructor.logout') }}">
        @csrf
        <button type="submit" class="btn-logout">
            <span class="nav-icon">🚪</span>
            <span class="nav-text">Logout</span>
        </button>
    </form>
@endsection

@section('content')
    <div class="welcome-section instructor-welcome">
        <h1 class="welcome-title">
            <span id="typed-text"></span><span class="cursor"></span>
        </h1>
        <p class="welcome-subtitle">Here's your teaching overview</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card instructor-stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-value">24</div>
            <div class="stat-label">Active Clients</div>
        </div>
        <div class="stat-card instructor-stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-value">8</div>
            <div class="stat-label">Classes This Week</div>
        </div>
        <div class="stat-card instructor-stat-card">
            <div class="stat-icon">⭐</div>
            <div class="stat-value">4.9</div>
            <div class="stat-label">Average Rating</div>
        </div>
        <div class="stat-card instructor-stat-card">
            <div class="stat-icon">🏆</div>
            <div class="stat-value">156</div>
            <div class="stat-label">Total Sessions</div>
        </div>
    </div>

    <div class="content-card" style="border-color: rgba(138, 43, 226, 0.2);">
        <h2 class="card-title" style="color: #8a2be2;">Upcoming Sessions</h2>
        <p style="color: rgba(255, 255, 255, 0.6);">No sessions scheduled yet. Check back later!</p>
    </div>
@endsection

@section('scripts')
    const instructorName = "{{ session('instructor_name') ?? 'Instructor' }}";
    const typedTextElement = document.getElementById('typed-text');
    let charIndex = 0;

    function typeWriter() {
        if (charIndex < instructorName.length) {
            typedTextElement.textContent += instructorName.charAt(charIndex);
            charIndex++;
            setTimeout(typeWriter, 100);
        }
    }

    window.addEventListener('load', typeWriter);
@endsection
