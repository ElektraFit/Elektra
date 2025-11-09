@extends('layouts.dashboard')

@section('title', 'Instructor Dashboard - ElektraFit')

@section('sidebar-class', 'instructor-sidebar')

@section('sidebar-nav')
    <ul>
        <li>
            <a href="#" class="active">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span class="nav-text">Dashboard</span>
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
                <span class="nav-text">My Clients</span>
            </a>
        </li>
        <li>
            <a href="#">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                <span class="nav-text">Schedule</span>
            </a>
        </li>
        <li>
            <a href="#">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                </svg>
                <span class="nav-text">Classes</span>
            </a>
        </li>
        <li>
            <a href="{{ route('instructor.profile') }}">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M12 1v6m0 6v6m5.2-14.8l-4.2 4.2m0 5.2l4.2 4.2M1 12h6m6 0h6M3.8 17.8l4.2-4.2m5.2 0l4.2 4.2"></path>
                </svg>
                <span class="nav-text">Settings</span>
            </a>
        </li>
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
        <x-dashboard-stat-card value="24" label="Active Clients" :instructor="true">
            <x-slot name="icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </x-slot>
        </x-dashboard-stat-card>
        <x-dashboard-stat-card value="8" label="Classes This Week" :instructor="true">
            <x-slot name="icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </x-slot>
        </x-dashboard-stat-card>
        <x-dashboard-stat-card value="4.9" label="Average Rating" :instructor="true">
            <x-slot name="icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            </x-slot>
        </x-dashboard-stat-card>
        <x-dashboard-stat-card value="156" label="Total Sessions" :instructor="true">
            <x-slot name="icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </x-slot>
        </x-dashboard-stat-card>
    </div>

    <div class="content-card" style="border-color: rgba(138, 43, 226, 0.2);">
        <h2 class="card-title" style="color: #8a2be2;">Upcoming Sessions</h2>
        <p style="color: rgba(255, 255, 255, 0.6);">No sessions scheduled yet. Check back later!</p>
    </div>
@endsection
