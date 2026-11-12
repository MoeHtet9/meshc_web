@if (Auth::user() && Auth::user()->role === 'admin')
<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MESH Crypto | Admin Dashboard</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin-asset/css/styles.css') }}">
</head>
<body>

<div class="app-shell">
  <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
  
  <aside class="sidebar" id="sidebar">
    <div class="brand">
      <div class="brand-mark"></div>
      <div class="brand-name"><b>MESH</b> Crypto</div>
    </div>
    <div class="admin-pill">♛ &nbsp;Admin Panel</div>
    <div class="nav-label">MAIN MENU</div>
    
    <nav class="side-nav">
      <a class="nav-link-custom @yield('dashboard')" href="{{ route('admin.dashboard') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/></svg></span>Dashboard
        <span class="chevron">›</span>
      </a>
      <!-- <a class="nav-link-custom @yield('user')" href="{{ route('admin.user') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM20 8v6m3-3h-6"/></svg></span>Users
        <span class="chevron">›</span>
      </a> -->
      <a class="nav-link-custom @yield('transaction')" href="{{ route('admin.transaction') }}">
        <span class="nav-icon"><svg viewBox="0 0 24 24"><path d="M4 7h15l-3-3m4 3-3 3M20 17H5l3 3m-4-3 3-3"/></svg></span>Transactions
        <span class="chevron">›</span>
      </a>
    </nav>
    
    <div class="sidebar-bottom">
      <div class="mini-art">
        <div class="mini-phone"></div>
        <div class="coin blue">◆</div>
        <div class="coin gold">₿</div>
      </div>
      <div class="side-foot-title">MESH Crypto</div>
      <div class="side-foot-sub">Admin Panel v1.0</div>
    </div>
  </aside>

      @yield('content')

</div>

<div class="toast-note" id="toastNote">This is a front-end demo interaction.</div>

<!-- jQuery + Bootstrap bundle -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin-asset/js/scripts.js') }}"></script>
</body>
</html>
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endif