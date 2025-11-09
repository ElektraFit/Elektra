@extends('layouts.dashboard')

@section('title', 'Log Training Session')

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
<div class="form-page">
    <div class="page-header">
        <div class="header-content">
            <a href="{{ route('training-sessions.index') }}" class="btn-back">
                <span>←</span> Back to Sessions
            </a>
            <h1 class="page-title">
                <span class="title-icon">📝</span>
                Log Training Session
            </h1>
            <p class="page-subtitle">Record your workout details and track your progress</p>
        </div>
    </div>

    <form action="{{ route('training-sessions.store') }}" method="POST" class="training-form">
        @csrf

        <div class="form-section">
            <h2 class="section-title">
                <span class="section-icon">🏋️</span>
                Workout Details
            </h2>

            <div class="form-group">
                <label for="training_type">
                    <span class="label-icon">🎯</span>
                    Training Type *
                </label>
                <select name="training_type" id="training_type" required>
                    <option value="">Select training type...</option>
                    <option value="Cardio" {{ old('training_type') == 'Cardio' ? 'selected' : '' }}>🏃 Cardio</option>
                    <option value="Strength Training" {{ old('training_type') == 'Strength Training' ? 'selected' : '' }}>🏋️ Strength Training</option>
                    <option value="Yoga" {{ old('training_type') == 'Yoga' ? 'selected' : '' }}>🧘 Yoga</option>
                    <option value="Pilates" {{ old('training_type') == 'Pilates' ? 'selected' : '' }}>🤸 Pilates</option>
                    <option value="CrossFit" {{ old('training_type') == 'CrossFit' ? 'selected' : '' }}>⚡ CrossFit</option>
                    <option value="HIIT" {{ old('training_type') == 'HIIT' ? 'selected' : '' }}>🔥 HIIT</option>
                    <option value="Boxing" {{ old('training_type') == 'Boxing' ? 'selected' : '' }}>🥊 Boxing</option>
                    <option value="Swimming" {{ old('training_type') == 'Swimming' ? 'selected' : '' }}>🏊 Swimming</option>
                    <option value="Cycling" {{ old('training_type') == 'Cycling' ? 'selected' : '' }}>🚴 Cycling</option>
                    <option value="Running" {{ old('training_type') == 'Running' ? 'selected' : '' }}>🏃 Running</option>
                    <option value="Other" {{ old('training_type') == 'Other' ? 'selected' : '' }}>💪 Other</option>
                </select>
                @error('training_type')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="session_date">
                        <span class="label-icon">📅</span>
                        Date *
                    </label>
                    <input type="date" name="session_date" id="session_date" value="{{ old('session_date', date('Y-m-d')) }}" required>
                    @error('session_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="session_time">
                        <span class="label-icon">🕐</span>
                        Time *
                    </label>
                    <input type="time" name="session_time" id="session_time" value="{{ old('session_time') }}" required>
                    @error('session_time')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="duration_minutes">
                        <span class="label-icon">⏲️</span>
                        Duration (minutes) *
                    </label>
                    <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes') }}" min="1" placeholder="e.g., 45" required>
                    @error('duration_minutes')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="intensity">
                        <span class="label-icon">🔥</span>
                        Intensity *
                    </label>
                    <select name="intensity" id="intensity" required>
                        <option value="low" {{ old('intensity') == 'low' ? 'selected' : '' }}>😌 Low</option>
                        <option value="moderate" {{ old('intensity', 'moderate') == 'moderate' ? 'selected' : '' }}>💪 Moderate</option>
                        <option value="high" {{ old('intensity') == 'high' ? 'selected' : '' }}>🔥 High</option>
                    </select>
                    @error('intensity')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="instructor_id">
                    <span class="label-icon">👤</span>
                    Instructor (Optional)
                </label>
                <select name="instructor_id" id="instructor_id">
                    <option value="">No instructor / Self-training</option>
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
        </div>

        <div class="form-section">
            <h2 class="section-title">
                <span class="section-icon">📝</span>
                Additional Information
            </h2>

            <div class="form-group">
                <label for="description">
                    <span class="label-icon">📄</span>
                    Description
                </label>
                <textarea name="description" id="description" rows="3" placeholder="Brief description of your workout (e.g., '5km morning run', '30 min upper body workout')">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes">
                    <span class="label-icon">💬</span>
                    Notes
                </label>
                <textarea name="notes" id="notes" rows="4" placeholder="How did you feel? Any achievements or challenges? Personal reflections...">{{ old('notes') }}</textarea>
                @error('notes')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('training-sessions.index') }}" class="btn btn-secondary">
                <span>✕</span> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <span>✓</span> Log Session
            </button>
        </div>
    </form>
</div>

<style>
.form-page {
    max-width: 900px;
    margin: 0 auto;
}

.page-header {
    margin-bottom: 2.5rem;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.6);
    text-decoration: none;
    font-size: 0.95rem;
    margin-bottom: 1.5rem;
    transition: color 0.3s ease;
}

.btn-back:hover {
    color: #00bfff;
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
    font-size: 1.05rem;
    margin: 0;
}

.training-form {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.form-section {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(0, 191, 255, 0.2);
    border-radius: 20px;
    padding: 2.5rem;
    transition: all 0.3s ease;
}

.form-section:hover {
    border-color: rgba(0, 191, 255, 0.3);
    box-shadow: 0 10px 30px rgba(0, 191, 255, 0.15);
}

.section-title {
    font-family: 'Orbitron', sans-serif;
    font-size: 1.5rem;
    color: #fff;
    margin: 0 0 2rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid rgba(0, 191, 255, 0.2);
}

.section-icon {
    font-size: 1.75rem;
    filter: drop-shadow(0 0 10px rgba(0, 191, 255, 0.3));
}

.form-group {
    margin-bottom: 1.75rem;
}

.form-group:last-child {
    margin-bottom: 0;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #fff;
    font-weight: 600;
    font-size: 0.95rem;
    margin-bottom: 0.75rem;
}

.label-icon {
    font-size: 1.2rem;
}

input[type="text"],
input[type="date"],
input[type="time"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 1rem 1.25rem;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    color: #fff;
    font-size: 1rem;
    font-family: inherit;
    transition: all 0.3s ease;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: #00bfff;
    background: rgba(255, 255, 255, 0.12);
    box-shadow: 0 0 0 3px rgba(0, 191, 255, 0.1);
}

input::placeholder,
textarea::placeholder {
    color: rgba(255, 255, 255, 0.4);
}

select {
    cursor: pointer;
}

textarea {
    resize: vertical;
    min-height: 100px;
    line-height: 1.6;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #fc8181;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.error-message::before {
    content: '⚠️';
    font-size: 1rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 1rem;
}

.btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    cursor: pointer;
    text-decoration: none;
}

.btn span {
    font-size: 1.2rem;
}

.btn-primary {
    background: linear-gradient(135deg, #00bfff 0%, #667eea 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 191, 255, 0.3);
    border: 1px solid rgba(0, 191, 255, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 191, 255, 0.5);
}

.btn-secondary {
    background: rgba(255, 255, 255, 0.05);
    color: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border-color: rgba(255, 255, 255, 0.3);
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
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-section {
        padding: 1.5rem;
    }
}
</style>
@endsection

<div class="form-container">
    <div class="form-header">
        <h1>Log Training Session</h1>
        <a href="{{ route('training-sessions.index') }}" class="btn-back">← Back to Sessions</a>
    </div>

    <form action="{{ route('training-sessions.store') }}" method="POST" class="training-form">
        @csrf

        <div class="form-group">
            <label for="training_type">Training Type *</label>
            <select name="training_type" id="training_type" required>
                <option value="">Select training type</option>
                <option value="Cardio" {{ old('training_type') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                <option value="Strength Training" {{ old('training_type') == 'Strength Training' ? 'selected' : '' }}>Strength Training</option>
                <option value="Yoga" {{ old('training_type') == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                <option value="Pilates" {{ old('training_type') == 'Pilates' ? 'selected' : '' }}>Pilates</option>
                <option value="CrossFit" {{ old('training_type') == 'CrossFit' ? 'selected' : '' }}>CrossFit</option>
                <option value="HIIT" {{ old('training_type') == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                <option value="Boxing" {{ old('training_type') == 'Boxing' ? 'selected' : '' }}>Boxing</option>
                <option value="Swimming" {{ old('training_type') == 'Swimming' ? 'selected' : '' }}>Swimming</option>
                <option value="Cycling" {{ old('training_type') == 'Cycling' ? 'selected' : '' }}>Cycling</option>
                <option value="Running" {{ old('training_type') == 'Running' ? 'selected' : '' }}>Running</option>
                <option value="Other" {{ old('training_type') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('training_type')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="session_date">Date *</label>
                <input type="date" name="session_date" id="session_date" value="{{ old('session_date', date('Y-m-d')) }}" required>
                @error('session_date')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="session_time">Time *</label>
                <input type="time" name="session_time" id="session_time" value="{{ old('session_time') }}" required>
                @error('session_time')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="duration_minutes">Duration (minutes) *</label>
                <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes') }}" min="1" required>
                @error('duration_minutes')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="intensity">Intensity *</label>
                <select name="intensity" id="intensity" required>
                    <option value="low" {{ old('intensity') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="moderate" {{ old('intensity', 'moderate') == 'moderate' ? 'selected' : '' }}>Moderate</option>
                    <option value="high" {{ old('intensity') == 'high' ? 'selected' : '' }}>High</option>
                </select>
                @error('intensity')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="instructor_id">Instructor (Optional)</label>
            <select name="instructor_id" id="instructor_id">
                <option value="">No instructor</option>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                        {{ $instructor->name }}
                    </option>
                @endforeach
            </select>
            @error('instructor_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" placeholder="Brief description of your workout">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" rows="4" placeholder="How did you feel? Any achievements or challenges?">{{ old('notes') }}</textarea>
            @error('notes')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('training-sessions.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Log Session</button>
        </div>
    </form>
</div>

<style>
.form-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
}

.form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.form-header h1 {
    color: #fff;
    margin: 0;
}

.btn-back {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: color 0.3s;
}

.btn-back:hover {
    color: #fff;
}

.training-form {
    background: rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

label {
    display: block;
    color: #fff;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

input[type="text"],
input[type="date"],
input[type="time"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: #fff;
    font-size: 1rem;
}

input:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: #667eea;
}

textarea {
    resize: vertical;
    font-family: inherit;
}

.error {
    color: #f56565;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
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
</style>
@endsection
