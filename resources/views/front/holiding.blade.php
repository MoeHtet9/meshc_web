@extends('layouts.main')
@section('main')
    <main class="page-content">
        <div class="page-heading">
          <div class="heading-row">
            <div class="mt-4">
              <h1>Add New Holding</h1>
              <p>Track your crypto holdings in one place. Simple, secure and built for the future.</p>
            </div>
            <div class="coin-orbit mt-5" aria-hidden="true">
              <span class="orbit-ring ring-one"></span><span class="orbit-ring ring-two"></span>
              <span class="orbit-coin ethereum">◆</span><span class="orbit-coin bitcoin">₿</span>
              <span class="orbit-coin tether">₮</span><span class="orbit-coin binance">✦</span>
              <span class="orbit-star star-one">✦</span><span class="orbit-star star-two">✧</span>
            </div>
          </div>
        </div>

        <section class="holding-card">
          <form id="holdingForm" novalidate action="{{route('new_holiding')}}" method="post">
            @csrf
            <div class="row g-4 form-grid">
              <div class="col-md-6 field-group">
                <label for="amount">Holiding Times <span class="required">*</span></label>
                <div class="d-flex mb-3 overflow-auto">
                    <input type="radio" class="btn-check" name="times" id="option1" autocomplete="off" checked required value="5">
                    <label class="btn text-info ms-3" for="option1">5 days</label>

                    <input type="radio" class="btn-check" name="times" id="option2" autocomplete="off" required value="10">
                    <label class="btn text-info ms-3" for="option2">10 days</label>

                    <input type="radio" class="btn-check" name="times" id="option3" autocomplete="off" required value="15">
                    <label class="btn text-info ms-3" for="option3">15 days</label>

                    <input type="radio" class="btn-check" name="times" id="option4" autocomplete="off" required value="30">
                    <label class="btn text-info ms-3" for="option4">30 days</label>
                </div>
              </div>

              <div class="col-md-6 field-group">
                <label for="amount">Amount <span class="required">*</span></label>
                <div class="input-shell mb-2"><i class="bi bi-stack field-icon"></i><input name="amout" id="amount" autofocus class="form-control custom-control" type="number" min="1" placeholder="Enter amount" required></div>
                <h6>
                    <span class="text-secondary">Available Balance:</span>
                    <span class="text-success">
                        <span id="availableBalance">{{ $amout->amout ?? 0 }}</span>
                        USDT
                    </span>
                </h6>
              </div>
              <div class="col-md-6 field-group">
                  <label for="totalValue">Total Value (USDT)</label>
                  <div class="input-shell readonly-shell">
                      <i class="bi bi-calculator field-icon"></i>
                      <input id="totalValue"
                            class="form-control custom-control"
                            type="text"
                            value="0.00"
                            readonly>
                  </div>
              </div>
              <div class="col-md-6 field-group">
                  <label for="dailyProfit">Daily Profit (USDT)</label>
                  <div class="input-shell readonly-shell">
                      <i class="bi bi-graph-up-arrow field-icon"></i>
                      <input id="dailyProfit"
                            class="form-control custom-control"
                            type="text"
                            value="0.00"
                            readonly>
                  </div>
              </div>
            </div>

            <div class="form-footer">
              <p class="form-feedback" id="formFeedback2" role="status"></p>
              <div class="action-buttons">
                <a href="{{route('main')}}" class="btn btn-outline-danger btn-sm">Cancel</a>
                <button type="submit" class="btn btn-sm btn-info"><i class="bi bi-plus-circle-fill"></i> Add Holding</button>
              </div>
            </div>
          </form>
        </section>
    </main>

@endsection
@section('holiding')
    active
@endsection