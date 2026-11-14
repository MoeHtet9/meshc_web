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

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <form id="otpForm" method="POST" action="{{ route('otp.verify') }}">
            @csrf

            <input class="text-center form-control" autofocus type="otp" name="otp" id="otp" placeholder="Enter 6-digit OTP" maxlength="6" required>

            <div id="otp-error" class="text-danger mt-2"></div>

            <button type="submit" id="verifyBtn" class="btn btn-success container">
                Verify OTP
            </button>
        </form>

        <div class="text-center mt-3">
            <span class="text-muted" id="message">OTP သက်တမ်း</span>
            <h4 id="timer">01:00</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="hidden" name="email" value="{{$email}}">

                <input type="hidden" name="password" value="{{$password}}">

                <button class="btn submit-btn" type="submit"><span id="submit-label">Resend OTP</span><span class="arrow">→</span></button>
            </form>
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

    document.getElementById('otpForm').addEventListener('submit', async function(e) {

        e.preventDefault();

        const form = this;
        const errorBox = document.getElementById('otp-error');
        const button = document.getElementById('verifyBtn');

        errorBox.innerText = '';
        button.disabled = true;
        button.innerText = 'Verifying...';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: new FormData(form)
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                errorBox.innerText = data.message || 'Something went wrong.';
                return;
            }

            if (data.redirect) {
                window.location.href = data.redirect;
            }

        } catch (error) {
            errorBox.innerText = 'Something went wrong. Please try again.';
        } finally {
            button.disabled = false;
            button.innerText = 'Verify OTP';
        }

    });

</script>

</body>
</html>