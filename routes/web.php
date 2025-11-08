<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\OtpMail;

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
    
    // Send OTP email
    try {
        Mail::to($request->email)->send(new OtpMail($otp));
        return redirect()->route('otp.verify')->with('status', 'OTP sent to your email');
    } catch (\Exception $e) {
        return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
    }
})->name('login.submit');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
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
    
    // Send OTP email
    try {
        Mail::to($request->email)->send(new OtpMail($otp, $request->name));
        return redirect()->route('otp.verify')->with('status', 'OTP sent to your email for verification');
    } catch (\Exception $e) {
        return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
    }
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
    $userName = null;
    
    if ($otpType === 'registration') {
        // Complete registration
        $registrationData = Session::get('registration_data');
        $userName = Session::get('registration_data')['name'] ?? 'Member';
        
        try {
            // Create the user in the database
            $user = \App\Models\User::create($registrationData);
            
            // Log the user in
            Auth::login($user);
            
            // Store user ID in session for persistence
            Session::put('user_id', $user->id);
            
            Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type', 'registration_data']);
            
            return redirect()->route('homepage.success')->with('status', 'Registration successful!');
        } catch (\Exception $e) {
            Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type']);
            return redirect()->route('register')->withErrors(['email' => 'Registration failed. Email may already exist.']);
        }
    } else {
        // Complete login
        $loginAttempt = Session::get('login_attempt');
        $email = Session::get('otp_email');
        
        // Get user from database
        $user = \App\Models\User::where('email', $email)->first();
        
        if ($user) {
            // Log the user in
            Auth::login($user);
            
            // Store user ID in session for persistence
            Session::put('user_id', $user->id);
        }
        
        Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type', 'login_attempt']);
        
        return redirect()->route('homepage.success')->with('status', 'Login successful!');
    }
})->name('otp.submit');

// Homepage success route
Route::get('/homepage/success', function () {
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
    
    return view('homepagesuccess', ['userName' => $userName]);
})->name('homepage.success');
