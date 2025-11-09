@extends('layouts.dashboard')

@section('title', 'Dashboard - ElektraFit')

@section('sidebar-nav')
    <x-navigation active="dashboard" />
@endsection

@section('logout-button')
    <x-logout-button />
@endsection

@push('styles')
    @vite('resources/css/dashboard-views.css')
@endpush

@section('content')
    <!-- Dashboard View -->
    <div id="dashboard-view" class="content-view active">
        <div class="welcome-section">
            <h1 class="welcome-title">
                <span id="typed-text" data-name="{{ $userName ?? 'Member' }}"></span><span class="cursor"></span>
            </h1>
            <p class="welcome-subtitle">Welcome to your fitness journey</p>
        </div>

        <div class="stats-grid">
            <x-dashboard-stat-card value="{{ $totalSessions }}" label="Total Sessions">
                <x-slot name="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </x-slot>
            </x-dashboard-stat-card>
            <x-dashboard-stat-card value="{{ $totalHours }}" label="Total Hours">
                <x-slot name="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </x-slot>
            </x-dashboard-stat-card>
            <x-dashboard-stat-card value="{{ $weekSessions }}" label="This Week's Sessions">
                <x-slot name="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 20V10M12 20V4M6 20v-6"></path>
                    </svg>
                </x-slot>
            </x-dashboard-stat-card>
            <x-dashboard-stat-card value="{{ $weekHours }}" label="This Week's Hours">
                <x-slot name="icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </x-slot>
            </x-dashboard-stat-card>
        </div>

        <div class="content-card">
            <h2 class="card-title">Getting Started</h2>
            <p style="color: rgba(255, 255, 255, 0.7);">Welcome to ElektraFit! Your personalized dashboard is ready. Start by booking a session with one of our instructors or explore our membership plans.</p>
        </div>
    </div>

    <!-- Training Sessions View -->
    <div id="training-view" class="content-view">
        <div class="page-header">
            <div class="header-content">
                <h1 class="page-title">My Training Sessions</h1>
                <p class="page-subtitle">Track and manage your fitness journey</p>
            </div>
            <a href="{{ route('training-sessions.create') }}" class="btn-create">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>New Session</span>
            </a>
        </div>

        @if(isset($sessions) && $sessions->count() > 0)
            <div class="sessions-list">
                @foreach($sessions as $session)
                    <div class="session-card">
                        <div class="session-info">
                            <h3>{{ ucfirst($session->training_type) }}</h3>
                            <p>{{ $session->duration_minutes }} minutes • {{ $session->session_date->format('M d, Y') }}</p>
                            @if($session->notes)
                                <p class="session-notes">{{ $session->notes }}</p>
                            @endif
                        </div>
                        <div class="session-actions">
                            <a href="{{ route('training-sessions.edit', $session) }}" class="btn-edit">Edit</a>
                            <form method="POST" action="{{ route('training-sessions.destroy', $session) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete this session?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>No training sessions yet. Start by creating your first session!</p>
            </div>
        @endif
    </div>

    <!-- Instructors View -->
    <div id="instructors-view" class="content-view">
        <div class="page-header">
            <div class="header-content">
                <h1 class="page-title">Our Expert Instructors</h1>
                <p class="page-subtitle">Train with certified professionals dedicated to helping you achieve your fitness goals</p>
            </div>
        </div>

        @if(isset($instructors) && $instructors->count() > 0)
            <div class="instructors-grid">
                @foreach($instructors as $instructor)
                    <div class="instructor-card">
                        <div class="instructor-photo">
                            <img src="{{ $instructor->profile_photo_url }}" alt="{{ $instructor->name }}">
                        </div>
                        <div class="instructor-info">
                            <h3>{{ $instructor->name }}</h3>
                            <p class="specialization">{{ $instructor->specialization }}</p>
                            <p class="experience">{{ $instructor->years_of_experience }} years experience</p>
                            @if($instructor->short_bio)
                                <p class="bio">{{ $instructor->short_bio }}</p>
                            @endif
                            <div class="instructor-stats">
                                <span>★ 4.9</span>
                                <span>•</span>
                                <span>{{ rand(20, 100) }} sessions</span>
                            </div>
                            <button class="btn-book">Book Session</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>No instructors available at the moment. Check back soon!</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    @vite('resources/js/dashboard-navigation.js')
@endpush
