@extends('layouts.main')
@section('main')
    <main class="main-content">
      <section class="deposit-panel" aria-label="USDT deposit">
        <div class="asset-summary"><div class="usdt-icon"><span>₮</span></div><div><h2>USDT</h2><p>Network: BEP20 (BNB Smart Chain)</p></div><span class="network-pill">BEP20</span></div>
        <div class="payment-section">
          <form id="depositForm" action="{{route('new_deposit')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="payment-list" role="radiogroup" aria-label="Payment method">
              <div class="section-heading">
                <p>Address</p>
              </div>
              <div class="input-group mb-3">
                <input id="myText" value="0x3998AA25Ecb3C377b136E227FB6558c0a9569d35" readonly class="form-control bg-dark text-light" aria-label="Recipient’s username" aria-describedby="button-addon2" >
                <button class="btn btn-outline-secondary text-light" type="button" id="button-addon2" onclick="copyText()">Copy</button>
              </div>

              <!-- DEPOSIT AMOUNT -->
              <div class="section-heading mt-3">
                <p>Choose Amount</p>
              </div>
              <div class="d-flex mb-3 overflow-auto">
                <input type="radio" class="btn-check" name="amout" id="option1" autocomplete="off" checked required value="1">
                <label class="btn text-info ms-3" for="option1">1 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option2" autocomplete="off" required value="3">
                <label class="btn text-info ms-3" for="option2">3 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option3" autocomplete="off" required value="5">
                <label class="btn text-info ms-3" for="option3">5 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option4" autocomplete="off" required value="15">
                <label class="btn text-info ms-3" for="option4">15 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option5" autocomplete="off" required value="25">
                <label class="btn text-info ms-3" for="option5">25 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option6" autocomplete="off" required value="30">
                <label class="btn text-info ms-3" for="option6">30 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option7" autocomplete="off" required value="50">
                <label class="btn text-info ms-3" for="option7">50 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option8" autocomplete="off" required value="80">
                <label class="btn text-info ms-3" for="option8">80 USDT</label>

                <input type="radio" class="btn-check" name="amout" id="option9" autocomplete="off" required value="100">
                <label class="btn text-info ms-3" for="option9">100 USDT</label>
              </div>

              <div class="section-heading">
                <p>Please send me a screenshot once you've completed the transfer.</p>
              </div>
              <div class="input-group">
                <input required name="payment_ss" type="file" class="form-control bg-dark text-light paymentScreenshot" aria-describedby="inputGroupFileAddon04" aria-label="Upload" accept="image/*" id="image">
              </div>
            </div>
            <div class="form-feedback" id="formFeedback" role="status" aria-live="polite"></div>
            <button type="submit" class="continue-button continueButton" disabled><span>Deposit</span><svg viewBox="0 0 24 24"><path d="M4 12h15m-6-6 6 6-6 6"/></svg></button>
          </form>
        </div>
      </section>
    </main>
    <script>
      function copyText() {
        const text = document.getElementById("myText").value;

        navigator.clipboard.writeText(text)
          .then(() => alert("Copy!"))
          .catch(() => alert("Copy မအောင်မြင်ပါ"));
      }
    </script>
@endsection
@section('deposit')
    active
@endsection