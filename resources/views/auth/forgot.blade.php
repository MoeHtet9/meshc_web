@extends('layouts.login_signup')

@section('login_signup')

<section class="auth-wrap" aria-label="Forgot password form">
    <div class="auth-card">

        <div class="form-heading">
            <h2>Reset Password</h2>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <small class="text-success d-block mb-3">
                {{ session('success') }}
            </small>
        @endif


        {{-- STEP 1: ENTER EMAIL --}}
        @if(!session('otp_email'))

            <form method="POST" action="{{ route('forgot.sendOtp') }}">
                @csrf

                <label class="field">
                    <span class="field-icon">✉</span>
                    <input
                        type="email"
                        name="email"
                        placeholder="Email address"
                        required
                        class="form-control"
                        value="{{ old('email') }}"
                        autofocus
                    >
                </label>

                @error('email')
                    <small class="text-danger d-block mb-2">
                        {{ $message }}
                    </small>
                @enderror

                <button type="submit" class="btn submit-btn">
                    Get OTP →
                </button>
            </form>


        {{-- STEP 2: VERIFY OTP --}}
        @elseif(!session('otp_verified'))

            <p class="text-success mb-3">
                {{ $email_comp ?? 'OTP sent successfully. Please check your email.' }}
            </p>

            <p class="text-secondary">
                Email: {{ session('otp_email') }}
            </p>

            <form method="POST" action="{{ route('forgot.verifyOtp') }}">
                @csrf

                <label class="field">
                    <input
                        type="number"
                        name="otp"
                        placeholder="Enter 6 Digit OTP"
                        required
                        class="form-control"
                    >
                </label>

                @error('otp')
                    <small class="text-danger d-block mb-2">
                        {{ $message }}
                    </small>
                @enderror

                <button type="submit" class="btn submit-btn">
                    Verify OTP →
                </button>
            </form>

            {{-- Resend OTP --}}
            <form method="POST" action="{{ route('forgot.sendOtp') }}" class="mt-3">
                @csrf

                <input
                    type="hidden"
                    name="email"
                    value="{{ session('otp_email') }}"
                >

                <button type="submit" class="btn btn-link">
                    Resend OTP
                </button>
            </form>


        {{-- STEP 3: RESET PASSWORD --}}
        @else

            <p class="text-success mb-3">
                OTP verified successfully!
            </p>

            <form method="POST" action="{{ route('forgot.resetPassword') }}">
                @csrf

                <label class="field">
                    <span class="field-icon">🔒</span>
                    <input
                        type="password"
                        name="password"
                        placeholder="New Password"
                        required
                        minlength="8"
                        class="form-control"
                        autocomplete="new-password"
                    >
                </label>

                @error('password')
                    <small class="text-danger d-block mb-2">
                        {{ $message }}
                    </small>
                @enderror

                <label class="field">
                    <span class="field-icon">🔒</span>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        required
                        minlength="8"
                        class="form-control"
                        autocomplete="new-password"
                    >
                </label>

                <button type="submit" class="btn submit-btn">
                    Reset Password →
                </button>
            </form>

        @endif

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>

    </div>
</section>

@endsection
