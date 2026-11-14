@if (Auth::user() && Auth::user()->role === 'admin')
@extends('layouts.admin')
@section('dashboard')
    active
@endsection
@section('content')
<main class="main-area">
    <div class="page-content">
      
      <header class="topbar">
        <div class="topbar-left">
          <button class="mobile-menu" id="mobileMenu" aria-label="Open menu">
            <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
          </button>
          <div>
            <h1 class="page-title">Admin Dashboard</h1>
            <p class="page-subtitle">Welcome back, Admin!</p>
          </div>
        </div>
        
        <div class="top-actions">
          <div class="top-divider"></div>
          
          <div class="dropdown">
            <button class="profile-btn" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="avatar-admin">{{strtoupper(substr(Auth::user()->name, 0, 1))}}</span>
              <span class="profile-text">
                <span class="profile-name">{{Auth::user()->name}}</span><br>
                <span class="profile-role">Administrator</span>
              </span>
              <span class="profile-caret">⌄</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout →') }} </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </header>

      <section class="stat-grid row">
        <article class="glass-card stat-card reveal col-lg-4 col-sm-12">
          <div class="stat-icon">
            <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM16 3.2a4 4 0 0 1 0 7.6M20 21v-2a4 4 0 0 0-3-3.9"/></svg>
          </div>
          <div>
            <div class="stat-label">Total Users</div>
            <div class="stat-value count" data-count="{{$users->count()}}">0</div>
          </div>
        </article>

        <article class="glass-card stat-card reveal delay-1 col-lg-4 col-sm-12">
          <div class="stat-icon">
            <svg viewBox="0 0 24 24"><path d="m12 3 9 4.5-9 4.5-9-4.5zM3 12l9 4.5 9-4.5M3 16.5 12 21l9-4.5"/></svg>
          </div>
          <div>
            <div class="stat-label">Total Holiding Amounts (USDT)</div>
            <div class="stat-value">$<span class="count" data-count="{{$holiding_amounts}}">0</span></div>
          </div>
        </article>

        <article class="glass-card stat-card reveal delay-2 col-lg-3 col-sm-12">
          <div class="stat-icon">
            <svg viewBox="0 0 24 24"><path d="M4 7h15l-3-3m4 3-3 3M20 17H5l3 3m-4-3 3-3"/></svg>
          </div>
          <div>
            <div class="stat-label">Total Transactions</div>
            <div class="stat-value count" data-count="{{$total_transactions}}">0</div>
            <div class=" text-warning stat-change">⌃ &nbsp;Pending</div>
          </div>
        </article>
      </section>

      <section class="row">
        <article class="glass-card panel reveal delay-1 col-sm-12" id="users">
          <div class="panel-heading">
            <h2 class="panel-title">
              <svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="4"/><path d="M2 21v-2a7 7 0 0 1 14 0v2M17 4a4 4 0 0 1 0 8m1 3a5 5 0 0 1 4 5v1"/></svg> Users
            </h2>
          </div>
          <div class="users-table-wrap">
            <table class="users-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Balance</th>
                  <th>Joined At</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $j = 1
                @endphp
                @foreach($users->sortByDesc('created_at') as $user)
                  <tr>
                    <td>{{$j++}}</td>
                    <td>
                      <div class="user-cell">
                        <span class="user-avatar"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg></span>
                        {{$user->name}}
                      </div>
                    </td>
                    <td>{{$user->email}}</td>
                    <td class="text-success" style="font-size: 1rem;"> {{ $user->amount?->amout ?? 0 }} USDT </td>
                    <td>{{$user->created_at}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </article>
      </section>

    </div>
</main>
@endsection
@else
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endif