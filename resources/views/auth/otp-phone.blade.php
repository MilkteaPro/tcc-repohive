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

    @if(session('sms_error'))
      <div class="error">{{ session('sms_error') }}</div>
    @endif

    @if(session('error'))
      <div class="error">{{ session('error') }}</div>
    @endif

    @if(session('success'))
      <div class="success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('otp.phone.send') }}">
      @csrf
      <label for="phone">Phone Number</label>
      <input
        id="phone"
        name="phone"
        type="tel"
        placeholder="+63 900 000 0000"
        autocomplete="tel"
        value="{{ old('phone') }}"
        required
      >

      @error('phone')
        <p class="field-error">{{ $message }}</p>
      @enderror

      <button class="btn primary" type="submit">Send OTP</button>
    </form>

    <a class="link" href="{{ route('otp.email') }}">Use email instead</a>
    <a class="link" href="{{ route('login') }}">Back to hub</a>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>