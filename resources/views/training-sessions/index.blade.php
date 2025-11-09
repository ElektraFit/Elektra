@extends('layouts.dashboard')

@section('title', 'Training Sessions')

@section('sidebar-nav')
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">
                <svg class="nav-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('training-sessions.index') }}" class="active">
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
<div class="training-sessions-page">
    <!-- Page Header -->
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
            <a href="{{ route('training-sessions.create') }}" class="btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Create First Session</span>
            </a>
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

<style>
    .training-sessions-page {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 3rem;
    }

    .header-content h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 0.5rem 0;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.6);
        font-size: 1rem;
        margin: 0;
    }

    .btn-create {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 1.75rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
    }

    .btn-create svg {
        transition: transform 0.3s ease;
    }

    .btn-create:hover svg {
        transform: rotate(90deg);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon-purple {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
        border: 1px solid rgba(102, 126, 234, 0.3);
    }

    .stat-icon-blue {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.2));
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .stat-icon-green {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .stat-icon-orange {
        background: linear-gradient(135deg, rgba(251, 146, 60, 0.2), rgba(249, 115, 22, 0.2));
        border: 1px solid rgba(251, 146, 60, 0.3);
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.6);
    }

    /* Sessions List */
    .sessions-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2rem;
    }

    .sessions-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .session-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 1.75rem;
        transition: all 0.3s ease;
    }

    .session-card:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.2);
        transform: translateX(4px);
    }

    .session-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        border: 1px solid;
    }

    .type-cardio {
        background: rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }

    .type-strength {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.3);
        color: #3b82f6;
    }

    .type-flexibility {
        background: rgba(16, 185, 129, 0.15);
        border-color: rgba(16, 185, 129, 0.3);
        color: #10b981;
    }

    .type-hiit {
        background: rgba(251, 146, 60, 0.15);
        border-color: rgba(251, 146, 60, 0.3);
        color: #fb923c;
    }

    .type-sports {
        background: rgba(168, 85, 247, 0.15);
        border-color: rgba(168, 85, 247, 0.3);
        color: #a855f7;
    }

    .type-other {
        background: rgba(156, 163, 175, 0.15);
        border-color: rgba(156, 163, 175, 0.3);
        color: #9ca3af;
    }

    .session-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.15);
        background: rgba(255, 255, 255, 0.05);
        color: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-icon:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .btn-icon-danger:hover {
        background: rgba(239, 68, 68, 0.2);
        border-color: rgba(239, 68, 68, 0.4);
        color: #ef4444;
    }

    .delete-form {
        display: inline;
        margin: 0;
    }

    .session-details {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .detail-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9375rem;
    }

    .detail-item svg {
        color: rgba(102, 126, 234, 0.8);
        flex-shrink: 0;
    }

    .session-notes {
        padding: 1rem;
        background: rgba(0, 0, 0, 0.2);
        border-left: 3px solid rgba(102, 126, 234, 0.6);
        border-radius: 8px;
        margin-top: 0.5rem;
    }

    .session-notes p {
        margin: 0;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9375rem;
        line-height: 1.6;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(102, 126, 234, 0.6);
    }

    .empty-title {
        font-size: 1.75rem;
        font-weight: 600;
        color: white;
        margin: 0 0 0.75rem 0;
    }

    .empty-text {
        font-size: 1.0625rem;
        color: rgba(255, 255, 255, 0.6);
        margin: 0 0 2rem 0;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
    }

    @media (max-width: 768px) {
        .training-sessions-page {
            padding: 1.5rem;
        }

        .page-header {
            flex-direction: column;
            gap: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .detail-row {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
@endsection
