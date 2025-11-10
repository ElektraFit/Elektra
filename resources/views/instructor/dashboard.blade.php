@extends('layouts.dashboard')

@section('title', 'Instructor Dashboard - ElektraFit')

@section('sidebar-class', 'instructor-sidebar')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="#" label="Dashboard" :active="true">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
        </x-nav-item>
        <x-nav-item href="#" label="My Clients">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </x-nav-item>
        <x-nav-item href="#" label="Schedule">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
                <path d="M8 14h.01"></path>
                <path d="M12 14h.01"></path>
                <path d="M16 14h.01"></path>
                <path d="M8 18h.01"></path>
                <path d="M12 18h.01"></path>
                <path d="M16 18h.01"></path>
            </svg>
        </x-nav-item>
        <x-nav-item href="#" label="Classes">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 22V4a2 2 0 0 1 2-2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"></path>
                <path d="M13 2v6h6"></path>
                <path d="M9 13h6"></path>
                <path d="M9 17h6"></path>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('instructor.profile') }}" label="Settings">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 8.6 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 8.6a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33h.09A1.65 1.65 0 0 0 11 3.09V3a2 2 0 1 1 4 0v.09c0 .7.4 1.33 1 1.51h.09a1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82v.09c.7.17 1.33.8 1.51 1.49H21a2 2 0 1 1 0 4h-.09c-.7 0-1.33.4-1.51 1z"></path>
            </svg>
        </x-nav-item>
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
