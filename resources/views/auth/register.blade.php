@extends('layouts.login_signup')
@section('l_s')
    <a class="btn btn-signup" href="{{route('login')}}">Login</a>
@endsection

@section('login_signup')
    <section class="auth-wrap" aria-label="Sign in form">
        <div class="auth-card">
          <div class="form-heading"><h2 id="form-title">Create Account</h2><p id="form-subtitle">Create your MESH Crypto account</p></div>
          <form id="auth-form" novalidate method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <label class="field">
              <svg class="field-icon" viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.7"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <!-- User head -->
                  <circle cx="12" cy="8" r="4"/>

                  <!-- User body -->
                  <path d="M4 21v-2a8 8 0 0 1 16 0v2H4z"/>
              </svg>
              <input id="name" type="name" autocomplete="current-name" placeholder="name" minlength="8" required class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="new-name" autofocus value="{{ old('email') }}">
              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </label>

            <label class="field">
              <span class="field-icon" aria-hidden="true">✉</span>
              <input id="email" type="email" autocomplete="email" placeholder="Email address" required class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </label>
            
            <label class="field">
              <svg class="field-icon" viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.7"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <rect x="4" y="10" width="16" height="11" rx="2"/>
                  <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                  <circle cx="12" cy="15" r="1"/>
                  <path d="M12 16v2"/>
              </svg>
              <input id="password" type="password" autocomplete="current-password" placeholder="Password" minlength="8" required class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <button class="password-toggle" type="button" aria-label="Show password">◎</button>
            </label>

            <label class="field">
              <svg class="field-icon" viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.7"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <rect x="4" y="10" width="16" height="11" rx="2"/>
                  <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                  <circle cx="12" cy="15" r="1"/>
                  <path d="M12 16v2"/>
              </svg>
              <input id="password-confirm" type="password" autocomplete="current-password" placeholder="Confirm Password" minlength="8" required class="form-control" name="password_confirmation" required autocomplete="new-password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              <button class="confirm-password-toggle" type="button" aria-label="Show password">◎</button>
            </label>

            <!-- ROLE_ID -->
            <input type="hidden" name="role_id" id="role_id" value="1">

            <div class="form-message mb-5" role="status" aria-live="polite"></div>
            <button class="btn submit-btn" type="submit"><span id="submit-label">{{ __('Create Account') }}</span><span class="arrow">→</span></button>
          </form>
        </div>
    </section>
@endsection