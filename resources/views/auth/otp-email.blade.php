<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive | Send OTP via Email</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="brand">📧 Email Verification</div>
    <h1>Send OTP to Email</h1>
    <p class="muted">Enter your email address to receive a 6-digit code.</p>

    <label>Email Address</label>
    <input id="email" type="email" placeholder="example@company.com">

    <button class="btn primary" onclick="sendEmailOtp()">Send OTP</button>
    <a class="link" href="{{ route('login') }}">Back</a>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>