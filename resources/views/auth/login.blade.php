<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RepoHive | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>

<body>

    <div class="center-screen">
        <div class="card">
            <div class="brand">🐝 RepoHive App Hub</div>

            <h1>Welcome to RepoHive</h1>
            <p class="muted">
                Access your verification, mailbox, and AI assistant tools from one dashboard.
            </p>

            <a class="btn primary" href="{{ route('otp.phone') }}">📱 Send OTP via SMS</a>
            <a class="btn light" href="{{ route('otp.email') }}">📧 Send OTP via Email</a>
            <a class="btn light" href="{{ route('otp.validate') }}">🔐 Validate OTP</a>
            <a class="btn light" href="{{ route('mailbox') }}">📬 Open Mailbox</a>
            <a class="btn light" href="{{ route('chatbot') }}">🤖 AI Chatbot</a>

            <br>
            <hr>

            <button class="btn google" onclick="loginWithGoogle()">
                <img src="{{ asset('assets/Google_Favicon_2025.svg.webp') }}" alt="" height="32">
                Login with Google Account
            </button>

            <p class="note">
                Prototype pages are connected using simple HTML, CSS, JavaScript, and localStorage.
            </p>
        </div>
    </div>

    <script src="{{ asset('assets/app.js') }}"></script>
</body>

</html>