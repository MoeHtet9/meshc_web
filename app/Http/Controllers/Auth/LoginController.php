<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user) {
        if ($user->role == 'admin') {

            $email = $request->email;
            $password = $request->password;

            // Generate 6 digit OTP
            $otp = random_int(100000, 999999);

            // Save OTP in Session
            session([
                'pending_user_id' => $user->id,
                'otp_code' => Hash::make((string) $otp),
                'otp_expire' => now()->addMinute(),
            ]);

            // Logout before OTP verification
            Auth::logout();

            // Send OTP to Gmail
            Mail::raw(
                "Your Login OTP Code is: {$otp}\n\nThis code expires in 1 minute.",
                function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Login Verification Code');
                }
            );

            // Redirect to OTP page
            return view('admin/login', compact('email', 'password'));
        }else {
            return redirect()->route('main');
        }
    }

    public function verifyOtp(Request $request) {

        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $otp = session('otp_code');
        $expire = session('otp_expire');

        if (!$otp || !$expire) {
            return response()->json([
                'success' => false,
                'message' => 'OTP မရှိတော့ပါ။'
            ], 422);
        }

        if (now()->greaterThan($expire)) {
            session()->forget([
                'otp_code',
                'otp_expire',
                'pending_user_id'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'OTP သက်တမ်းကုန်သွားပါပြီ။'
            ], 422);
        }

        if (!Hash::check((string) $request->otp, $otp)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP မှားနေပါတယ်။'
            ], 422);
        }

        $user = User::find(session('pending_user_id'));

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User မတွေ့ပါ။'
            ], 404);
        }

        session()->forget([
            'otp_code',
            'otp_expire',
            'pending_user_id'
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'redirect' => route('admin.dashboard')
        ]);

    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin';
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
