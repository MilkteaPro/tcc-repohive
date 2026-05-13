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

      <button class="btn primary" type="submit">Send OTP</button>
    </form>

    <a class="link" href="{{ route('otp.phone') }}">Use phone instead</a>
    <a class="link" href="{{ route('login') }}">Back to hub</a>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>