<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <h3 class="text-center mb-3">Email Verification</h3>

        <p class="text-center text-muted">
            Gmail ကို ပို့ထားတဲ့ OTP Code 6 လုံး ထည့်ပါ။
        </p>

        <form id="otpForm" action="{{route('otp.verify')}}" method="post">

            @csrf

            <input
                type="text"
                name="otp"
                id="otp"
                class="form-control text-center mb-3"
                placeholder="Enter 6 Digit OTP"
                maxlength="6"
                inputmode="numeric"
                required
                autofocus
            >

            <button type="submit" class="btn btn-primary w-100">
                Verify OTP
            </button>

        </form>

        <div class="text-center mt-3">
            <span class="text-muted" id="message">OTP သက်တမ်း</span>
            <h4 id="timer">01:00</h4>
            <a href="/" id="resendOtp" class="btn btn-link p-0" style="display: none;">Resend OTP</a>
        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
let timeLeft = 60;

setInterval(function () {

    if (timeLeft > 0) {
        timeLeft--;
    } else {
        $('#message').html('<div class="alert alert-danger">OTP သက်တမ်းကုန်သွားပါပြီ။</div>');
        $('#otpForm').hide();
        $('#resendOtp').show();
    }

    let minutes = Math.floor(timeLeft / 60);
    let seconds = timeLeft % 60;

    $('#timer').text(
        String(minutes).padStart(2, '0') + ':' +
        String(seconds).padStart(2, '0')
    );

}, 1000);
</script>

</body>
</html>