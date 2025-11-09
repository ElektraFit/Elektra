@extends('layouts.dashboard')

@section('title', 'Edit Training Session')

@vite(['resources/css/training-sessions.css'])

<x-training-sidebar />

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
@endsection
@endsection
