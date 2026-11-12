@extends('layouts.admin')
@section('transaction')
    active
@endsection
@section('content')
<main class="main-area">
    <div class="transaction-page">

        <div class="topbar">
            <div>
                <h1 class="page-title">Transactions</h1>
                <p class="page-subtitle">Monitor and manage all MESH Crypto transactions.</p>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row g-3 mb-4">
            <div class="col-xl-3 col-sm-6">
                <div class="tx-card tx-stat">
                    <div class="tx-icon">↔</div>
                    <div>
                        <div class="tx-label">Total</div>
                        <div class="tx-number">{{ number_format($transactions->count()) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="tx-card tx-stat">
                    <div class="tx-icon">✓</div>
                    <div>
                        <small class="text-success">Successful</small>
                        <div class="tx-number">{{ number_format($transactions->where('status', 'completed')->count()) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="tx-card tx-stat">
                    <div class="tx-icon">◷</div>
                    <div>
                        <small class="text-warning">Pending</small>
                        <div class="tx-number">{{ number_format($transactions->where('status', 'Pending')->count()) }}</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="tx-card tx-stat">
                    <div class="tx-icon">✕</div>
                    <div>
                        <small class="text-danger">Fail</small>
                        <div class="tx-number">{{ number_format($transactions->where('status', 'failed')->count()) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Table -->
        <section class="tx-card">

            <div class="tx-toolbar mb-4">
                <div>
                    <h5 class="fw-bold mb-1">All Transactions</h5>
                    <small class="tx-muted">Manage and track every transaction</small>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <input type="text" class="tx-input" id="txSearch"
                           placeholder="Search transaction...">

                    <select class="tx-input" id="txStatus">
                        <option value="">All Status</option>
                        <option value="completed">Completed</option>
                        <option value="Pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>

                    <select class="tx-input" id="txType">
                        <option value="">All Types</option>
                        <option value="Deposit">Deposit</option>
                        <option value="Withdrawal">Withdrawal</option>
                    </select>

                </div>
            </div>

            <div class="tx-table-wrap">
                <table class="tx-table" id="transactionTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USER</th>
                            <th>Type</th>
                            <th>AMOUNT</th>
                            <th>DATE</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody id="transactionBody">
                        @php
                            $j = 1;
                        @endphp

                        @foreach($transactions as $transaction)
                        <tr data-status="{{ $transaction->status }}" @if($transaction->payment_ss) data-type="Deposit" @else data-type="Withdrawal" @endif>
                            <input type="hidden" class="img" value="{{ $transaction->payment_ss }}">
                            <input type="hidden" class="address" value="{{ $transaction->address }}">
                            <td class="tx-id">{{ $j++ }}</td>
                            <td><div class="tx-user">{{ $transaction->user->email }}</div></td>
                            <td>
                                @if($transaction->payment_ss)
                                    <span class="tx-type">Deposit</span>
                                @else
                                    <span class="tx-type">Withdrawal</span>
                                @endif
                            </td>
                            <td class="positive">{{ number_format($transaction->amout, 2) }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td><span class="tx-status {{ strtolower($transaction->status) }}">{{ $transaction->status }}</span></td>
                            <td>
                                @if($transaction->status == 'Pending')
                                    @if($transaction->payment_ss)
                                        <a href="{{ route('admin.deposit.comp', ['id' => $transaction->id, 'user_id' => $transaction->user_id]) }}" class="btn btn-sm btn-success">Completed</a>
                                        <a href="{{ route('admin.deposit.fail', ['id' => $transaction->id, 'user_id' => $transaction->user_id]) }}" class="btn btn-sm btn-danger">Failed</a>
                                    @else
                                        <a href="{{ route('admin.withdrawal.comp', ['id' => $transaction->id, 'user_id' => $transaction->user_id]) }}" class="btn btn-sm btn-success">Completed</a>
                                        <a href="{{ route('admin.withdrawal.fail', ['id' => $transaction->id, 'user_id' => $transaction->user_id]) }}" class="btn btn-sm btn-danger">Failed</a>
                                    @endif
                                @endif
                                <button class="tx-action view-tx">↗</button> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="noTransactions" class="text-center py-5" style="display:none">
                    No transactions found.
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <small class="tx-muted" id="txCount">Showing transactions</small>
            </div>
        </section>
    </div>
</main>

<!-- Details Modal -->
<div class="modal fade tx-modal" id="transactionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Transaction Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="text-center py-3">
                    <div style="font-size:38px;color:#9c80ff;margin-bottom:10px" id="modalImg"></div>
                    <span id="modalStatus" class="tx-status completed">Completed</span>
                </div>

                <div class="tx-detail"><span>Transaction ID</span><strong id="modalId">-</strong></div>
                <div class="tx-detail"><span>Username</span><strong id="modalUser">-</strong></div>
                <div class="tx-detail"><span>Type</span><strong id="modalType">-</strong></div>
                <div class="tx-detail"><span>Amount</span><strong id="modalAsset">-</strong></div>
            </div>

            <div class="modal-footer">
                <button class="tx-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection