@extends('layouts.main')
@section('main')
    <main class="main-content" id="dashboard">
        <section class="welcome-row">
          <div class="welcome">
            <div class="eyebrow">Welcome back,</div>
            <h1>{{$user->name}}<span aria-label="waving hand">👋</span></h1>
            <p>Track your crypto holdings in one place.<br class="d-none d-sm-block"> Simple, secure and built for the future.</p>
          </div>
          <div class="promo-banner">
            <div class="promo-copy">
              <h2>MESH Crypto</h2>
              <p>Simple Holding.<br>Maximum Trust.</p>
            </div>
            <div class="coin-art" aria-hidden="true"><div class="coin btc">₿</div><div class="coin eth">◆</div></div>
          </div>
        </section>

        <section class="stats-grid" aria-label="Portfolio overview">
          <article class="panel stat-card">
            <div>
              <div class="stat-label">Total Balance&nbsp; <span aria-hidden="true">◎</span></div>
              <div class="stat-value">
                @if($amout)
                  {{$amout->amout}}
                @else
                  0
                @endif
                <span class="stat-change">USDT</span>
              </div>
            </div>
            <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m3 17 6-6 4 4 8-9"/><path d="M15 6h6v6"/></svg></div>
          </article>
          <article class="panel stat-card">
            <div>
              <div class="stat-label">Total Assets</div>
              <div class="stat-value">{{$holidings->count()}}</div>
              <div class="stat-sub">Holding</div>
            </div>
            <div class="stat-icon neutral"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 12 9 5 9-5M3 16l9 5 9-5"/></svg></div>
          </article>
          <article class="panel stat-card">
            <div>
              <div class="stat-label">24h Change</div>
              <div class="stat-value positive">+0.5%</div>
            </div>
            <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m3 17 6-6 4 4 8-9"/><path d="M15 6h6v6"/></svg></div>
          </article>
        </section>

        <section class="panel holdings-panel" id="holdings">
          <div class="holdings-header">
            <h2>Your Holdings</h2>
          </div>
          <div class="table-responsive">
            <table class="holdings-table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Coin</th>
                      <th>Amount</th>
                      <th>24h Change</th>
                      <th>Lock Times</th>
                  </tr>
              </thead>
              <tbody id="holdingsBody">
                @if($holidings->isNotEmpty())
                  @php
                    $j = 1;
                  @endphp
                  @foreach($holidings as $holiding)
                    <tr data-coin="bitcoin btc">
                      <td>{{$j++}}</td>
                      <td><div class="coin-name"><span><strong>{{$holiding->coin->name}}</strong></span></div></td>
                      <td>{{$holiding->amout}}<small class="muted-small">USDT</small></td>
                      <td class="positive">+0.5%</td>
                      <td>{{$holiding->times}} days</td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                      <td colspan="5" class="text-center">
                          No data available
                      </td>
                  </tr>
                @endif
                
              </tbody>
            </table>
            <div id="emptySearch" class="p-4 text-center d-none" style="color:var(--muted)">No matching coins found.</div>
          </div>
        </section>

        <section class="features" aria-label="MESH benefits">
          <div class="feature">
            <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 2 20 5v6c0 5-3.5 8.5-8 11-4.5-2.5-8-6-8-11V5l8-3Z"/><path d="m9 12 2 2 4-5"/></svg></div>
            <div><h3>Top Security</h3><p>Your funds are protected with industry-grade security.</p></div>
          </div>
          <div class="feature">
            <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="m13 2-9 12h7l-1 8 10-13h-7l1-7Z"/></svg></div>
            <div><h3>Fast &amp; Easy</h3><p>Deposit and manage your crypto in seconds.</p></div>
          </div>
          <div class="feature">
            <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 12 9 5 9-5M3 16l9 5 9-5"/></svg></div>
            <div><h3>Minimal UI</h3><p>Clean and simple for the best experience.</p></div>
          </div>
          <div class="feature">
            <div class="feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M5 16c-2 2-2 5-2 5s3 0 5-2l3-3-4-4-2 4Z"/><path d="M8 13 15 6c2-2 5-2 7-2 0 2 0 5-2 7l-7 7"/><path d="m13 7 4 4"/></svg></div>
            <div><h3>Future Ready</h3><p>More services coming soon for your crypto journey.</p></div>
          </div>
        </section>
    </main>
@endsection
@section('home')
    active
@endsection