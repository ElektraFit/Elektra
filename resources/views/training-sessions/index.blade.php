@extends('layouts.dashboard')

@section('title', 'My Training Sessions')

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
<div class="training-sessions-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Training Sessions</h1>
            <p class="page-subtitle">Track your fitness journey and progress</p>
        </div>
        <a href="{{ route('training-sessions.create') }}" class="btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Log New Session</span>
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($sessions->count() > 0)
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon stat-icon-primary">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="20" x2="12" y2="10"></line>
                        <line x1="18" y1="20" x2="18" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="16"></line>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $sessions->count() }}</div>
                    <div class="stat-label">Total Sessions</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-success">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $sessions->sum('duration_minutes') }}</div>
                    <div class="stat-label">Total Minutes</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-danger">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value">{{ $sessions->where('intensity', 'high')->count() }}</div>
                    <div class="stat-label">High Intensity</div>
                </div>
            </div>
        </div>

        <!-- Sessions List -->
        <div class="sessions-list">
            @foreach($sessions as $session)
                <div class="session-card">
                    <div class="session-header">
                        <div class="session-title-wrapper">
                            <div class="session-type-icon">
                                @switch($session->training_type)
                                    @case('Cardio')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                        </svg>
                                    @break
                                    @case('Strength Training')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M6.5 6.5h11v11h-11z"></path>
                                            <path d="M6.5 6.5L2 2"></path>
                                            <path d="M17.5 6.5L22 2"></path>
                                            <path d="M6.5 17.5L2 22"></path>
                                            <path d="M17.5 17.5L22 22"></path>
                                        </svg>
                                    @break
                                    @case('Yoga')
                                    @case('Pilates')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 16v-4"></path>
                                            <path d="M12 8h.01"></path>
                                        </svg>
                                    @break
                                    @case('HIIT')
                                    @case('CrossFit')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                                        </svg>
                                    @break
                                    @case('Boxing')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                                            <path d="M2 17l10 5 10-5"></path>
                                            <path d="M2 12l10 5 10-5"></path>
                                        </svg>
                                    @break
                                    @case('Swimming')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M2 16.1A5 5 0 0 1 5.9 20M2 12.05A9 9 0 0 1 9.95 20M2 8V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    @break
                                    @case('Cycling')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="18.5" cy="17.5" r="3.5"></circle>
                                            <circle cx="5.5" cy="17.5" r="3.5"></circle>
                                            <circle cx="15" cy="5" r="1"></circle>
                                            <path d="M12 17.5V14l-3-3 4-3 2 3h2"></path>
                                        </svg>
                                    @break
                                    @case('Running')
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="5" r="3"></circle>
                                            <path d="M6.5 8.5L9 11l3-3 3 3 2.5-2.5"></path>
                                            <path d="M9 18l-3 3"></path>
                                            <path d="M15 18l3 3"></path>
                                        </svg>
                                    @break
                                    @default
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                @endswitch
                            </div>
                            <div>
                                <h3 class="session-type">{{ $session->training_type }}</h3>
                                @if($session->description)
                                    <p class="session-description">{{ Str::limit($session->description, 60) }}</p>
                                @endif
                            </div>
                        </div>
                        <span class="intensity-badge intensity-{{ $session->intensity }}">
                            {{ ucfirst($session->intensity) }}
                        </span>
                    </div>

                    <div class="session-details">
                        <div class="detail-item">
                            <svg class="detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>{{ $session->session_date->format('M d, Y') }}</span>
                        </div>

                        <div class="detail-item">
                            <svg class="detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($session->session_time)->format('g:i A') }}</span>
                        </div>

                        <div class="detail-item">
                            <svg class="detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span>{{ $session->duration_minutes }} min</span>
                        </div>

                        @if($session->instructor)
                            <div class="detail-item">
                                <svg class="detail-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>{{ $session->instructor->name }}</span>
                            </div>
                        @endif
                    </div>

                    @if($session->notes)
                        <div class="session-notes">
                            <svg class="notes-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <p>{{ Str::limit($session->notes, 100) }}</p>
                        </div>
                    @endif

                    <div class="session-actions">
                        <a href="{{ route('training-sessions.edit', $session) }}" class="btn-action btn-edit">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('training-sessions.destroy', $session) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this session?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
            </div>
            <h2>No Training Sessions Yet</h2>
            <p>Start tracking your fitness journey by logging your first workout session!</p>
            <a href="{{ route('training-sessions.create') }}" class="btn-primary">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Log Your First Session</span>
            </a>
        </div>
    @endif
</div>
@endsection

@section('extra-styles')
<style>
/* Container */
.training-sessions-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 3rem 2rem;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 3rem;
    gap: 2rem;
}

.header-content {
    flex: 1;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 0.75rem 0;
    letter-spacing: -0.02em;
}

.page-subtitle {
    font-size: 1.125rem;
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
}

/* Primary Button */
.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
}

.btn-primary svg {
    flex-shrink: 0;
}

/* Alert */
.alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    font-weight: 500;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    color: #10b981;
}

.alert svg {
    flex-shrink: 0;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 2rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.stat-icon {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    flex-shrink: 0;
}

.stat-icon-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-icon-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.stat-icon-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    line-height: 1;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9375rem;
    color: rgba(255, 255, 255, 0.6);
    font-weight: 500;
}

/* Sessions List */
.sessions-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.session-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2rem;
    transition: all 0.3s ease;
}

.session-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateX(4px);
}

.session-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    gap: 1.5rem;
}

.session-title-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    flex: 1;
}

.session-type-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 12px;
    flex-shrink: 0;
}

.session-type-icon svg {
    color: #667eea;
}

.session-type {
    font-size: 1.25rem;
    font-weight: 600;
    color: #fff;
    margin: 0 0 0.5rem 0;
}

.session-description {
    font-size: 0.9375rem;
    color: rgba(255, 255, 255, 0.5);
    margin: 0;
    line-height: 1.5;
}

/* Intensity Badge */
.intensity-badge {
    padding: 0.5rem 1rem;
    border-radius: 24px;
    font-size: 0.8125rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.intensity-low {
    background: rgba(16, 185, 129, 0.15);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.intensity-moderate {
    background: rgba(245, 158, 11, 0.15);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.intensity-high {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

/* Session Details */
.session-details {
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9375rem;
}

.detail-icon {
    color: rgba(255, 255, 255, 0.4);
    flex-shrink: 0;
}

/* Session Notes */
.session-notes {
    display: flex;
    gap: 1rem;
    padding: 1.25rem;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 10px;
    margin-bottom: 1.5rem;
}

.notes-icon {
    color: rgba(255, 255, 255, 0.4);
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.session-notes p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9375rem;
    line-height: 1.6;
    margin: 0;
}

/* Session Actions */
.session-actions {
    display: flex;
    gap: 1rem;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.75rem 1.25rem;
    border-radius: 10px;
    font-size: 0.9375rem;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.btn-edit:hover {
    background: rgba(59, 130, 246, 0.2);
    border-color: rgba(59, 130, 246, 0.5);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.2);
    border-color: rgba(239, 68, 68, 0.5);
}

.btn-action svg {
    flex-shrink: 0;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 5rem 2rem;
    background: rgba(255, 255, 255, 0.02);
    border: 2px dashed rgba(255, 255, 255, 0.1);
    border-radius: 20px;
}

.empty-icon {
    margin: 0 auto 2rem;
    color: rgba(255, 255, 255, 0.2);
}

.empty-state h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 1rem 0;
}

.empty-state p {
    font-size: 1.125rem;
    color: rgba(255, 255, 255, 0.5);
    margin: 0 0 2.5rem 0;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .training-sessions-container {
        padding: 1rem;
    }

    .page-header {
        flex-direction: column;
        gap: 1rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .session-header {
        flex-direction: column;
    }

    .session-details {
        flex-direction: column;
        gap: 0.75rem;
    }

    .session-actions {
        flex-direction: column;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
