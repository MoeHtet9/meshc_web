<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotController extends Controller
{
    // Show Forgot Password Page
    public function forgot() {
        return view('auth.forgot');
    }

    // Step 1: Send OTP to Email
    public function sendOtp(Request $request) {

        // Validate Email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check Email Exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'Email not found.'])
                ->withInput();
        }

        // Generate 6 Digit OTP
        $otp = random_int(100000, 999999);

        // Save OTP in Session
        session([
            'otp_code' => Hash::make((string) $otp),
            'otp_email' => $request->email,
            'otp_expire' => now()->addMinutes(3),
            'otp_verified' => false,
        ]);

        // Send OTP to Gmail
        Mail::raw(
            "Your OTP Code is: {$otp}\n\nThis code expires in 3 minutes.",
            function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Password Reset Verification Code');
            }
        );

        return view('auth.forgot', [
            'email' => $request->email,
            'email_comp' => 'OTP sent successfully. Please check your email.',
        ]);
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request) {
        // Validate OTP
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Check OTP Session Exists
        if (
            !session()->has('otp_code') ||
            !session()->has('otp_expire') ||
            !session()->has('otp_email')
        ) {
            return back()->withErrors([
                'otp' => 'Please request OTP first.'
            ]);
        }

        // Check OTP Expiration (3 Minutes)
        if (now()->greaterThanOrEqualTo(session('otp_expire'))) {

            session()->forget([
                'otp_code',
                'otp_email',
                'otp_expire',
                'otp_verified'
            ]);

            return back()->withErrors([
                'otp' => 'OTP expired. Please request a new OTP.'
            ]);
        }

        // Check OTP Correct or Not
        if (!Hash::check(
            (string) $request->otp,
            session('otp_code')
        )) {
            return back()->withErrors([
                'otp' => 'Invalid OTP. Please try again.'
            ]);
        }

        // OTP Verified Successfully
        session([
            'otp_verified' => true,
        ]);

        return view('auth.forgot', [
            'email' => session('otp_email'),
            'otp_success' => 'OTP verified successfully. You can reset your password now.',
        ]);
    }

    // Step 3: Reset Password
    public function resetPassword(Request $request) {

        // Check OTP Verified
        if (!session('otp_verified') || !session('otp_email')) {
            return back()->withErrors([
                'otp' => 'Please verify your OTP first.'
            ]);
        }

        // Check OTP Expiration Again
        if (now()->greaterThanOrEqualTo(session('otp_expire'))) {

            session()->forget([
                'otp_code',
                'otp_email',
                'otp_expire',
                'otp_verified'
            ]);

            return back()->withErrors([
                'otp' => 'OTP expired. Please request a new OTP.'
            ]);
        }

        // Validate New Password
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Find User
        $user = User::where(
            'email',
            session('otp_email')
        )->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'User not found.'
            ]);
        }

        // Update Password
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear OTP Session
        session()->forget([
            'otp_code',
            'otp_email',
            'otp_expire',
            'otp_verified'
        ]);

        // Redirect to Login
        return redirect()->route('login');
    }
}
