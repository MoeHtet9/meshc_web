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
              <strong class="stat-number">24</strong>
              <span class="stat-note">All time</span>
            </div>
            <span class="stat-icon"><i class="bi bi-layers"></i></span>
          </article>
          <article class="stat-card">
            <div class="stat-copy">
              <span class="stat-label">Total Deposit</span>
              <strong class="stat-number positive">1,250 <small>USDT</small></strong>
              <span class="stat-note">5 transactions</span>
            </div>
            <span class="stat-icon green"><i class="bi bi-download"></i></span>
          </article>
          <article class="stat-card">
            <div class="stat-copy">
              <span class="stat-label">Total Withdrawal</span>
              <strong class="stat-number negative"><span class="text-danger">320</span> <small class="text-danger">USDT</small></strong>
              <span class="stat-note">3 transactions</span>
            </div>
            <span class="stat-icon red"><i class="bi bi-upload"></i></span>
          </article>
        </section>

        <!-- Filters Row -->
        <section class="filters-row" aria-label="Transaction filters">
          <div class="filter-control type-filter">
            <i class="bi bi-arrow-left-right filter-icon"></i>
            <select id="typeFilter" aria-label="Filter by type">
              <option value="all">All Types</option>
              <option>Deposit</option>
              <option>Withdrawal</option>
            </select>
            <i class="bi bi-chevron-down filter-chevron"></i>
          </div>
        </section>

        <!-- Transactions Table Card -->
        <section class="transactions-card">
          <div class="table-heading">
            <h2>Transactions</h2>
            <div class="export-wrap">
              <button class="export-btn" id="exportToggle" type="button" aria-expanded="false">
                <i class="bi bi-download"></i> Export <i class="bi bi-chevron-down export-chevron"></i>
              </button>
              <div class="export-menu" id="exportMenu">
                <button type="button" id="exportCsv"><i class="bi bi-filetype-csv"></i> Export as CSV</button>
                <button type="button" id="printTable"><i class="bi bi-printer"></i> Print transactions</button>
              </div>
            </div>
          </div>

          <div class="table-scroll">
              <table class="transactions-table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Date &amp; Time</th>
                          <th>Type</th>
                          <th>Coin</th>
                          <th class="text-end">Amount</th>
                          <th class="text-end">Price (USDT)</th>
                          <th class="text-end">Total Value (USDT)</th>
                          <th>Status</th>
                          <th class="text-center">Action</th>
                      </tr>
                  </thead>

                  <tbody id="transactionRows">
                      <tr data-date="2026-10-18" data-type="Deposit" data-coin="USDT" data-search="deposit usdt completed 500">
                          <td>1</td>
                          <td>Oct 18, 2026 10:24 AM</td>
                          <td><span class="type-badge deposit"><i class="bi bi-download"></i> Deposit</span></td>
                          <td><span class="coin-cell"><span class="coin-logo usdt">₮</span>USDT</span></td>
                          <td class="amount positive">+500.0000</td>
                          <td class="text-end">1.00</td>
                          <td class="text-end">500.00</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 1"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-17" data-type="Buy" data-coin="BTC" data-search="buy bitcoin btc completed 0.01">
                          <td>2</td>
                          <td>Oct 17, 2026 03:15 PM</td>
                          <td><span class="type-badge buy"><i class="bi bi-cart-fill"></i> Buy</span></td>
                          <td><span class="coin-cell"><span class="coin-logo btc">₿</span>BTC</span></td>
                          <td class="amount positive">0.0100</td>
                          <td class="text-end">65,432.00</td>
                          <td class="text-end">654.32</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 2"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-16" data-type="Withdrawal" data-coin="USDT" data-search="withdrawal usdt completed 200">
                          <td>3</td>
                          <td>Oct 16, 2026 11:40 AM</td>
                          <td><span class="type-badge withdrawal"><i class="bi bi-arrow-up"></i> Withdrawal</span></td>
                          <td><span class="coin-cell"><span class="coin-logo usdt">₮</span>USDT</span></td>
                          <td class="amount negative">-200.0000</td>
                          <td class="text-end">1.00</td>
                          <td class="text-end">200.00</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 3"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-15" data-type="Buy" data-coin="ETH" data-search="buy ethereum eth completed 0.25">
                          <td>4</td>
                          <td>Oct 15, 2026 08:22 PM</td>
                          <td><span class="type-badge buy"><i class="bi bi-cart-fill"></i> Buy</span></td>
                          <td><span class="coin-cell"><span class="coin-logo eth">◆</span>ETH</span></td>
                          <td class="amount positive">0.2500</td>
                          <td class="text-end">2,450.00</td>
                          <td class="text-end">612.50</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 4"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-14" data-type="Sell" data-coin="BNB" data-search="sell bnb completed 1">
                          <td>5</td>
                          <td>Oct 14, 2026 02:10 PM</td>
                          <td><span class="type-badge sell"><i class="bi bi-cart-fill"></i> Sell</span></td>
                          <td><span class="coin-cell"><span class="coin-logo bnb">✦</span>BNB</span></td>
                          <td class="amount negative">-1.0000</td>
                          <td class="text-end">580.00</td>
                          <td class="text-end">580.00</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 5"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-12" data-type="Deposit" data-coin="USDT" data-search="deposit usdt completed 750">
                          <td>6</td>
                          <td>Oct 12, 2026 09:30 AM</td>
                          <td><span class="type-badge deposit"><i class="bi bi-download"></i> Deposit</span></td>
                          <td><span class="coin-cell"><span class="coin-logo usdt">₮</span>USDT</span></td>
                          <td class="amount positive">+750.0000</td>
                          <td class="text-end">1.00</td>
                          <td class="text-end">750.00</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 6"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-10" data-type="Withdrawal" data-coin="USDT" data-search="withdrawal usdt completed 120">
                          <td>7</td>
                          <td>Oct 10, 2026 06:45 PM</td>
                          <td><span class="type-badge withdrawal"><i class="bi bi-arrow-up"></i> Withdrawal</span></td>
                          <td><span class="coin-cell"><span class="coin-logo usdt">₮</span>USDT</span></td>
                          <td class="amount negative">-120.0000</td>
                          <td class="text-end">1.00</td>
                          <td class="text-end">120.00</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 7"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-08" data-type="Buy" data-coin="SOL" data-search="buy solana sol completed 5">
                          <td>8</td>
                          <td>Oct 08, 2026 01:20 PM</td>
                          <td><span class="type-badge buy"><i class="bi bi-cart-fill"></i> Buy</span></td>
                          <td><span class="coin-cell"><span class="coin-logo sol">S</span>SOL</span></td>
                          <td class="amount positive">5.0000</td>
                          <td class="text-end">145.00</td>
                          <td class="text-end">725.00</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 8"><i class="bi bi-three-dots"></i></button></td>
                      </tr>

                      <tr data-date="2026-10-08" data-type="Buy" data-coin="SOL" data-search="buy solana sol completed 5">
                          <td>9</td>
                          <td>Oct 08, 2026 01:20 PM</td>
                          <td><span class="type-badge buy"><i class="bi bi-cart-fill"></i> Buy</span></td>
                          <td><span class="coin-cell"><span class="coin-logo sol">S</span>SOL</span></td>
                          <td class="amount positive">5.0000</td>
                          <td class="text-end">145.00</td>
                          <td class="text-end">725.00</td>
                          <td><span class="status-badge">Completed</span></td>
                          <td class="text-center"><button type="button" class="row-action" aria-label="Actions for transaction 9"><i class="bi bi-three-dots"></i></button></td>
                      </tr>
                  </tbody>
              </table>

              <div class="empty-state" id="emptyState" style="display: none;">
                  <i class="bi bi-search"></i>
                  <strong>No transactions found</strong>
                  <span>Try changing your filters or search terms.</span>
              </div>
          </div>

          <!-- Table Footer -->
          <div class="table-footer">
              <span id="resultsSummary">Showing 1 to 8 of 9 transactions</span>

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

        </section>
    </main>
</div>
@endsection
@section('history')
    active
@endsection