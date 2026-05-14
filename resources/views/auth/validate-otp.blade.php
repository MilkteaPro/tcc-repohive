<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive | Validate OTP</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: #0d0d0f;
      font-family: 'DM Sans', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      top: -20%;
      left: 50%;
      transform: translateX(-50%);
      width: 80vw;
      height: 40vw;
      background: radial-gradient(ellipse, rgba(240,192,64,0.06) 0%, transparent 70%);
      pointer-events: none;
    }

    .center-screen {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 520px;
      padding: 24px;
      animation: fadeUp 0.5s ease both;
    }

    @keyframes fadeUp {
      from { opacity:0; transform: translateY(20px); }
      to { opacity:1; transform: translateY(0); }
    }

    .card {
      background: #1e1e24;
      border: 1px solid #2a2a35;
      border-radius: 28px;
      padding: 48px 44px;
      box-shadow: 0 32px 80px rgba(0,0,0,0.5);
    }

    .icon-wrap {
      width: 64px;
      height: 64px;
      background: rgba(240,192,64,0.12);
      border: 1px solid rgba(240,192,64,0.25);
      border-radius: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      margin-bottom: 24px;
    }

    .brand {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: #f0c040;
      margin-bottom: 10px;
    }

    h1 {
      font-family: 'Syne', sans-serif;
      font-size: 32px;
      font-weight: 800;
      color: #f0eff4;
      letter-spacing: -1px;
      margin-bottom: 10px;
    }

    .muted {
      color: #7c7c94;
      font-size: 15px;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    .muted strong {
      color: #f0eff4;
      font-weight: 600;
    }

    .error {
      background: rgba(255,92,92,0.1);
      border: 1px solid rgba(255,92,92,0.3);
      color: #ff5c5c;
      padding: 12px 16px;
      border-radius: 12px;
      font-size: 14px;
      margin-bottom: 16px;
    }

    .success {
      background: rgba(74,222,128,0.1);
      border: 1px solid rgba(74,222,128,0.3);
      color: #4ade80;
      padding: 12px 16px;
      border-radius: 12px;
      font-size: 14px;
      margin-bottom: 16px;
    }

    .otp-box {
      display: flex;
      gap: 12px;
      justify-content: center;
      margin-bottom: 32px;
    }

    .otp {
      width: 60px;
      height: 68px;
      background: #16161a;
      border: 2px solid #2a2a35;
      border-radius: 16px;
      color: #f0eff4;
      font-family: 'Syne', sans-serif;
      font-size: 24px;
      font-weight: 700;
      text-align: center;
      outline: none;
      transition: all 0.2s;
    }

    .otp:focus {
      border-color: #f0c040;
      box-shadow: 0 0 0 3px rgba(240,192,64,0.15);
      background: #222228;
    }

    .btn.primary {
      width: 100%;
      padding: 16px;
      background: #f0c040;
      border: none;
      border-radius: 14px;
      color: #0d0d0f;
      font-family: 'Syne', sans-serif;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
      margin-bottom: 20px;
    }

    .btn.primary:hover {
      background: #f5cc55;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(240,192,64,0.3);
    }

    .center {
      text-align: center;
      font-size: 14px;
      color: #7c7c94;
    }

    .back-link {
      display: block;
      text-align: center;
      color: #7c7c94;
      font-size: 14px;
      text-decoration: none;
      transition: color 0.2s;
      margin-top: 8px;
    }

    .back-link:hover { color: #f0c040; }
  </style>
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="icon-wrap">🔐</div>
    <div class="brand">OTP Verification</div>
    <h1>Validate OTP</h1>
    <p class="muted">
      Code sent to: <strong>{{ session('otp_target') ?? 'your device' }}</strong>
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
        <input maxlength="1" class="otp" name="otp1" oninput="moveNext(this)" inputmode="numeric">
        <input maxlength="1" class="otp" name="otp2" oninput="moveNext(this)" inputmode="numeric">
        <input maxlength="1" class="otp" name="otp3" oninput="moveNext(this)" inputmode="numeric">
        <input maxlength="1" class="otp" name="otp4" oninput="moveNext(this)" inputmode="numeric">
        <input maxlength="1" class="otp" name="otp5" oninput="moveNext(this)" inputmode="numeric">
        <input maxlength="1" class="otp" name="otp6" oninput="moveNext(this)" inputmode="numeric">
      </div>
      <input type="hidden" name="otp" id="otpFinal">
      <button class="btn primary" type="submit" onclick="combineOtp()">Verify OTP →</button>
    </form>

    <p id="message" class="muted center"></p>
    <a class="back-link" href="{{ route('login') }}">← Back to hub</a>
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