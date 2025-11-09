@extends('layouts.dashboard')

@section('title', 'Log Training Session')

@section('content')
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
