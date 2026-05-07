<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive | Send OTP via Phone</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="brand">📱 Phone Verification</div>
    <h1>Send OTP to Phone</h1>
    <p class="muted">Enter your phone number to receive a 6-digit code.</p>

    <label>Phone Number</label>
    <input id="phone" type="tel" placeholder="+63 9XX XXX XXXX">

    <button class="btn primary" onclick="sendPhoneOtp()">Send OTP</button>
    <a class="link" href="{{ route('login') }}">Back</a>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>