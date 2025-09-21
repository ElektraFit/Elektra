<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // generate a random otp
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->otp_expires_at = now()->addMinutes(5);
            $user->save();

            // send the OTP through email
            Mail::to($user->email)->send(new SendOtpMail($otp));

            // Temporrily log out until the OTP is verified
            Auth::logout();

            // Redirect user to OTP verification form
            return redirect()->route('otp.form')->with('status', 'We sent a 4-digit OTP to your email.');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password!',
        ]);
    }
}
