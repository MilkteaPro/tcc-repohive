<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive | Validate OTP</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="brand">🔐 OTP Verification</div>
    <h1>Validate OTP</h1>
    <p class="muted">
      Code sent to: <strong>{{ session('otp_target') }}</strong>
    </p>

    @if(session('error'))
      <div class="error">{{ session('error') }}</div>
    @endif

    @if(session('success'))
      <div class="success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
      @csrf
      <div class="otp-box">
        <input maxlength="1" class="otp" name="otp1" oninput="moveNext(this)">
        <input maxlength="1" class="otp" name="otp2" oninput="moveNext(this)">
        <input maxlength="1" class="otp" name="otp3" oninput="moveNext(this)">
        <input maxlength="1" class="otp" name="otp4" oninput="moveNext(this)">
        <input maxlength="1" class="otp" name="otp5" oninput="moveNext(this)">
        <input maxlength="1" class="otp" name="otp6" oninput="moveNext(this)">
      </div>
      <input type="hidden" name="otp" id="otpFinal">
      <button class="btn primary" type="submit" onclick="combineOtp()">Verify OTP</button>
    </form>

    <p id="message" class="muted center"></p>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
<script>
  function moveNext(el) {
    el.value = el.value.replace(/\D/g, '');
    if (el.value && el.nextElementSibling) {
      el.nextElementSibling.focus();
    }
  }

  function combineOtp() {
    const boxes = document.querySelectorAll('.otp');
    let otp = '';
    boxes.forEach(b => otp += b.value);
    document.getElementById('otpFinal').value = otp;
  }
</script>
</body>
</html>