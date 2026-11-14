@if(Auth::user() && Auth::user()->role === 'user')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MESH Crypto — Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('front-asset/css/style.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="app-shell">
    <header class="topbar">

      <!-- Mobile Menu Button -->
      <button type="button" class="mobile-menu" aria-label="Toggle sidebar" aria-expanded="false">
          <span></span>
          <span></span>
          <span></span>
      </button>

      <div class="brand" aria-label="MESH Crypto home">
        <svg class="brand-mark" viewBox="0 0 48 38" fill="none" aria-hidden="true">
          <path d="M5 7L15 25L20 16L13 3L5 7Z" fill="#7867FF"/>
          <path d="M22 16L30 3L39 5L29 24L22 16Z" fill="#9B83FF"/>
          <path d="M4 30L16 20L21 28L10 36L4 30Z" fill="#6D5CFA"/>
          <path d="M27 28L38 15L43 20L34 35L27 28Z" fill="#8B79FF"/>
        </svg>
        <div><strong>MESH</strong> <span>Crypto</span></div>
      </div>

      <!-- Sidebar Background Overlay -->
      <div class="sidebar-scrim"></div>
    </header>

    <div class="layout">
      <aside class="sidebar">
        <nav class="nav-menu" aria-label="Main navigation">
          <a href="{{route('main')}}" class="nav-link @yield('home')" data-section="Dashboard">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
              <path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7h-6v7H4a1 1 0 0 1-1-1V10Z"/>
            </svg>
            <span>Dashboard</span>
          </a>
          <a href="{{route('holiding')}}" class="nav-link @yield('holiding')" data-section="Holdings">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
              <path d="M12 3a9 9 0 1 0 9 9h-9V3Z"/>
              <path d="M15 3.5A9 9 0 0 1 20.5 9H15V3.5Z"/>
            </svg>
            <span>New Holding</span>
          </a>
          <a href="{{route('deposit')}}" class="nav-link @yield('deposit')" data-section="Deposit">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
              <path d="M12 3v12m-5-5 5 5 5-5"/>
              <path d="M4 16v4h16v-4"/>
            </svg>
            <span>Deposit</span>
          </a>
          <a href="{{route('withdrawal')}}" class="nav-link @yield('withdrawal')" data-section="Withdraw">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
              <path d="M12 15V3m-5 5 5-5 5 5"/>
              <path d="M4 14v6h16v-6"/>
            </svg>
            <span>Withdrawal</span>
          </a>
          <a href="{{route('history')}}" class="nav-link @yield('history')" data-section="history">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 7v5l3 2"/>
            </svg>
            <span>Transactions History</span>
          </a>
          <a class="btn btn-outline-danger btn-sm container mt-5" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Logout →') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </nav>
        <div class="security-card">
          <div class="security-icon">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2 20 5v6c0 5-3.5 8.5-8 11-4.5-2.5-8-6-8-11V5l8-3Z"/><path d="m9 12 2 2 4-5"/></svg>
          </div>
          <h3>Your Assets,<br>Our Priority</h3>
          <p>Secure. Simple.<br>Built for you.</p>
        </div>
      </aside>

      @yield('main')
      
    </div>

    <footer class="footer">
      <a class="brand" href="#dashboard">
        <svg class="brand-mark" viewBox="0 0 48 38" fill="none" aria-hidden="true"><path d="M5 7L15 25L20 16L13 3L5 7Z" fill="#7867FF"/><path d="M22 16L30 3L39 5L29 24L22 16Z" fill="#9B83FF"/><path d="M4 30L16 20L21 28L10 36L4 30Z" fill="#6D5CFA"/><path d="M27 28L38 15L43 20L34 35L27 28Z" fill="#8B79FF"/></svg>
        <div><strong>MESH</strong> <span>Crypto</span></div>
      </a>
      <div class="socials" aria-label="Social links">
        <a href="https://t.me/MoeHtetr" target="_blank">Telegram ➤</a>
      </div>
      <div class="footer-note">Built for a better crypto experience. <span class="online-dot"></span></div>
    </footer>
  </div>

  <div class="toast-message" id="appToast" role="status" aria-live="polite"></div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('front-asset/js/app.js')}}"></script>
  <script src="{{asset('front-asset/js/script.js')}}"></script>
</body>
</html>
@elseif(Auth::user() && Auth::user()->role === 'admin')
  <script>
      window.location.href = "{{ url('/admin') }}";
  </script>
@else
  <script>
      window.location.href = "{{ url('/') }}";
  </script>
@endif