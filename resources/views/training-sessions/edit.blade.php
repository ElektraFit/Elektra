@extends('layouts.dashboard')

@section('title', 'Edit Training Session')

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
<div class="edit-session-page">
    <div class="page-header">
        <div class="header-content">
            <a href="{{ route('training-sessions.index') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Back to Sessions</span>
            </a>
            <h1 class="page-title">Edit Training Session</h1>
            <p class="page-subtitle">Update your workout details</p>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('training-sessions.update', $session) }}" method="POST" class="training-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- Training Type -->
                <div class="form-group full-width">
                    <label for="training_type" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        <span>Training Type</span>
                    </label>
                    <select name="training_type" id="training_type" class="form-control" required>
                        <option value="">Select training type</option>
                        <option value="cardio" {{ old('training_type', $session->training_type) == 'cardio' ? 'selected' : '' }}>Cardio</option>
                        <option value="strength" {{ old('training_type', $session->training_type) == 'strength' ? 'selected' : '' }}>Strength</option>
                        <option value="flexibility" {{ old('training_type', $session->training_type) == 'flexibility' ? 'selected' : '' }}>Flexibility</option>
                        <option value="hiit" {{ old('training_type', $session->training_type) == 'hiit' ? 'selected' : '' }}>HIIT</option>
                        <option value="sports" {{ old('training_type', $session->training_type) == 'sports' ? 'selected' : '' }}>Sports</option>
                        <option value="other" {{ old('training_type', $session->training_type) == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('training_type')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Date -->
                <div class="form-group compact">
                    <label for="session_date" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Date</span>
                    </label>
                    <input 
                        type="date" 
                        name="session_date" 
                        id="session_date" 
                        class="form-control" 
                        value="{{ old('session_date', $session->session_date->format('Y-m-d')) }}" 
                        required
                    >
                    @error('session_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Time -->
                <div class="form-group compact">
                    <label for="session_time" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span>Time</span>
                    </label>
                    <input 
                        type="time" 
                        name="session_time" 
                        id="session_time" 
                        class="form-control" 
                        value="{{ old('session_time', $session->session_time->format('H:i')) }}" 
                        required
                    >
                    @error('session_time')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Duration -->
                <div class="form-group compact">
                    <label for="duration" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <span>Duration</span>
                    </label>
                    <input 
                        type="number" 
                        name="duration" 
                        id="duration" 
                        class="form-control" 
                        value="{{ old('duration', $session->duration) }}" 
                        min="1" 
                        max="480"
                        placeholder="60 min"
                        required
                    >
                    @error('duration')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Intensity -->
                <div class="form-group compact">
                    <label for="intensity" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                        </svg>
                        <span>Intensity</span>
                    </label>
                    <input 
                        type="number" 
                        name="intensity" 
                        id="intensity" 
                        class="form-control" 
                        value="{{ old('intensity', $session->intensity) }}" 
                        min="1" 
                        max="10"
                        placeholder="1-10"
                        required
                    >
                    @error('intensity')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Instructor (optional) -->
                <div class="form-group full-width">
                    <label for="instructor_id" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Instructor (Optional)</span>
                    </label>
                    <select name="instructor_id" id="instructor_id" class="form-control">
                        <option value="">No instructor</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id', $session->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('instructor_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="form-group full-width">
                    <label for="notes" class="form-label">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        <span>Notes (Optional)</span>
                    </label>
                    <textarea 
                        name="notes" 
                        id="notes" 
                        class="form-control" 
                        rows="4" 
                        placeholder="Add any notes about your session..."
                    >{{ old('notes', $session->notes) }}</textarea>
                    @error('notes')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('training-sessions.index') }}" class="btn-secondary">
                    <span>Cancel</span>
                </a>
                <button type="submit" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>Update Session</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .edit-session-page {
        padding: 2rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 2.5rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 0.9375rem;
        margin-bottom: 1.5rem;
        transition: all 0.2s ease;
    }

    .back-link:hover {
        color: rgba(255, 255, 255, 0.9);
        transform: translateX(-4px);
    }

    .page-title {
        font-family: 'Orbitron', sans-serif;
        font-size: 2.25rem;
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

    .form-container {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .training-form {
        width: 100%;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.75rem;
        margin-bottom: 2rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group.compact {
        display: inline-block;
    }

    /* Compact grid for date, time, duration, intensity */
    .form-grid .form-group.compact {
        width: calc(25% - 1.3125rem);
        margin-right: 1.75rem;
        display: inline-flex;
        flex-direction: column;
        vertical-align: top;
    }

    .form-grid .form-group.compact:last-of-type {
        margin-right: 0;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0.75rem;
    }

    .form-label svg {
        color: rgba(102, 126, 234, 0.8);
        flex-shrink: 0;
    }

    .form-control {
        width: 100%;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.06);
        border: 1.5px solid rgba(255, 255, 255, 0.12);
        border-radius: 12px;
        color: white;
        font-size: 1rem;
        font-family: 'Inter', sans-serif;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(102, 126, 234, 0.5);
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L6 6L11 1' stroke='rgba(255,255,255,0.6)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 3rem;
    }

    select.form-control option {
        background: #1a1f3a;
        color: white;
        padding: 0.75rem;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
        font-family: 'Inter', sans-serif;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .error-message::before {
        content: "⚠";
        font-size: 1rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .btn-primary,
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.05);
        border: 1.5px solid rgba(255, 255, 255, 0.15);
        color: rgba(255, 255, 255, 0.8);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
    }

    @media (max-width: 768px) {
        .edit-session-page {
            padding: 1.5rem;
        }

        .form-container {
            padding: 1.75rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
