<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive | Send OTP via Email</title>
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
      bottom: -30%;
      left: -10%;
      width: 60vw;
      height: 60vw;
      background: radial-gradient(circle, rgba(91,140,255,0.07) 0%, transparent 70%);
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
      background: rgba(91,140,255,0.1);
      border: 1px solid rgba(91,140,255,0.25);
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
      color: #5b8cff;
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
      margin-bottom: 32px;
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

    label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      color: #7c7c94;
      margin-bottom: 10px;
    }

    input[type="email"] {
      width: 100%;
      padding: 16px 18px;
      background: #16161a;
      border: 1px solid #2a2a35;
      border-radius: 14px;
      color: #f0eff4;
      font-family: 'DM Sans', sans-serif;
      font-size: 16px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      margin-bottom: 20px;
    }

    input[type="email"]:focus {
      border-color: #5b8cff;
      box-shadow: 0 0 0 3px rgba(91,140,255,0.12);
    }

    input::placeholder { color: #7c7c94; }

    .field-error {
      color: #ff5c5c;
      font-size: 13px;
      margin-top: -14px;
      margin-bottom: 16px;
    }

    .btn.primary {
      width: 100%;
      padding: 16px;
      background: #5b8cff;
      border: none;
      border-radius: 14px;
      color: #fff;
      font-family: 'Syne', sans-serif;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
      margin-bottom: 20px;
    }

    .btn.primary:hover {
      background: #7aa3ff;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(91,140,255,0.3);
    }

    .links-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 4px;
    }

    .link {
      color: #7c7c94;
      font-size: 14px;
      text-decoration: none;
      transition: color 0.2s;
    }

    .link:hover { color: #5b8cff; }
  </style>
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="icon-wrap">📧</div>
    <div class="brand">Email Verification</div>
    <h1>Send OTP to Email</h1>
    <p class="muted">Enter your email address to receive a 6-digit verification code in your inbox.</p>

    @if(session('email_error'))
      <div class="error">{{ session('email_error') }}</div>
    @endif

    @if(session('error'))
      <div class="error">{{ session('error') }}</div>
    @endif

    @if(session('success'))
      <div class="success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('otp.email.send') }}">
      @csrf
      <label for="email">Email Address</label>
      <input
        id="email"
        name="email"
        type="email"
        placeholder="example@company.com"
        autocomplete="email"
        value="{{ old('email') }}"
        required
      >

      @error('email')
        <p class="field-error">{{ $message }}</p>
      @enderror

      <button class="btn primary" type="submit">Send OTP →</button>
    </form>

    <div class="links-row">
      <a class="link" href="{{ route('otp.phone') }}">📱 Use phone instead</a>
      <a class="link" href="{{ route('login') }}">← Back to hub</a>
    </div>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>