@extends('layouts.dashboard')

@section('title', 'My Training Sessions')

@section('sidebar-nav')
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">
                <span class="nav-icon">🏠</span>
                <span class="nav-text">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('training-sessions.index') }}" class="active">
                <span class="nav-icon">💪</span>
                <span class="nav-text">Training Sessions</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span class="nav-icon">🎓</span>
                <span class="nav-text">Instructors</span>
            </a>
        </li>
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
<div class="training-sessions-container">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">
                <span class="title-icon">💪</span>
                Training Sessions
            </h1>
            <p class="page-subtitle">Track your fitness journey and progress</p>
        </div>
        <a href="{{ route('training-sessions.create') }}" class="btn-create-session">
            <span class="btn-icon">+</span>
            <span>Log New Session</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <span class="alert-icon">✓</span>
            {{ session('success') }}
        </div>
    @endif

    @if($sessions->count() > 0)
        <div class="sessions-stats">
            <div class="stat-mini-card">
                <div class="stat-mini-icon">📊</div>
                <div class="stat-mini-content">
                    <div class="stat-mini-value">{{ $sessions->count() }}</div>
                    <div class="stat-mini-label">Total Sessions</div>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-icon">⏱️</div>
                <div class="stat-mini-content">
                    <div class="stat-mini-value">{{ $sessions->sum('duration_minutes') }}</div>
                    <div class="stat-mini-label">Total Minutes</div>
                </div>
            </div>
            <div class="stat-mini-card">
                <div class="stat-mini-icon">🔥</div>
                <div class="stat-mini-content">
                    <div class="stat-mini-value">{{ $sessions->where('intensity', 'high')->count() }}</div>
                    <div class="stat-mini-label">High Intensity</div>
                </div>
            </div>
        </div>

        <div class="sessions-grid">
            @foreach($sessions as $session)
                <div class="session-card" data-intensity="{{ $session->intensity }}">
                    <div class="session-card-header">
                        <div class="session-type">
                            <span class="type-icon">
                                @switch($session->training_type)
                                    @case('Cardio') 🏃 @break
                                    @case('Strength Training') 🏋️ @break
                                    @case('Yoga') 🧘 @break
                                    @case('HIIT') ⚡ @break
                                    @case('Boxing') 🥊 @break
                                    @case('Swimming') 🏊 @break
                                    @case('Cycling') 🚴 @break
                                    @case('Running') 🏃 @break
                                    @default 💪 @break
                                @endswitch
                            </span>
                            <h3>{{ $session->training_type }}</h3>
                        </div>
                        <span class="intensity-badge intensity-{{ $session->intensity }}">
                            {{ ucfirst($session->intensity) }}
                        </span>
                    </div>
                    
                    <div class="session-meta">
                        <div class="meta-item">
                            <span class="meta-icon">📅</span>
                            <span class="meta-text">{{ $session->session_date->format('M d, Y') }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">🕐</span>
                            <span class="meta-text">{{ \Carbon\Carbon::parse($session->session_time)->format('h:i A') }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">⏲️</span>
                            <span class="meta-text">{{ $session->duration_minutes }} min</span>
                        </div>
                    </div>

                    @if($session->instructor)
                        <div class="session-instructor">
                            <span class="instructor-icon">👤</span>
                            <span class="instructor-name">{{ $session->instructor->name }}</span>
                        </div>
                    @endif

                    @if($session->description)
                        <div class="session-description">
                            <p>{{ Str::limit($session->description, 100) }}</p>
                        </div>
                    @endif

                    @if($session->notes)
                        <div class="session-notes">
                            <span class="notes-icon">📝</span>
                            <p>{{ Str::limit($session->notes, 80) }}</p>
                        </div>
                    @endif

                    <div class="session-actions">
                        <a href="{{ route('training-sessions.edit', $session) }}" class="btn-action btn-edit">
                            <span>✏️</span> Edit
                        </a>
                        <form action="{{ route('training-sessions.destroy', $session) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this session?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <span>🗑️</span> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">💪</div>
            <h2>No Training Sessions Yet</h2>
            <p>Start tracking your fitness journey by logging your first workout session!</p>
            <a href="{{ route('training-sessions.create') }}" class="btn-get-started">
                <span>🚀</span> Log Your First Session
            </a>
        </div>
    @endif
</div>

@endsection

@section('extra-styles')
<style>
.training-sessions-container {
    max-width: 1400px;
    margin: 0 auto;
}

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
    font-family: 'Orbitron', sans-serif;
    font-size: 2.5rem;
    font-weight: 900;
    color: #00bfff;
    text-shadow: 0 0 30px rgba(0, 191, 255, 0.6);
    margin: 0 0 0.5rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.title-icon {
    font-size: 2.5rem;
    filter: drop-shadow(0 0 10px rgba(0, 191, 255, 0.4));
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.6);
    font-size: 1.1rem;
    margin: 0;
}

.btn-create-session {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #00bfff 0%, #667eea 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0, 191, 255, 0.3);
    border: 1px solid rgba(0, 191, 255, 0.3);
}

.btn-create-session:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 191, 255, 0.5);
    background: linear-gradient(135deg, #00d4ff 0%, #7689ff 100%);
}

.btn-icon {
    font-size: 1.5rem;
    font-weight: bold;
}

.alert {
    padding: 1.25rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    backdrop-filter: blur(10px);
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-success {
    background: rgba(72, 187, 120, 0.15);
    border: 1px solid rgba(72, 187, 120, 0.3);
    color: #68d391;
}

.alert-icon {
    font-size: 1.5rem;
    font-weight: bold;
}

.sessions-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-mini-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(0, 191, 255, 0.2);
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1.25rem;
    transition: all 0.3s ease;
}

.stat-mini-card:hover {
    transform: translateY(-5px);
    border-color: rgba(0, 191, 255, 0.4);
    box-shadow: 0 10px 30px rgba(0, 191, 255, 0.2);
}

.stat-mini-icon {
    font-size: 2.5rem;
    filter: drop-shadow(0 0 10px rgba(0, 191, 255, 0.3));
}

.stat-mini-value {
    font-size: 2rem;
    font-weight: 900;
    color: #00bfff;
    font-family: 'Orbitron', sans-serif;
}

.stat-mini-label {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.875rem;
}

.sessions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: 2rem;
}

.session-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.session-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #00bfff, #667eea);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.session-card:hover::before {
    opacity: 1;
}

.session-card:hover {
    transform: translateY(-8px);
    border-color: rgba(0, 191, 255, 0.3);
    box-shadow: 0 15px 40px rgba(0, 191, 255, 0.25);
}

.session-card[data-intensity="high"]::before {
    background: linear-gradient(90deg, #f56565, #ed8936);
}

.session-card[data-intensity="moderate"]::before {
    background: linear-gradient(90deg, #ed8936, #ecc94b);
}

.session-card[data-intensity="low"]::before {
    background: linear-gradient(90deg, #48bb78, #68d391);
}

.session-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.session-type {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.type-icon {
    font-size: 2rem;
    filter: drop-shadow(0 0 10px rgba(0, 191, 255, 0.3));
}

.session-type h3 {
    margin: 0;
    color: #fff;
    font-size: 1.5rem;
    font-weight: 700;
}

.intensity-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.intensity-low {
    background: rgba(72, 187, 120, 0.2);
    color: #68d391;
    border: 1px solid rgba(72, 187, 120, 0.3);
}

.intensity-moderate {
    background: rgba(237, 137, 54, 0.2);
    color: #f6ad55;
    border: 1px solid rgba(237, 137, 54, 0.3);
}

.intensity-high {
    background: rgba(245, 101, 101, 0.2);
    color: #fc8181;
    border: 1px solid rgba(245, 101, 101, 0.3);
}

.session-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
}

.meta-icon {
    font-size: 1.2rem;
}

.session-instructor {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: rgba(0, 191, 255, 0.1);
    border-radius: 10px;
    margin-bottom: 1rem;
    border: 1px solid rgba(0, 191, 255, 0.2);
}

.instructor-icon {
    font-size: 1.5rem;
}

.instructor-name {
    color: #00bfff;
    font-weight: 600;
}

.session-description {
    margin-bottom: 1rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 10px;
    border-left: 3px solid rgba(0, 191, 255, 0.5);
}

.session-description p {
    margin: 0;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
    line-height: 1.6;
}

.session-notes {
    display: flex;
    gap: 0.75rem;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 10px;
    margin-bottom: 1.5rem;
}

.notes-icon {
    font-size: 1.2rem;
}

.session-notes p {
    margin: 0;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    font-style: italic;
    line-height: 1.5;
}

.session-actions {
    display: flex;
    gap: 0.75rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.btn-action {
    flex: 1;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-edit {
    background: rgba(0, 191, 255, 0.15);
    color: #00bfff;
    border: 1px solid rgba(0, 191, 255, 0.3);
}

.btn-edit:hover {
    background: rgba(0, 191, 255, 0.25);
    border-color: rgba(0, 191, 255, 0.5);
    transform: translateY(-2px);
}

.btn-delete {
    background: rgba(245, 101, 101, 0.15);
    color: #fc8181;
    border: 1px solid rgba(245, 101, 101, 0.3);
}

.btn-delete:hover {
    background: rgba(245, 101, 101, 0.25);
    border-color: rgba(245, 101, 101, 0.5);
    transform: translateY(-2px);
}

.empty-state {
    text-align: center;
    padding: 5rem 2rem;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 24px;
    border: 2px dashed rgba(0, 191, 255, 0.2);
    backdrop-filter: blur(10px);
}

.empty-icon {
    font-size: 5rem;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 0 20px rgba(0, 191, 255, 0.3));
}

.empty-state h2 {
    font-family: 'Orbitron', sans-serif;
    font-size: 2rem;
    color: #00bfff;
    margin-bottom: 1rem;
}

.empty-state p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 1.1rem;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.btn-get-started {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #00bfff 0%, #667eea 100%);
    color: white;
    text-decoration: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 15px rgba(0, 191, 255, 0.3);
}

.btn-get-started:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 191, 255, 0.5);
}

.btn-logout {
    display: flex;
    align-items: center;
    padding: 1rem 1.25rem;
    color: rgba(255, 255, 255, 0.7);
    background: rgba(245, 101, 101, 0.1);
    border: 1px solid rgba(245, 101, 101, 0.2);
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    gap: 1rem;
    cursor: pointer;
    width: 100%;
    font-size: 1rem;
    font-weight: 600;
}

.btn-logout:hover {
    background: rgba(245, 101, 101, 0.2);
    color: white;
    border-color: rgba(245, 101, 101, 0.4);
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        align-items: stretch;
    }
    
    .sessions-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection