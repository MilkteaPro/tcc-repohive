<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RepoHive | Home</title>
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
            top: -40%;
            left: -20%;
            width: 70vw;
            height: 70vw;
            background: radial-gradient(circle, rgba(91,140,255,0.08) 0%, transparent 70%);
            animation: drift 12s ease-in-out infinite alternate;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -30%;
            right: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, rgba(240,192,64,0.07) 0%, transparent 70%);
            animation: drift 16s ease-in-out infinite alternate-reverse;
            pointer-events: none;
        }

        @keyframes drift {
            from { transform: translate(0,0) scale(1); }
            to { transform: translate(40px,30px) scale(1.1); }
        }

        .center-screen {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 560px;
            padding: 24px;
            animation: fadeUp 0.6s ease both;
        }

        @keyframes fadeUp {
            from { opacity:0; transform: translateY(24px); }
            to { opacity:1; transform: translateY(0); }
        }

        .card {
            background: #1e1e24;
            border: 1px solid #2a2a35;
            border-radius: 28px;
            padding: 52px 48px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.5);
        }

        .brand {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: #f0c040;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        h1 {
            font-family: 'Syne', sans-serif;
            font-size: 36px;
            font-weight: 800;
            color: #f0eff4;
            letter-spacing: -1px;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .muted {
            color: #7c7c94;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .section-label {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #7c7c94;
            margin-bottom: 12px;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 22px;
            border-radius: 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 12px;
            width: 100%;
        }

        .btn.primary {
            background: #f0c040;
            color: #0d0d0f;
            font-weight: 700;
        }

        .btn.primary:hover {
            background: #f5cc55;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(240,192,64,0.3);
        }

        .btn.light {
            background: #16161a;
            color: #f0eff4;
            border: 1px solid #2a2a35;
        }

        .btn.light:hover {
            background: #2a2a35;
            transform: translateY(-2px);
        }

        hr {
            border: none;
            border-top: 1px solid #2a2a35;
            margin: 24px 0;
        }

        .btn.google {
            background: #16161a;
            color: #f0eff4;
            border: 1px solid #2a2a35;
            justify-content: center;
            width: 100%;
            padding: 16px;
            border-radius: 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn.google:hover {
            background: #2a2a35;
            transform: translateY(-2px);
        }

        .note {
            text-align: center;
            font-size: 13px;
            color: #7c7c94;
            margin-top: 20px;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <div class="center-screen">
        <div class="card">
            <div class="brand">🐝 RepoHive App Hub</div>

            <h1>Welcome to RepoHive</h1>
            <p class="muted">
                Access your verification, mailbox, and AI assistant tools from one dashboard.
            </p>

            <div class="section-label">OTP Authentication</div>
            <a class="btn primary" href="{{ route('otp.phone') }}">📱 Send OTP via SMS</a>
            <a class="btn light" href="{{ route('otp.email') }}">📧 Send OTP via Email</a>
            <a class="btn light" href="{{ route('otp.validate') }}">🔐 Validate OTP</a>

            <div class="section-label" style="margin-top:20px;">Tools</div>
            <a class="btn light" href="{{ route('mailbox') }}">📬 Open Mailbox</a>
            <a class="btn light" href="{{ route('chatbot') }}">🤖 AI Chatbot</a>

            <hr>

            <button class="btn google" onclick="loginWithGoogle()">
                <img src="{{ asset('assets/Google_Favicon_2025.svg.webp') }}" alt="" height="24">
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