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
            background: #0a0a0a;
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated canvas background */
        #bg-canvas {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        /* Gradient orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.18;
            pointer-events: none;
            z-index: 0;
        }

        .orb-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, #3a5fff, transparent);
            top: -200px; left: -150px;
            animation: floatOrb1 18s ease-in-out infinite alternate;
        }

        .orb-2 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #f0c040, transparent);
            bottom: -150px; right: -100px;
            animation: floatOrb2 22s ease-in-out infinite alternate;
        }

        .orb-3 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #8b5cf6, transparent);
            top: 40%; left: 50%;
            transform: translate(-50%, -50%);
            animation: floatOrb3 26s ease-in-out infinite alternate;
        }

        @keyframes floatOrb1 {
            0%   { transform: translate(0px, 0px) scale(1); }
            33%  { transform: translate(60px, 40px) scale(1.08); }
            66%  { transform: translate(20px, 80px) scale(0.95); }
            100% { transform: translate(80px, 20px) scale(1.1); }
        }

        @keyframes floatOrb2 {
            0%   { transform: translate(0px, 0px) scale(1); }
            33%  { transform: translate(-50px, -30px) scale(1.1); }
            66%  { transform: translate(-80px, 20px) scale(0.92); }
            100% { transform: translate(-30px, -60px) scale(1.05); }
        }

        @keyframes floatOrb3 {
            0%   { transform: translate(-50%, -50%) scale(1); }
            50%  { transform: translate(-40%, -60%) scale(1.15); }
            100% { transform: translate(-60%, -40%) scale(0.9); }
        }

        /* Subtle grid lines */
        .grid-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridShift 30s linear infinite;
        }

        @keyframes gridShift {
            from { background-position: 0 0; }
            to { background-position: 60px 60px; }
        }

        /* Floating particles */
        .particles {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 2px; height: 2px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            animation: particleFloat linear infinite;
        }

        .particle:nth-child(1)  { left: 10%; animation-duration: 20s; animation-delay: 0s;   width: 3px; height: 3px; }
        .particle:nth-child(2)  { left: 20%; animation-duration: 25s; animation-delay: 3s; }
        .particle:nth-child(3)  { left: 35%; animation-duration: 18s; animation-delay: 6s;   width: 3px; height: 3px; }
        .particle:nth-child(4)  { left: 50%; animation-duration: 22s; animation-delay: 1s; }
        .particle:nth-child(5)  { left: 65%; animation-duration: 28s; animation-delay: 4s;   width: 3px; height: 3px; }
        .particle:nth-child(6)  { left: 75%; animation-duration: 19s; animation-delay: 7s; }
        .particle:nth-child(7)  { left: 85%; animation-duration: 24s; animation-delay: 2s;   width: 3px; height: 3px; }
        .particle:nth-child(8)  { left: 92%; animation-duration: 21s; animation-delay: 5s; }
        .particle:nth-child(9)  { left: 45%; animation-duration: 27s; animation-delay: 8s; }
        .particle:nth-child(10) { left: 58%; animation-duration: 23s; animation-delay: 9s;   width: 3px; height: 3px; }

        @keyframes particleFloat {
            0%   { bottom: -10px; opacity: 0; transform: translateX(0); }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.3; }
            100% { bottom: 110%; opacity: 0; transform: translateX(30px); }
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
            background: rgba(22, 22, 28, 0.75);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 28px;
            padding: 52px 48px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
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
            background: rgba(22, 22, 26, 0.8);
            color: #f0eff4;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .btn.light:hover {
            background: rgba(42, 42, 53, 0.9);
            transform: translateY(-2px);
        }

        hr {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin: 24px 0;
        }

        .btn.google {
            background: rgba(22, 22, 26, 0.8);
            color: #f0eff4;
            border: 1px solid rgba(255,255,255,0.08);
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
            background: rgba(42, 42, 53, 0.9);
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

    <!-- Animated background layers -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="grid-overlay"></div>
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

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