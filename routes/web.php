<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('hero');
});

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    // Store login attempt in session for 2FA
    Session::put('login_attempt', [
        'email' => $request->email,
        'password' => $request->password,
        'remember' => $request->has('remember')
    ]);
    
    // Generate and send OTP
    $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    Session::put('otp', $otp);
    Session::put('otp_email', $request->email);
    Session::put('otp_expires', now()->addMinutes(5));
    
    // Send OTP email (in a real app, you'd use a proper mail service)
    // For now, we'll just store it in session
    
    return redirect()->route('otp.verify')->with('status', 'OTP sent to your email');
})->name('login.submit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    
    // Store registration data in session for 2FA
    Session::put('registration_data', [
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);
    
    // Generate and send OTP
    $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
    Session::put('otp', $otp);
    Session::put('otp_email', $request->email);
    Session::put('otp_expires', now()->addMinutes(5));
    Session::put('otp_type', 'registration');
    
    return redirect()->route('otp.verify')->with('status', 'OTP sent to your email for verification');
})->name('register.submit');

// OTP routes
Route::get('/otp/verify', function () {
    if (!Session::has('otp')) {
        return redirect()->route('login')->with('error', 'No OTP session found');
    }
    
    if (Session::get('otp_expires') < now()) {
        Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type']);
        return redirect()->route('login')->with('error', 'OTP expired');
    }
    
    return view('auth.otp');
})->name('otp.verify');

Route::post('/otp/verify', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required|digits:4',
    ]);
    
    if (!Session::has('otp') || Session::get('otp_expires') < now()) {
        return redirect()->route('login')->with('error', 'OTP expired');
    }
    
    if (Session::get('otp') !== $request->otp || Session::get('otp_email') !== $request->email) {
        return back()->withErrors(['otp' => 'Invalid OTP']);
    }
    
    // OTP verified successfully
    $otpType = Session::get('otp_type', 'login');
    
    if ($otpType === 'registration') {
        // Complete registration
        $registrationData = Session::get('registration_data');
        
        // In a real app, you'd create the user here
        // User::create($registrationData);
        
        Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type', 'registration_data']);
        
        return redirect()->route('homepage.success')->with('status', 'Registration successful!');
    } else {
        // Complete login
        $loginAttempt = Session::get('login_attempt');
        
        // In a real app, you'd authenticate the user here
        // Auth::attempt($loginAttempt);
        
        Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type', 'login_attempt']);
        
        return redirect()->route('homepage.success')->with('status', 'Login successful!');
    }
})->name('otp.submit');

// Homepage success route
Route::get('/homepage/success', function () {
    return view('homepagesuccess');
})->name('homepage.success');
