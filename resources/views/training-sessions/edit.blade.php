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
<div class="form-container">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Training Session</h1>
            <p class="page-subtitle">Update your workout details</p>
        </div>
        <a href="{{ route('training-sessions.index') }}" class="btn-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            <span>Back to Sessions</span>
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('training-sessions.update', $trainingSession) }}" method="POST" class="training-form">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h3 class="section-title">Workout Details</h3>
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="training_type">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                        </svg>
                        Training Type
                        <span class="required">*</span>
                    </label>
                    <select name="training_type" id="training_type" class="form-control" required>
                        <option value="">Select training type</option>
                        <option value="Cardio" {{ old('training_type', $trainingSession->training_type) == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                        <option value="Strength Training" {{ old('training_type', $trainingSession->training_type) == 'Strength Training' ? 'selected' : '' }}>Strength Training</option>
                        <option value="Yoga" {{ old('training_type', $trainingSession->training_type) == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                        <option value="Pilates" {{ old('training_type', $trainingSession->training_type) == 'Pilates' ? 'selected' : '' }}>Pilates</option>
                        <option value="CrossFit" {{ old('training_type', $trainingSession->training_type) == 'CrossFit' ? 'selected' : '' }}>CrossFit</option>
                        <option value="HIIT" {{ old('training_type', $trainingSession->training_type) == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                        <option value="Boxing" {{ old('training_type', $trainingSession->training_type) == 'Boxing' ? 'selected' : '' }}>Boxing</option>
                        <option value="Swimming" {{ old('training_type', $trainingSession->training_type) == 'Swimming' ? 'selected' : '' }}>Swimming</option>
                        <option value="Cycling" {{ old('training_type', $trainingSession->training_type) == 'Cycling' ? 'selected' : '' }}>Cycling</option>
                        <option value="Running" {{ old('training_type', $trainingSession->training_type) == 'Running' ? 'selected' : '' }}>Running</option>
                        <option value="Other" {{ old('training_type', $trainingSession->training_type) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('training_type')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="session_date">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Date
                        <span class="required">*</span>
                    </label>
                    <input type="date" name="session_date" id="session_date" class="form-control" value="{{ old('session_date', $trainingSession->session_date->format('Y-m-d')) }}" required>
                    @error('session_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="session_time">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Time
                        <span class="required">*</span>
                    </label>
                    <input type="time" name="session_time" id="session_time" class="form-control" value="{{ old('session_time', \Carbon\Carbon::parse($trainingSession->session_time)->format('H:i')) }}" required>
                    @error('session_time')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="duration_minutes">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        Duration (minutes)
                        <span class="required">*</span>
                    </label>
                    <input type="number" name="duration_minutes" id="duration_minutes" class="form-control" value="{{ old('duration_minutes', $trainingSession->duration_minutes) }}" min="1" required>
                    @error('duration_minutes')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="intensity">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
                        </svg>
                        Intensity
                        <span class="required">*</span>
                    </label>
                    <select name="intensity" id="intensity" class="form-control" required>
                        <option value="low" {{ old('intensity', $trainingSession->intensity) == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="moderate" {{ old('intensity', $trainingSession->intensity) == 'moderate' ? 'selected' : '' }}>Moderate</option>
                        <option value="high" {{ old('intensity', $trainingSession->intensity) == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('intensity')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="section-title">Additional Information</h3>
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="instructor_id">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Instructor
                        <span class="optional">(Optional)</span>
                    </label>
                    <select name="instructor_id" id="instructor_id" class="form-control">
                        <option value="">No instructor</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ old('instructor_id', $trainingSession->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                {{ $instructor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('instructor_id')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="description">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="17" y1="10" x2="3" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="17" y1="18" x2="3" y2="18"></line>
                        </svg>
                        Description
                    </label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $trainingSession->description) }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="notes">
                        <svg class="label-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                        Notes
                    </label>
                    <textarea name="notes" id="notes" class="form-control" rows="4">{{ old('notes', $trainingSession->notes) }}</textarea>
                    @error('notes')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('training-sessions.index') }}" class="btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
                <span>Cancel</span>
            </a>
            <button type="submit" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Update Session</span>
            </button>
        </div>
    </form>
</div>
@endsection

@section('extra-styles')
<style>
/* Container */
.form-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    gap: 2rem;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 0.5rem 0;
    letter-spacing: -0.02em;
}

.page-subtitle {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    background: rgba(255, 255, 255, 0.05);
    color: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    font-weight: 500;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border-color: rgba(255, 255, 255, 0.2);
}

/* Form */
.training-form {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    overflow: hidden;
}

.form-section {
    padding: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.form-section:last-of-type {
    border-bottom: none;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #fff;
    margin: 0 0 1.5rem 0;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.label-icon {
    color: rgba(255, 255, 255, 0.5);
    flex-shrink: 0;
}

.required {
    color: #ef4444;
}

.optional {
    color: rgba(255, 255, 255, 0.4);
    font-weight: 400;
    font-size: 0.75rem;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1rem;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    color: #fff;
    font-size: 0.9375rem;
    font-family: inherit;
    transition: all 0.2s ease;
}

.form-control:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.08);
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

select.form-control {
    cursor: pointer;
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
    line-height: 1.6;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    margin-top: 0.5rem;
    color: #ef4444;
    font-size: 0.8125rem;
}

.error-message::before {
    content: "!";
    display: flex;
    align-items: center;
    justify-content: center;
    width: 16px;
    height: 16px;
    background: rgba(239, 68, 68, 0.15);
    border-radius: 50%;
    font-weight: 700;
    font-size: 0.75rem;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding: 1.5rem 2rem;
    background: rgba(255, 255, 255, 0.02);
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.05);
    color: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    border-color: rgba(255, 255, 255, 0.2);
}

.btn-primary svg,
.btn-secondary svg {
    flex-shrink: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-container {
        padding: 1rem;
    }

    .page-header {
        flex-direction: column;
        gap: 1rem;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-section {
        padding: 1.5rem;
    }

    .form-actions {
        flex-direction: column-reverse;
        padding: 1rem 1.5rem;
    }

    .btn-primary,
    .btn-secondary {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
