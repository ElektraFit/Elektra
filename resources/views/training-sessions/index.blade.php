@extends('layouts.dashboard')

@section('title', 'My Training Sessions')

@section('content')
<div class="training-sessions-container">
    <div class="header-section">
        <h1>My Training Sessions</h1>
        <a href="{{ route('training-sessions.create') }}" class="btn btn-primary">
            <span>+ Log New Session</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($sessions->count() > 0)
        <div class="sessions-grid">
            @foreach($sessions as $session)
                <div class="session-card">
                    <div class="session-header">
                        <h3>{{ $session->training_type }}</h3>
                        <span class="intensity-badge intensity-{{ $session->intensity }}">
                            {{ ucfirst($session->intensity) }}
                        </span>
                    </div>
                    
                    <div class="session-details">
                        <div class="detail-row">
                            <span class="label">Date:</span>
                            <span class="value">{{ $session->session_date->format('M d, Y') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Time:</span>
                            <span class="value">{{ \Carbon\Carbon::parse($session->session_time)->format('h:i A') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Duration:</span>
                            <span class="value">{{ $session->duration_minutes }} minutes</span>
                        </div>
                        @if($session->instructor)
                            <div class="detail-row">
                                <span class="label">Instructor:</span>
                                <span class="value">{{ $session->instructor->name }}</span>
                            </div>
                        @endif
                        @if($session->description)
                            <div class="detail-row">
                                <span class="label">Description:</span>
                                <span class="value">{{ $session->description }}</span>
                            </div>
                        @endif
                        @if($session->notes)
                            <div class="detail-row">
                                <span class="label">Notes:</span>
                                <span class="value">{{ $session->notes }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="session-actions">
                        <a href="{{ route('training-sessions.edit', $session) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('training-sessions.destroy', $session) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this session?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p>No training sessions logged yet.</p>
            <a href="{{ route('training-sessions.create') }}" class="btn btn-primary">Log Your First Session</a>
        </div>
    @endif
</div>

<style>
.training-sessions-container {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.header-section h1 {
    font-size: 2rem;
    color: #fff;
    margin: 0;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: #4a5568;
    color: white;
}

.btn-secondary:hover {
    background: #2d3748;
}

.btn-danger {
    background: #e53e3e;
    color: white;
}

.btn-danger:hover {
    background: #c53030;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.alert-success {
    background: rgba(72, 187, 120, 0.1);
    border: 1px solid #48bb78;
    color: #48bb78;
}

.sessions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.session-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 1.5rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.session-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.session-header h3 {
    margin: 0;
    color: #fff;
    font-size: 1.25rem;
}

.intensity-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.intensity-low {
    background: rgba(72, 187, 120, 0.2);
    color: #48bb78;
}

.intensity-moderate {
    background: rgba(237, 137, 54, 0.2);
    color: #ed8936;
}

.intensity-high {
    background: rgba(245, 101, 101, 0.2);
    color: #f56565;
}

.session-details {
    margin-bottom: 1rem;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    color: rgba(255, 255, 255, 0.8);
}

.detail-row .label {
    font-weight: 600;
}

.session-actions {
    display: flex;
    gap: 0.5rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.empty-state p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.125rem;
    margin-bottom: 1.5rem;
}
</style>
@endsection
