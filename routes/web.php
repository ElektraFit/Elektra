<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InstructorProfileController;

Route::get('/', function () {
    return view('hero');
})->name('welcome');

// Public pages
Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors');

// Authentication routes
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// OTP routes
Route::get('/otp/verify', function () {
    if (!Session::has('otp') || Session::get('otp_expires') < now()) {
        Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type']);
        return redirect()->route('login')->with('error', 'OTP expired or not found');
    }
    return view('auth.otp');
})->name('otp.verify');

Route::post('/otp/verify', [AuthController::class, 'verifyMemberOtp'])->name('otp.submit');

// Dashboard route
Route::get('/dashboard', function () {
    $user = Auth::user() ?? \App\Models\User::find(Session::get('user_id'));
    
    $stats = [
        'userName' => $user->name ?? 'Member',
        'totalHours' => 0,
        'totalSessions' => 0,
        'weekHours' => 0,
        'weekSessions' => 0,
        'sessions' => collect([]), // Initialize empty collection
    ];
    
    if ($user) {
        $sessions = \App\Models\TrainingSession::where('user_id', $user->id);
        $weekSessions = clone $sessions;
        
        $stats['totalMinutes'] = $sessions->sum('duration_minutes');
        $stats['totalHours'] = round($stats['totalMinutes'] / 60, 1);
        $stats['totalSessions'] = $sessions->count();
        
        $weekMinutes = $weekSessions->where('session_date', '>=', now()->startOfWeek())->sum('duration_minutes');
        $stats['weekHours'] = round($weekMinutes / 60, 1);
        $stats['weekSessions'] = $weekSessions->where('session_date', '>=', now()->startOfWeek())->count();
        
        // Get all training sessions for the training view
        $stats['sessions'] = \App\Models\TrainingSession::where('user_id', $user->id)
            ->orderBy('session_date', 'desc')
            ->get();
    }
    
    // Get all instructors for the instructors view
    $instructors = \App\Models\Instructor::orderBy('created_at', 'desc')->get()->map(function ($instructor) {
        $instructor->short_bio = \Illuminate\Support\Str::limit($instructor->bio, 100);
        return $instructor;
    });
    $stats['instructors'] = $instructors;
    
    return view('dashboard', $stats);
})->name('dashboard');

// Member logout route
Route::post('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect()->route('login')->with('status', 'Logged out successfully');
})->name('logout');

// Training Session routes (protected by auth middleware)
Route::middleware('auth')->group(function () {
    Route::get('/training-sessions', [App\Http\Controllers\TrainingSessionController::class, 'index'])->name('training-sessions.index');
    Route::get('/training-sessions/create', [App\Http\Controllers\TrainingSessionController::class, 'create'])->name('training-sessions.create');
    Route::post('/training-sessions', [App\Http\Controllers\TrainingSessionController::class, 'store'])->name('training-sessions.store');
    Route::get('/training-sessions/{trainingSession}/edit', [App\Http\Controllers\TrainingSessionController::class, 'edit'])->name('training-sessions.edit');
    Route::put('/training-sessions/{trainingSession}', [App\Http\Controllers\TrainingSessionController::class, 'update'])->name('training-sessions.update');
    Route::delete('/training-sessions/{trainingSession}', [App\Http\Controllers\TrainingSessionController::class, 'destroy'])->name('training-sessions.destroy');
    
    // Nutrition tracking routes
    Route::get('/nutrition', [App\Http\Controllers\NutritionController::class, 'index'])->name('nutrition.index');
    Route::post('/nutrition/search', [App\Http\Controllers\NutritionController::class, 'search'])->name('nutrition.search');
    Route::post('/nutrition/meals', [App\Http\Controllers\NutritionController::class, 'store'])->name('nutrition.store');
    Route::delete('/nutrition/meals/{meal}', [App\Http\Controllers\NutritionController::class, 'destroy'])->name('nutrition.destroy');
});

// Instructor routes
Route::get('/instructor/login', fn() => view('instructor.login'))->name('instructor.login');
Route::post('/instructor/login', [AuthController::class, 'instructorLogin'])->name('instructor.login.submit');

// Multi-step instructor registration
Route::get('/instructor/register', fn() => view('instructor.register'))->name('instructor.register');
Route::post('/instructor/register/step1', [AuthController::class, 'instructorRegisterStep1'])->name('instructor.register.step1');

Route::get('/instructor/register/step2', [AuthController::class, 'showInstructorRegisterStep2'])->name('instructor.register.step2.form');
Route::post('/instructor/register/step2', [AuthController::class, 'instructorRegisterStep2'])->name('instructor.register.step2');

Route::get('/instructor/register/step3', [AuthController::class, 'showInstructorRegisterStep3'])->name('instructor.register.step3.form');
Route::post('/instructor/register/step3', [AuthController::class, 'instructorRegisterStep3'])->name('instructor.register.step3');

Route::get('/instructor/register/step4', [AuthController::class, 'showInstructorRegisterStep4'])->name('instructor.register.step4.form');
Route::post('/instructor/register/step4', [AuthController::class, 'instructorRegisterStep4'])->name('instructor.register.step4');

Route::get('/instructor/register/step5', [AuthController::class, 'showInstructorRegisterStep5'])->name('instructor.register.step5.form');
Route::post('/instructor/register/step5', [AuthController::class, 'instructorRegisterStep5'])->name('instructor.register.step5');

Route::get('/instructor/register/complete', [AuthController::class, 'showInstructorRegisterComplete'])->name('instructor.register.complete');

// Old single-step registration (keeping for backwards compatibility)
Route::post('/instructor/register', [AuthController::class, 'instructorRegister'])->name('instructor.register.submit');

Route::get('/instructor/otp', function () {
    if (!Session::has('instructor_otp') || Session::get('instructor_otp_expires') < now()) {
        Session::forget(['instructor_otp', 'instructor_otp_email', 'instructor_otp_expires', 'instructor_otp_type']);
        return redirect()->route('instructor.login')->with('error', 'OTP expired or not found');
    }
    return view('instructor.otp');
})->name('instructor.otp');

Route::post('/instructor/otp', [AuthController::class, 'verifyInstructorOtp'])->name('instructor.otp.verify');

Route::get('/instructor/dashboard', function () {
    if (!Session::has('instructor_id')) {
        return redirect()->route('instructor.login');
    }
    $instructor = \App\Models\Instructor::find(Session::get('instructor_id'));
    return view('instructor.dashboard', compact('instructor'));
})->name('instructor.dashboard');

// Instructor profile routes
Route::get('/instructor/profile', [InstructorProfileController::class, 'show'])->name('instructor.profile');
Route::post('/instructor/profile/photo', [InstructorProfileController::class, 'uploadPhoto'])->name('instructor.profile.photo.upload');
Route::delete('/instructor/profile/photo', [InstructorProfileController::class, 'deletePhoto'])->name('instructor.profile.photo.delete');

Route::post('/instructor/logout', function () {
    Session::forget(['instructor_id', 'instructor_name']);
    return redirect()->route('instructor.login')->with('status', 'Logged out successfully');
})->name('instructor.logout');
