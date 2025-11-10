<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail;
use App\Models\User;
use App\Models\Instructor;

class AuthController extends Controller
{
    /**
     * Generate and send OTP
     */
    private function sendOtp($email, $name, $prefix = '')
    {
        $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        
        Session::put($prefix . 'otp', $otp);
        Session::put($prefix . 'otp_email', $email);
        Session::put($prefix . 'otp_expires', now()->addMinutes(5));
        
        Mail::to($email)->send(new OtpMail($otp, $name));
        
        return $otp;
    }
    
    /**
     * Verify OTP
     */
    private function verifyOtp($otp, $prefix = '')
    {
        if (!Session::has($prefix . 'otp') || Session::get($prefix . 'otp_expires') < now()) {
            return ['valid' => false, 'error' => 'OTP expired'];
        }
        
        if (Session::get($prefix . 'otp') !== $otp) {
            return ['valid' => false, 'error' => 'Invalid OTP'];
        }
        
        return ['valid' => true];
    }
    
    /**
     * Member Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        Session::put('login_attempt', [
            'email' => $request->email,
            'password' => $request->password,
            'remember' => $request->has('remember')
        ]);
        
        try {
            $this->sendOtp($request->email, 'Member');
            return redirect()->route('otp.verify')->with('status', 'OTP sent to your email');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }
    
    /**
     * Member Registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        Session::put('registration_data', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        Session::put('otp_type', 'registration');
        
        // Capture selected membership plan from query parameter
        if ($request->has('plan')) {
            $plan = strtolower($request->input('plan'));
            if (in_array($plan, ['basic', 'premium', 'elite'])) {
                Session::put('selected_plan', $plan);
            }
        }
        
        try {
            $this->sendOtp($request->email, $request->name);
            return redirect()->route('otp.verify')->with('status', 'OTP sent to your email for verification');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }
    
    /**
     * Verify Member OTP
     */
    public function verifyMemberOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4',
        ]);
        
        $verification = $this->verifyOtp($request->otp);
        
        if (!$verification['valid']) {
            return back()->withErrors(['otp' => $verification['error']]);
        }
        
        $otpType = Session::get('otp_type', 'login');
        
        if ($otpType === 'registration') {
            $registrationData = Session::get('registration_data');
            
            try {
                $user = User::create($registrationData);
                \Auth::login($user);
                Session::put('user_id', $user->id);
                Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type', 'registration_data']);
                
                // If user selected a membership plan, redirect to payment
                if (Session::has('selected_plan')) {
                    return redirect()->route('payment.index')->with('status', 'Registration successful! Complete your payment to activate membership.');
                }
                
                return redirect()->route('dashboard')->with('status', 'Registration successful!');
            } catch (\Exception $e) {
                Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type']);
                return redirect()->route('register')->withErrors(['email' => 'Registration failed. Email may already exist.']);
            }
        } else {
            $email = Session::get('otp_email');
            $user = User::where('email', $email)->first();
            
            if ($user) {
                \Auth::login($user);
                Session::put('user_id', $user->id);
            }
            
            Session::forget(['otp', 'otp_email', 'otp_expires', 'otp_type', 'login_attempt']);
            
            return redirect()->route('dashboard')->with('status', 'Login successful!');
        }
    }
    
    /**
     * Instructor Login
     */
    public function instructorLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $instructor = Instructor::where('email', $request->email)->first();
        
        if (!$instructor || !Hash::check($request->password, $instructor->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        
        Session::put('instructor_id', $instructor->id);
        
        try {
            $this->sendOtp($request->email, $instructor->name, 'instructor_');
            return redirect()->route('instructor.otp')->with('status', 'OTP sent to your email');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }
    
    /**
     * Instructor Registration - Step 1 (Mandatory Fields)
     */
    public function instructorRegisterStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email',
            'date_of_birth' => 'required|date',
            'password' => 'required|min:8|confirmed',
        ]);
        
        // Store step 1 data in session
        Session::put('instructor_registration', [
            'name' => $request->name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'password' => bcrypt($request->password),
        ]);
        
        return redirect()->route('instructor.register.step2.form');
    }
    
    /**
     * Show Step 2 Form
     */
    public function showInstructorRegisterStep2()
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        return view('instructor.register-step2');
    }
    
    /**
     * Instructor Registration - Step 2 (Phone)
     */
    public function instructorRegisterStep2(Request $request)
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        
        $request->validate([
            'phone' => 'nullable|string|max:20',
        ]);
        
        // Add step 2 data to session
        $data = Session::get('instructor_registration');
        $data['phone'] = $request->phone;
        Session::put('instructor_registration', $data);
        
        return redirect()->route('instructor.register.step3.form');
    }
    
    /**
     * Show Step 3 Form
     */
    public function showInstructorRegisterStep3()
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        return view('instructor.register-step3');
    }
    
    /**
     * Instructor Registration - Step 3 (Specialization)
     */
    public function instructorRegisterStep3(Request $request)
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        
        $request->validate([
            'specialization' => 'nullable|string|max:255',
        ]);
        
        // Add step 3 data to session
        $data = Session::get('instructor_registration');
        $data['specialization'] = $request->specialization;
        Session::put('instructor_registration', $data);
        
        return redirect()->route('instructor.register.step4.form');
    }
    
    /**
     * Show Step 4 Form
     */
    public function showInstructorRegisterStep4()
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        return view('instructor.register-step4');
    }
    
    /**
     * Instructor Registration - Step 4 (Experience)
     */
    public function instructorRegisterStep4(Request $request)
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        
        $request->validate([
            'years_of_experience' => 'nullable|string',
        ]);
        
        // Add step 4 data to session
        $data = Session::get('instructor_registration');
        $data['years_of_experience'] = $request->years_of_experience;
        Session::put('instructor_registration', $data);
        
        return redirect()->route('instructor.register.step5.form');
    }
    
    /**
     * Show Step 5 Form
     */
    public function showInstructorRegisterStep5()
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        return view('instructor.register-step5');
    }
    
    /**
     * Instructor Registration - Step 5 (Bio) - Final Step
     */
    public function instructorRegisterStep5(Request $request)
    {
        if (!Session::has('instructor_registration')) {
            return redirect()->route('instructor.register');
        }
        
        $request->validate([
            'bio' => 'nullable|string',
        ]);
        
        // Add step 5 data to session
        $data = Session::get('instructor_registration');
        $data['bio'] = $request->bio;
        
        // Create the instructor
        try {
            $instructor = Instructor::create($data);
            
            // Clear registration session data
            Session::forget('instructor_registration');
            
            // Show completion page
            return redirect()->route('instructor.register.complete');
        } catch (\Exception $e) {
            Session::forget('instructor_registration');
            return redirect()->route('instructor.register')->withErrors(['email' => 'Registration failed. Email may already exist.']);
        }
    }
    
    /**
     * Show Registration Complete Page
     */
    public function showInstructorRegisterComplete()
    {
        return view('instructor.registration-complete');
    }
    
    /**
     * Instructor Registration (OLD - keeping for backwards compatibility)
     */
    public function instructorRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:instructors,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);
        
        Session::put('instructor_registration_data', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'specialization' => $request->specialization,
            'bio' => $request->bio,
        ]);
        Session::put('instructor_otp_type', 'registration');
        
        try {
            $this->sendOtp($request->email, $request->name, 'instructor_');
            return redirect()->route('instructor.otp')->with('status', 'OTP sent to your email for verification');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }
    
    /**
     * Verify Instructor OTP
     */
    public function verifyInstructorOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
        ]);
        
        $verification = $this->verifyOtp($request->otp, 'instructor_');
        
        if (!$verification['valid']) {
            return back()->withErrors(['otp' => $verification['error']]);
        }
        
        $otpType = Session::get('instructor_otp_type', 'login');
        
        if ($otpType === 'registration') {
            $registrationData = Session::get('instructor_registration_data');
            
            try {
                $instructor = Instructor::create($registrationData);
                Session::put('instructor_id', $instructor->id);
                Session::put('instructor_name', $instructor->name);
                Session::forget(['instructor_otp', 'instructor_otp_email', 'instructor_otp_expires', 'instructor_otp_type', 'instructor_registration_data']);
                
                return redirect()->route('instructor.dashboard')->with('status', 'Registration successful!');
            } catch (\Exception $e) {
                Session::forget(['instructor_otp', 'instructor_otp_email', 'instructor_otp_expires', 'instructor_otp_type']);
                return redirect()->route('instructor.register')->withErrors(['email' => 'Registration failed. Email may already exist.']);
            }
        } else {
            $instructorId = Session::get('instructor_id');
            $instructor = Instructor::find($instructorId);
            
            if ($instructor) {
                Session::put('instructor_name', $instructor->name);
            }
            
            Session::forget(['instructor_otp', 'instructor_otp_email', 'instructor_otp_expires', 'instructor_otp_type']);
            
            return redirect()->route('instructor.dashboard')->with('status', 'Login successful!');
        }
    }
}
