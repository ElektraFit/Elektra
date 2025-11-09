<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('hero');
});

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
    // Get userName from authenticated user or session
    $userName = 'Member';
    
    if (Auth::check()) {
        $userName = Auth::user()->name;
    } elseif (Session::has('user_id')) {
        $user = \App\Models\User::find(Session::get('user_id'));
        if ($user) {
            $userName = $user->name;
        }
    }
    
    return view('dashboard', ['userName' => $userName]);
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
    return view('instructor.dashboard');
})->name('instructor.dashboard');

Route::post('/instructor/logout', function () {
    Session::forget(['instructor_id', 'instructor_name']);
    return redirect()->route('instructor.login')->with('status', 'Logged out successfully');
})->name('instructor.logout');
