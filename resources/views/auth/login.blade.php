@extends('layouts.login_signup')
@section('l_s')
    <a class="btn btn-signup" href="{{ route('register') }}">Sign up</a>
@endsection

@section('login_signup')
    <section class="auth-wrap" aria-label="Sign in form">
        <div class="auth-card">
          <div class="form-heading"><h2 id="form-title">Welcome Back</h2><p id="form-subtitle">Sign in to your MESH Crypto account</p></div>
          <form method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->has('email'))
                <div class="alert alert-danger">The email address or password you entered is incorrect.</div>
            @endif

            <label class="field">
              <span class="field-icon" aria-hidden="true">✉</span>
              <input id="email" type="email" autocomplete="email" placeholder="Email address" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            </label>

            <label class="field">
              <span class="field-icon lock-icon" aria-hidden="true">♙</span>
              <input id="password" type="password" placeholder="Password" minlength="8" class="form-control @error('email') is-invalid @enderror" required autocomplete="current-password" name="password">
              <button class="password-toggle" type="button" aria-label="Show password">◎</button>
            </label>

            <div class="form-options" id="login-options">
              <a href="{{ route('forgot') }}" id="forgot-link">Forgot password?</a>
            </div>

            <div class="form-message" role="status" aria-live="polite"></div>
            <button class="btn submit-btn" type="submit"><span id="submit-label">{{ __('Login') }}</span><span class="arrow">→</span></button>
          </form>
        </div>
    </section>
@endsection