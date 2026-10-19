<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#050a1b">
  <title>MESH Crypto — Sign In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('front-asset/css/l_s.css')}}">
</head>
<body>
  <div class="page-shell">
    <header class="topbar">
      <a class="brand" href="#" aria-label="MESH Crypto home">
        <span class="brand-mark" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
        <span><strong>MESH</strong> <span class="brand-light">Crypto</span></span>
      </a>
      <div class="topbar-cta">
        @yield('l_s')
      </div>
    </header>

    <main class="main-layout">
      <section class="hero-panel" aria-label="MESH Crypto benefits">
        <div class="hero-copy">
          <div class="eyebrow"><span class="status-dot"></span> SECURE <b>•</b> SIMPLE <b>•</b> BUILT FOR THE FUTURE</div>
          <h1>Simple Holding.<br>Maximum <span>Trust.</span></h1>
          <p class="hero-description">Track, manage and grow your crypto assets<br class="desktop-break"> in one secure platform.</p>

          <div class="stats">
            <div><strong>10K+</strong><span>Active Users</span></div>
          </div>
        </div>

        <div class="crypto-scene" aria-hidden="true">
          <div class="orbit orbit-one"></div><div class="orbit orbit-two"></div>
          <div class="mesh-card">
            <span class="brand-mark scene-mark"><i></i><i></i><i></i><i></i></span>
            <span class="scene-word">MESH</span>
          </div>
          <div class="coin ethereum"><span>◆</span></div>
          <div class="coin bitcoin"><span>₿</span></div>
          <div class="rock rock-one"></div><div class="rock rock-two"></div><div class="rock rock-three"></div>
          <div class="scene-floor"></div>
        </div>
      </section>

      @yield('login_signup')
      
    </main>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('front-asset/js/script.js')}}"></script>
</body>
</html>
