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
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'intensity' => 'required|in:low,moderate,high',
            'instructor_id' => 'nullable|exists:instructors,id',
            'notes' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();

        TrainingSession::create($validated);

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
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'intensity' => 'required|in:low,moderate,high',
            'instructor_id' => 'nullable|exists:instructors,id',
            'notes' => 'nullable|string'
        ]);

        $trainingSession->update($validated);

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
}
