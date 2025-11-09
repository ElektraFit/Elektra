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
        $sessions = Auth::user()->trainingSessions()
            ->with('instructor')
            ->orderBy('session_date', 'desc')
            ->orderBy('session_time', 'desc')
            ->get();
        
        return view('training-sessions.index', compact('sessions'));
    }

    public function create()
    {
        $instructors = Instructor::all();
        return view('training-sessions.create', compact('instructors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'training_type' => 'required|string|max:255',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'duration' => 'required|integer|min:1|max:480',
            'intensity' => 'required|integer|min:1|max:10',
            'instructor_id' => 'nullable|exists:instructors,id',
            'notes' => 'nullable|string'
        ]);

        // Map form fields to database fields
        TrainingSession::create([
            'user_id' => Auth::id(),
            'instructor_id' => $validated['instructor_id'] ?? null,
            'training_type' => $validated['training_type'],
            'duration_minutes' => $validated['duration'],
            'session_date' => $validated['session_date'],
            'session_time' => $validated['session_time'],
            'intensity' => $this->mapIntensityToEnum($validated['intensity']),
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('training-sessions.index')
            ->with('success', 'Training session logged successfully!');
    }

    public function edit(TrainingSession $trainingSession)
    {
        // Ensure user can only edit their own sessions
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $instructors = Instructor::all();
        return view('training-sessions.edit', compact('trainingSession', 'instructors'));
    }

    public function update(Request $request, TrainingSession $trainingSession)
    {
        // Ensure user can only update their own sessions
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'training_type' => 'required|string|max:255',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'duration' => 'required|integer|min:1|max:480',
            'intensity' => 'required|integer|min:1|max:10',
            'instructor_id' => 'nullable|exists:instructors,id',
            'notes' => 'nullable|string'
        ]);

        // Map form fields to database fields
        $trainingSession->update([
            'instructor_id' => $validated['instructor_id'] ?? null,
            'training_type' => $validated['training_type'],
            'duration_minutes' => $validated['duration'],
            'session_date' => $validated['session_date'],
            'session_time' => $validated['session_time'],
            'intensity' => $this->mapIntensityToEnum($validated['intensity']),
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('training-sessions.index')
            ->with('success', 'Training session updated successfully!');
    }

    public function destroy(TrainingSession $trainingSession)
    {
        // Ensure user can only delete their own sessions
        if ($trainingSession->user_id !== Auth::id()) {
            abort(403);
        }

        $trainingSession->delete();

        return redirect()->route('training-sessions.index')
            ->with('success', 'Training session deleted successfully!');
    }

    /**
     * Map numeric intensity (1-10) to enum values (low, moderate, high)
     */
    private function mapIntensityToEnum(int $intensity): string
    {
        if ($intensity <= 3) {
            return 'low';
        } elseif ($intensity <= 7) {
            return 'moderate';
        } else {
            return 'high';
        }
    }
}
