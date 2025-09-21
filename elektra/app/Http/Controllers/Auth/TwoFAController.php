<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TwoFAController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.otp');
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:4',]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>', now())
            ->first();

        if ($user) {

            // clear the otp after success
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // log the User back in
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP']);
    }
}

