@extends('layouts.main')
@section('main')
<div class="main-column">
    <main class="page-content">
        <!-- Page Heading -->
        <section class="page-heading2">
          <div class="heading-copy">
            <h1>Transaction History</h1>
            <p>View all your deposit, withdrawal and trading transactions in one place.</p>
          </div>
          <div class="history-art" aria-hidden="true">
            <div class="art-card">
              <span></span><span></span><span></span><i class="bi bi-arrow-right-short"></i>
            </div>
            <span class="art-coin art-btc">₿</span>
            <span class="art-coin art-eth">◆</span>
            <span class="art-coin art-usdt">₮</span>
            <span class="art-star star-a">✦</span>
            <span class="art-star star-b">✧</span>
            <span class="art-orbit"></span>
          </div>
        </section>

        <!-- Stats Grid -->
        <section class="stats-grid" aria-label="Transaction summary">
          <article class="stat-card">
            <div class="stat-copy">
              <span class="stat-label">Total Transactions</span>
              <strong class="stat-number">{{$withdrawal_times + $deposit_times}}</strong>
              <span class="stat-note">All time</span>
            </div>
            <span class="stat-icon"><i class="bi bi-layers"></i></span>
          </article>
          <article class="stat-card">
            <div class="stat-copy">
              <span class="stat-label">Total Deposit</span>
              <strong class="stat-number positive">{{$deposit_amount}} <small>USDT</small></strong>
              <span class="stat-note">{{$deposit_times}} transactions</span>
            </div>
            <span class="stat-icon green"><i class="bi bi-download"></i></span>
          </article>
          <article class="stat-card">
            <div class="stat-copy">
              <span class="stat-label">Total Withdrawal</span>
              <strong class="stat-number negative"><span class="text-danger">{{$withdrawal_amount}} </span> <small class="text-danger">USDT</small></strong>
              <span class="stat-note">{{$withdrawal_times}} transactions</span>
            </div>
            <span class="stat-icon red"><i class="bi bi-upload"></i></span>
          </article>
        </section>

        <!-- Filters Row -->
        <section class="filters-row" aria-label="Transaction filters">
          <div class="nav nav-tabs p-2" id="nav-tab" role="tablist">
            <button class="nav-link active text-light" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Deposits</button>
            <button class="nav-link text-light" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Withdrawals</button>
          </div>
        </section>

        <!-- Transactions Table Card -->
        <section class="transactions-card">
          <div class="table-heading">
            
          </div>

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
              <span class="amount positive m-3">Deposits</span>
              <div class="table-scroll">
                  <table class="transactions-table">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Date &amp; Time</th>
                              <th class="text-end">Amount</th>
                              <th>Status</th>
                          </tr>
                      </thead>

                      <tbody id="transactionRows">
                          @php
                            $j = 1;
                          @endphp
                          @foreach($deposits as $deposit)
                            <tr data-date="2026-10-18" data-type="Deposit" data-coin="USDT" data-search="deposit usdt completed 500">
                                <td>{{$j++}}</td>
                                <td>{{$deposit->created_at}}</td>
                                <td class="amount positive">+{{$deposit->amout}}</td>
                                <td>
                                  @if($deposit->status == 'Pending')
                                    <span class="type-badge buy">Pending</span>
                                  @else
                                    <span class="status-badge">Completed</span>
                                  @endif
                                </td>
                            </tr>
                          @endforeach
                      </tbody>

                  </table>

                  <div class="empty-state container-fulid text-center mt-5" id="emptyState" style="display: none;">
                      <i class="bi bi-search"></i>
                      <strong>No transactions found</strong>
                  </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
              <span class="text-danger amount m-3" id="">Withdrawals</span>
              <div class="table-scroll">
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date &amp; Time</th>
                            <th class="text-end">Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody id="transactionRows">
                        @php
                          $j = 1;
                        @endphp
                        @foreach($withdrawals as $withdrawal)
                          <tr data-date="2026-10-18" data-type="Deposit" data-coin="USDT" data-search="deposit usdt completed 500">
                              <td>{{$j++}}</td>
                              <td>{{$withdrawal->created_at}}</td>
                              <td class="text-danger amount">-{{$withdrawal->amout}}</td>
                              <td>
                                @if($withdrawal->status == 'Pending')
                                  <span class="type-badge buy">Pending</span>
                                @else
                                  <span class="status-badge">Completed</span>
                                @endif
                              </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Table Footer -->
          <div class="table-footer">
              <!-- <span id="resultsSummary">Showing 1 to 8 of 9 transactions</span> -->

              <nav class="pagination-nav" aria-label="Transaction pages">
                  <button type="button" class="page-btn" id="prevPage" aria-label="Previous page" disabled>
                      <i class="bi bi-chevron-left"></i>
                  </button>

                  <!-- Page number buttons are generated by JavaScript -->

                  <button type="button" class="page-btn" id="nextPage" aria-label="Next page">
                      <i class="bi bi-chevron-right"></i>
                  </button>
              </nav>
          </div>

    </main>
</div>
@endsection
@section('history')
    active
@endsection