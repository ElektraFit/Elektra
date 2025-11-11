@extends('layouts.dashboard')

@section('title', 'Training Sessions')

@vite(['resources/css/training-sessions.css'])

@section('sidebar-nav')
    <ul>
        <x-nav-item href="{{ route('dashboard') }}" label="Dashboard">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('training-sessions.index') }}" label="Training Sessions" :active="true">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="6" y="9" width="3" height="6"></rect>
                <rect x="15" y="9" width="3" height="6"></rect>
                <rect x="9" y="10.5" width="6" height="3"></rect>
                <line x1="1" y1="12" x2="6" y2="12"></line>
                <line x1="18" y1="12" x2="23" y2="12"></line>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('nutrition.index') }}" label="Nutrition">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 2c0 2-2 4-2 4" />
                <path d="M19 7c-1.5-1-4-1.5-6 0-2-1.5-4.5-1-6 0-3 2-3 8 1 11 2 1.5 4 1 5 0 1 1 3 1.5 5 0 4-3 4-9 1-11z"></path>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('dashboard') }}#instructors" label="Instructors">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </x-nav-item>
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
<div class="training-sessions-page">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content center-text">
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

    <!-- Stats Overview -->
    @if($sessions->isNotEmpty())
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon stat-icon-purple">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $sessions->count() }}</div>
                <div class="stat-label">Total Sessions</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $sessions->sum('duration') }}</div>
                <div class="stat-label">Total Minutes</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-green">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $sessions->where('session_date', '>=', now()->startOfWeek())->count() }}</div>
                <div class="stat-label">This Week</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-orange">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                </svg>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $sessions->avg('intensity') ? number_format($sessions->avg('intensity'), 1) : 0 }}</div>
                <div class="stat-label">Avg Intensity</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Sessions List -->
    <div class="sessions-container">
        @if($sessions->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>
            <h3 class="empty-title">No Training Sessions Yet</h3>
            <p class="empty-text">Start your fitness journey by logging your first training session</p>
        </div>
        @else
        <div class="sessions-list">
            @foreach($sessions as $session)
            <div class="session-card">
                <div class="session-header">
                    <div class="session-type">
                        @switch($session->training_type)
                            @case('cardio')
                                <div class="type-badge type-cardio">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                    </svg>
                                    <span>Cardio</span>
                                </div>
                                @break
                            @case('strength')
                                <div class="type-badge type-strength">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="6" y1="6" x2="6" y2="18"></line>
                                        <line x1="18" y1="6" x2="18" y2="18"></line>
                                        <line x1="4" y1="6" x2="8" y2="6"></line>
                                        <line x1="16" y1="6" x2="20" y2="6"></line>
                                        <line x1="4" y1="18" x2="8" y2="18"></line>
                                        <line x1="16" y1="18" x2="20" y2="18"></line>
                                        <line x1="9" y1="9" x2="15" y2="9"></line>
                                        <line x1="9" y1="15" x2="15" y2="15"></line>
                                    </svg>
                                    <span>Strength</span>
                                </div>
                                @break
                            @case('flexibility')
                                <div class="type-badge type-flexibility">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2a10 10 0 1 0 0 20 10 10 0 1 0 0-20z"></path>
                                        <path d="M12 6v6l4 2"></path>
                                    </svg>
                                    <span>Flexibility</span>
                                </div>
                                @break
                            @case('hiit')
                                <div class="type-badge type-hiit">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                                    </svg>
                                    <span>HIIT</span>
                                </div>
                                @break
                            @case('sports')
                                <div class="type-badge type-sports">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <path d="M12 2a10 10 0 0 0 0 20"></path>
                                        <path d="M12 2a10 10 0 0 1 0 20"></path>
                                    </svg>
                                    <span>Sports</span>
                                </div>
                                @break
                            @default
                                <div class="type-badge type-other">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                    </svg>
                                    <span>{{ ucfirst($session->training_type) }}</span>
                                </div>
                        @endswitch
                    </div>
                    <div class="session-actions">
                        <a href="{{ route('training-sessions.edit', $session) }}" class="btn-icon" title="Edit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('training-sessions.destroy', $session) }}" method="POST" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this session?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-icon-danger" title="Delete">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="session-details">
                    <div class="detail-row">
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>{{ $session->session_date->format('M d, Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>{{ $session->session_time->format('h:i A') }}</span>
                        </div>
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>{{ $session->duration }} mins</span>
                        </div>
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                            </svg>
                            <span>Level {{ $session->intensity }}</span>
                        </div>
                    </div>

                    @if($session->instructor)
                    <div class="detail-row">
                        <div class="detail-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>Instructor: {{ $session->instructor->name }}</span>
                        </div>
                    </div>
                    @endif

                    @if($session->notes)
                    <div class="session-notes">
                        <p>{{ $session->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
