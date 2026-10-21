@extends('layouts.main')
@section('main')
    <main class="main-content row">
      <section class="deposit-panel col-md-8" aria-label="USDT deposit">
        <div class="asset-summary"><div class="usdt-icon"><span>₮</span></div><div><h2>USDT</h2><p>Network: BEP20 (BNB Smart Chain)</p></div><span class="network-pill">BEP20</span></div>
        <div class="payment-section">
          <form class="depositForm" action="{{route('new_withdrawal')}}" method="post" id="withdrawalForm">
            @csrf
            <div class="payment-list" role="radiogroup" aria-label="Payment method">
              <div class="section-heading">
                <p>Wallet Address</p>
              </div>
              <div class="input-group flex-nowrap">
                <input name="address" id="withdrawalAddress" type="text" class="form-control bg-dark text-light" aria-label="Username" aria-describedby="addon-wrapping" required>
              </div>
              <div class="section-heading">
                <p>Withdrawal Amount</p>
              </div>
              <div class="input-group flex-nowrap">
                <input name="amout" id="amount" type="number" min="1" step="any" class="form-control bg-dark text-light" aria-label="Username" aria-describedby="addon-wrapping" required>
                
              </div>
              <h6>
                <span class="text-secondary" id="error">Available Balance:</span>
                <span class="text-success" id="balance"> 
                  @if($amout)
                    {{$amout->amout}}
                  @else
                    0
                  @endif
                </span>
                <span class="text-success">USDT</span>
                <div class="form-feedback" id="formFeedback" role="status" aria-live="polite"></div>
              </h6>
            </div>
            
            <button type="submit" class="continue-button "><span>Withdrawal</span><svg viewBox="0 0 24 24"><path d="M4 12h15m-6-6 6 6-6 6"/></svg></button>
          </form>
        </div>
      </section>
      <div class="card col-md-3 ms-3 deposit-panel" style="width: 18rem;">
        <ul class="list-group list-group-flush pt-5">
          <li class="list-group-item bg-dark text-light">Network: BEP20 (BNB Smart Chain)</li>
          <li></li>
          <li class="list-group-item bg-dark text-light">Minimum Withdrawal:<h6 class="d-inline"> 1.05 USDT </h6></li>
          <li></li>
          <li class="list-group-item bg-dark text-light">Network Fee:<h6 class="d-inline"> 0.5% </h6></li>
          <li></li>
          <li class="list-group-item bg-dark text-light">Processing Time:<h6 class="d-inline"> 6 – 12 hours </h6></li>
          <li></li>
        </ul>
      </div>
    </main>

@endsection
@section('withdrawal')
    active
@endsection