@extends('layouts.dashboard')

@section('title', 'Log New Training Session')

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
        <x-nav-item href="{{ route('instructors') }}" label="Instructors">
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
<div class="create-session-page">
    <div class="page-header">
        <div class="header-content">
            <a href="{{ route('training-sessions.index') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Back to Sessions</span>
            </a>
            <h1 class="page-title">Log New Training Session</h1>
            <p class="page-subtitle">Record your workout details and track your progress</p>
        </div>
    </div>

    <div class="form-container">
        <form action="{{ route('training-sessions.store') }}" method="POST" class="training-form">
            @csrf

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
                        <option value="cardio" {{ old('training_type') == 'cardio' ? 'selected' : '' }}>Cardio</option>
                        <option value="strength" {{ old('training_type') == 'strength' ? 'selected' : '' }}>Strength</option>
                        <option value="flexibility" {{ old('training_type') == 'flexibility' ? 'selected' : '' }}>Flexibility</option>
                        <option value="hiit" {{ old('training_type') == 'hiit' ? 'selected' : '' }}>HIIT</option>
                        <option value="sports" {{ old('training_type') == 'sports' ? 'selected' : '' }}>Sports</option>
                        <option value="other" {{ old('training_type') == 'other' ? 'selected' : '' }}>Other</option>
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
                        value="{{ old('session_date', date('Y-m-d')) }}" 
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
                        value="{{ old('session_time', date('H:i')) }}" 
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
                        value="{{ old('duration') }}" 
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
                        value="{{ old('intensity', 5) }}" 
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
                            <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
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
                    >{{ old('notes') }}</textarea>
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
                    <span>Log Session</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
