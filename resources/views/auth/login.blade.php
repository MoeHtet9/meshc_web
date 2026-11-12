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
            <label class="field">
              <span class="field-icon" aria-hidden="true">✉</span>
              <input id="email" type="email" autocomplete="email" placeholder="Email address" required name="email" class="form-control" autofocus value="{{ old('email') }}">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </label>
            <label class="field">
              <span class="field-icon lock-icon" aria-hidden="true">♙</span>
              <input id="password" type="password" autocomplete="current-password" placeholder="Password" minlength="6" required name="password" class="form-control" value="{{ old('password') }}">
              <button class="password-toggle" type="button" aria-label="Show password">◎</button>
            </label>
            @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            <div class="form-options" id="login-options">
              <label class="remember"><input type="checkbox" checked><span class="custom-check">✓</span> Remember me</label>
              <a href="#forgot" id="forgot-link">Forgot password?</a>
            </div>
            <div class="form-message" role="status" aria-live="polite"></div>
            <button class="btn submit-btn" type="submit"><span id="submit-label">{{ __('Login') }}</span><span class="arrow">→</span></button>
          </form>
        </div>
    </section>
@endsection