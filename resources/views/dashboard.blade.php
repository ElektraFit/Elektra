@extends('layouts.dashboard')

@section('title', 'Dashboard - ElektraFit')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="#" icon="■" label="Dashboard" :active="true" data-view="dashboard" />
        <x-nav-item href="#" icon="⚡" label="Training Sessions" data-view="training" />
        <x-nav-item href="{{ route('nutrition.index') }}" icon="🍎" label="Nutrition" />
        <x-nav-item href="#" icon="▲" label="Instructors" data-view="instructors" />
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
    <!-- Dashboard View -->
    <div id="dashboard-view" class="content-view active">
        <div class="welcome-section">
            <h1 class="welcome-title">
                <span id="typed-text" data-name="{{ $userName ?? 'Member' }}"></span><span class="cursor"></span>
            </h1>
            <p class="welcome-subtitle">Welcome to your fitness journey</p>
        </div>

        <div class="stats-grid">
            <x-dashboard-stat-card icon="♦" value="{{ $totalSessions }}" label="Total Sessions" />
            <x-dashboard-stat-card icon="⏱" value="{{ $totalHours }}" label="Total Hours" />
            <x-dashboard-stat-card icon="●" value="{{ $weekSessions }}" label="This Week's Sessions" />
            <x-dashboard-stat-card icon="★" value="{{ $weekHours }}" label="This Week's Hours" />
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
                            @if($instructor->bio)
                                <p class="bio">{{ Str::limit($instructor->bio, 100) }}</p>
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

    <style>
        .content-view {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .content-view.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .training-header, .instructors-header, .page-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .header-content {
            flex: 1;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.5rem;
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', sans-serif;
            letter-spacing: -0.015em;
        }

        .page-subtitle {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 400;
        }

        .btn-create {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            background: linear-gradient(135deg, rgba(0, 191, 255, 0.15), rgba(0, 128, 255, 0.15));
            color: #00bfff;
            border: 1.5px solid rgba(0, 191, 255, 0.3);
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            box-shadow: 0 4px 16px rgba(0, 191, 255, 0.1);
        }

        .btn-create:hover {
            background: linear-gradient(135deg, rgba(0, 191, 255, 0.25), rgba(0, 128, 255, 0.25));
            border-color: rgba(0, 191, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 191, 255, 0.2);
        }

        .btn-create svg {
            stroke-width: 2.5;
        }

        .sessions-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .session-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
        }

        .session-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(0, 191, 255, 0.3);
        }

        .session-info h3 {
            color: #00bfff;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .session-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9375rem;
        }

        .session-notes {
            margin-top: 0.5rem;
            font-style: italic;
        }

        .session-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-edit, .btn-delete {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-weight: 500;
        }

        .btn-edit {
            background: rgba(0, 191, 255, 0.1);
            color: #00bfff;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: rgba(0, 191, 255, 0.2);
        }

        .btn-delete {
            background: rgba(255, 59, 48, 0.1);
            color: #ff3b30;
        }

        .btn-delete:hover {
            background: rgba(255, 59, 48, 0.2);
        }

        .instructors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .instructor-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.28, 0.11, 0.32, 1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .instructor-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(0, 191, 255, 0.3);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        .instructor-photo {
            width: 100%;
            height: 240px;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.3);
        }

        .instructor-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .instructor-info {
            padding: 1.25rem;
        }

        .instructor-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 0.5rem;
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', sans-serif;
        }

        .specialization {
            font-size: 0.9375rem;
            color: #00bfff;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .experience {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0.75rem;
        }

        .bio {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
            margin-bottom: 0.75rem;
        }

        .instructor-stats {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 1rem;
        }

        .instructor-stats span:first-child {
            color: #00bfff;
            font-weight: 600;
        }

        .btn-book {
            width: 100%;
            padding: 0.625rem 1.25rem;
            background: rgba(0, 191, 255, 0.1);
            color: #00bfff;
            border: 1.5px solid #00bfff;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9375rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.28, 0.11, 0.32, 1);
        }

        .btn-book:hover {
            background: #00bfff;
            color: #0a0e27;
            transform: scale(1.02);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state p {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.6);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('[data-view]');
            
            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const viewName = this.getAttribute('data-view');
                    
                    // Remove active class from all nav items
                    navItems.forEach(nav => nav.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Hide all content views
                    document.querySelectorAll('.content-view').forEach(view => {
                        view.classList.remove('active');
                    });
                    
                    // Show selected view
                    const targetView = document.getElementById(viewName + '-view');
                    if (targetView) {
                        targetView.classList.add('active');
                    }
                });
            });
        });
    </script>
@endsection
