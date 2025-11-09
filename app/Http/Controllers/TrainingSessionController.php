<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingSessionController extends Controller
{
    public function index()
    {
        $sessions = Auth::user()
            ->trainingSessions()
            ->with('instructor')
            ->latest('session_date')
            ->latest('session_time')
            ->get();
        
        return view('training-sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('training-sessions.create', [
            'instructors' => Instructor::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'training_type' => 'required|string',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'duration' => 'required|integer|min:1',
            'intensity' => 'required|integer|min:1|max:10',
            'instructor_id' => 'nullable|exists:instructors,id',
            'notes' => 'nullable|string'
        ]);

        Auth::user()->trainingSessions()->create([
            'training_type' => $validated['training_type'],
            'duration_minutes' => $validated['duration'],
            'session_date' => $validated['session_date'],
            'session_time' => $validated['session_time'],
            'intensity' => $this->mapIntensity($validated['intensity']),
            'instructor_id' => $validated['instructor_id'],
            'notes' => $validated['notes'],
        ]);

        return redirect()
            ->route('training-sessions.index')
            ->with('success', 'Training session logged successfully!');
    }

    public function edit(TrainingSession $trainingSession)
    {
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        return view('training-sessions.edit', [
            'session' => $trainingSession,
            'instructors' => Instructor::all()
        ]);
    }

    public function update(Request $request, TrainingSession $trainingSession)
    {
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'training_type' => 'required|string',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'duration' => 'required|integer|min:1',
            'intensity' => 'required|integer|min:1|max:10',
            'instructor_id' => 'nullable|exists:instructors,id',
            'notes' => 'nullable|string'
        ]);

        $trainingSession->update([
            'training_type' => $validated['training_type'],
            'duration_minutes' => $validated['duration'],
            'session_date' => $validated['session_date'],
            'session_time' => $validated['session_time'],
            'intensity' => $this->mapIntensity($validated['intensity']),
            'instructor_id' => $validated['instructor_id'],
            'notes' => $validated['notes'],
        ]);

        return redirect()
            ->route('training-sessions.index')
            ->with('success', 'Training session updated successfully!');
    }

    public function destroy(TrainingSession $trainingSession)
    {
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }
        
        $trainingSession->delete();

        return redirect()
            ->route('training-sessions.index')
            ->with('success', 'Training session deleted successfully!');
    }

    private function mapIntensity(int $intensity): string
    {
        return match(true) {
            $intensity <= 3 => 'low',
            $intensity <= 7 => 'moderate',
            default => 'high'
        };
    }
}
