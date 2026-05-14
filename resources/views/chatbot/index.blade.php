<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive | AI Chatbot</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      height: 100%;
      background: #0d0d0f !important;
      font-family: 'DM Sans', sans-serif;
      color: #f0eff4;
      overflow: hidden;
    }

    .chatbot-only-page {
      display: flex;
      flex-direction: column;
      height: 100vh;
      background: #0d0d0f;
    }

    .chat-panel {
      display: flex;
      flex-direction: column;
      height: 100vh;
      max-width: 860px;
      width: 100%;
      margin: 0 auto;
      background: #0d0d0f;
    }

    .chat-header {
      padding: 18px 28px;
      background: #16161a;
      border-bottom: 1px solid #2a2a35;
      display: flex;
      align-items: center;
      gap: 14px;
      flex-shrink: 0;
    }

    .back-nav {
      color: #7c7c94;
      text-decoration: none;
      font-size: 13px;
      display: flex;
      align-items: center;
      gap: 4px;
      transition: color 0.2s;
    }

    .back-nav:hover { color: #f0eff4; }

    .topbar-divider {
      width: 1px;
      height: 20px;
      background: #2a2a35;
    }

    .ai-orb {
      width: 44px;
      height: 44px;
      background: rgba(91,140,255,0.15);
      border: 2px solid rgba(91,140,255,0.3);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      flex-shrink: 0;
    }

    .header-info { flex: 1; }

    .chat-header h2 {
      font-family: 'Syne', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #f0eff4;
      margin: 0;
    }

    .chat-header small {
      font-size: 12px;
      color: #4ade80;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .chat-header small::before {
      content: '';
      width: 6px;
      height: 6px;
      background: #4ade80;
      border-radius: 50%;
      display: inline-block;
      animation: pulse 2s infinite;
    }

    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

    .chat-window {
      flex: 1;
      overflow-y: auto;
      padding: 28px;
      display: flex;
      flex-direction: column;
      gap: 18px;
      background: #0d0d0f;
    }

    .chat-window::-webkit-scrollbar { width: 4px; }
    .chat-window::-webkit-scrollbar-thumb { background: #2a2a35; border-radius: 2px; }

    .chat-message {
      display: flex;
      gap: 12px;
      max-width: 78%;
      animation: msgIn 0.3s ease;
    }

    @keyframes msgIn {
      from { opacity:0; transform: translateY(8px); }
      to { opacity:1; transform: translateY(0); }
    }

    .chat-message.user {
      align-self: flex-end;
      flex-direction: row-reverse;
    }

    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: rgba(91,140,255,0.15);
      border: 1px solid rgba(91,140,255,0.3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
      margin-top: 2px;
    }

    .chat-message.user .avatar {
      background: rgba(240,192,64,0.15);
      border: 1px solid rgba(240,192,64,0.3);
    }

    .msg-content {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .bubble {
      padding: 13px 17px;
      border-radius: 18px;
      font-size: 14px;
      line-height: 1.7;
    }

    .chat-message.bot .bubble {
      background: #1e1e24;
      border: 1px solid #2a2a35;
      border-top-left-radius: 4px;
      color: #f0eff4;
    }

    .chat-message.user .bubble {
      background: #5b8cff;
      color: #fff;
      border-top-right-radius: 4px;
    }

    .msg-time {
      font-size: 11px;
      color: #7c7c94;
      padding: 0 4px;
    }

    .chat-message.user .msg-time { text-align: right; }

    .suggestions {
      padding: 0 28px 16px;
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      background: #0d0d0f;
      flex-shrink: 0;
    }

    .suggestion {
      padding: 8px 16px;
      background: #1e1e24;
      border: 1px solid #2a2a35;
      border-radius: 20px;
      font-size: 13px;
      color: #7c7c94;
      cursor: pointer;
      transition: all 0.2s;
      white-space: nowrap;
      font-family: 'DM Sans', sans-serif;
    }

    .suggestion:hover {
      border-color: #f0c040;
      color: #f0c040;
      background: rgba(240,192,64,0.06);
    }

    .typing-dots {
      display: flex;
      gap: 4px;
      padding: 14px 17px;
      background: #1e1e24;
      border: 1px solid #2a2a35;
      border-radius: 18px;
      border-top-left-radius: 4px;
    }

    .typing-dots span {
      width: 7px;
      height: 7px;
      background: #7c7c94;
      border-radius: 50%;
      animation: typingBounce 1.2s ease infinite;
    }

    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typingBounce {
      0%,80%,100%{transform:scale(0.8);opacity:0.5}
      40%{transform:scale(1.1);opacity:1}
    }

    .chat-input-bar {
      padding: 18px 28px;
      background: #16161a;
      border-top: 1px solid #2a2a35;
      display: flex;
      gap: 12px;
      align-items: center;
      flex-shrink: 0;
    }

    #chatInput {
      flex: 1;
      padding: 13px 18px;
      background: #1e1e24;
      border: 1px solid #2a2a35;
      border-radius: 14px;
      color: #f0eff4;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      outline: none;
      transition: border-color 0.2s;
    }

    #chatInput:focus { border-color: #5b8cff; }
    #chatInput::placeholder { color: #7c7c94; }

    .chat-input-bar button {
      padding: 13px 24px;
      background: #5b8cff;
      border: none;
      border-radius: 14px;
      color: #fff;
      font-family: 'Syne', sans-serif;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
    }

    .chat-input-bar button:hover {
      background: #7aa3ff;
      transform: translateY(-1px);
    }
  </style>
</head>
<body>

<div class="chatbot-only-page">
  <main class="chat-panel">
    <header class="chat-header">
      <a class="back-nav" href="{{ route('login') }}">← Hub</a>
      <div class="topbar-divider"></div>
      <div class="ai-orb">🤖</div>
      <div class="header-info">
        <h2>RepoHive AI Assistant</h2>
        <small>Online • Ready to help</small>
      </div>
    </header>

    <section class="chat-window" id="chatWindow">
      <!-- Messages load here -->
    </section>

    <div class="suggestions" id="suggestions">
      <div class="suggestion" onclick="sendSuggestion(this)">What is OTP?</div>
      <div class="suggestion" onclick="sendSuggestion(this)">What is RepoHive?</div>
      <div class="suggestion" onclick="sendSuggestion(this)">How does mailbox work?</div>
      <div class="suggestion" onclick="sendSuggestion(this)">What is email verification?</div>
    </div>

    <footer class="chat-input-bar">
      <input id="chatInput" placeholder="Type your message..." onkeydown="handleChatKey(event)">
      <button onclick="sendChat()">Send</button>
    </footer>
  </main>
</div>

<script>
  const knowledge = {
    'what is otp': 'OTP stands for One-Time Password. It is a 6-digit code sent to your phone or email to verify your identity.',
    'otp': 'OTP (One-Time Password) is a temporary 6-digit code used to verify your identity. RepoHive supports OTP via SMS and Email.',
    'otp verification': 'OTP Verification confirms your identity by entering the 6-digit code sent to your phone or email.',
    'how does otp work': 'When you request an OTP, RepoHive sends a 6-digit code to your phone or email. You enter that code on the Validate OTP page.',
    'otp code': 'A random 6-digit OTP code is generated and sent to your phone or email every time you request one.',
    'validate otp': 'To validate OTP, go to the Validate OTP page, enter the 6-digit code you received, and click Verify.',
    'otp expired': 'OTP codes expire after a short time for security. Simply request a new one if expired.',
    'otp via sms': 'OTP via SMS sends a 6-digit verification code to your mobile phone number via text message.',
    'otp via email': 'OTP via Email sends a 6-digit verification code to your email address inbox.',
    'what is repohive': 'RepoHive is an all-in-one web application hub that provides OTP Authentication, Mailbox System, and AI Chatbot tools. Built using Laravel.',
    'repohive': 'RepoHive is your all-in-one hub for verification, mailbox, and AI assistant tools. Tagline: Build Together. Ship Faster. 🐝',
    'what is mailbox': 'The RepoHive Mailbox is a simulated email system where you can view inbox, compose emails, and check sent history.',
    'mailbox': 'The Mailbox lets you view Inbox, Sent, Drafts, and Archived messages. You can also compose new emails.',
    'how does mailbox work': 'The RepoHive Mailbox stores emails using localStorage. View inbox messages, compose new emails, and track sent history.',
    'compose email': 'To compose an email, open Mailbox and click Compose. Fill in recipient, subject, and message then click Send.',
    'inbox': 'Your Inbox shows all received messages including welcome emails, OTP confirmations, and workspace invitations.',
    'what is email verification': 'Email verification confirms you own an email address. RepoHive sends a 6-digit OTP code to your email.',
    'email verification': 'Email verification confirms your email is valid. Enter your email, receive an OTP, then enter it on Validate OTP page.',
    'email action': 'Email actions include receiving OTP codes, welcome messages, workspace invitations, and system notifications.',
    'what is authentication': 'Authentication verifies who you are. RepoHive uses OTP Authentication instead of a password.',
    'google login': 'Google Login in RepoHive is a simulated feature. It does not connect to real Google services in the prototype.',
    'login': 'You can log in to RepoHive using OTP via Phone, OTP via Email, or simulated Google Login.',
    'workspace': 'RepoHive workspace is where your team collaborates. You receive workspace invitations via the Mailbox.',
    'workspace updates': 'Workspace updates include project invitations, team notifications, and system messages in your Mailbox.',
    'laravel': 'Laravel is the PHP framework used to build the RepoHive application. It provides routing, Blade templates, and backend functionality.',
    'what is laravel': 'Laravel is a PHP framework providing structured routing, Blade templates, and backend functionality for RepoHive.',
    'features': 'RepoHive has 4 main features: 1) OTP via SMS, 2) OTP via Email, 3) Mailbox System, 4) AI Chatbot.',
    'help': 'I can help you with OTP verification, Mailbox usage, Email verification, Google Login, and RepoHive features. Just ask!',
    'what can you do': 'I can answer questions about OTP, Mailbox, Email Verification, Google Login, Laravel, and all RepoHive features!',
    'hi': 'Hello! 👋 Welcome to RepoHive AI Assistant. How can I help you today?',
    'hello': 'Hi there! 👋 Ask me anything about OTP, Mailbox, or any RepoHive feature!',
    'hey': 'Hey! 😊 How can I assist you with RepoHive today?',
    'good morning': 'Good morning! ☀️ How can I help you with RepoHive today?',
    'good afternoon': 'Good afternoon! 😊 What can I help you with?',
    'good evening': 'Good evening! 🌙 How can I assist you today?',
    'how are you': 'I am doing great and ready to help! 😊 What would you like to know about RepoHive?',
    'thank you': 'You\'re welcome! 😊 Feel free to ask more questions!',
    'thanks': 'Happy to help! 😊 Anything else you want to know?',
    'bye': 'Goodbye! 👋 Come back anytime you need help with RepoHive!',
  };

  function getTime() {
    return new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
  }

  function getKnowledgeReply(msg) {
    const m = msg.toLowerCase().trim();
    if (knowledge[m]) return knowledge[m];
    for (const key in knowledge) {
      if (m.includes(key) || key.includes(m)) return knowledge[key];
    }
    if (m.includes('otp') && m.includes('phone')) return knowledge['otp via sms'];
    if (m.includes('otp') && m.includes('email')) return knowledge['otp via email'];
    if (m.includes('otp') && m.includes('expire')) return knowledge['otp expired'];
    if (m.includes('otp') && m.includes('valid')) return knowledge['validate otp'];
    if (m.includes('otp') && m.includes('code')) return knowledge['otp code'];
    if (m.includes('otp')) return knowledge['otp'];
    if (m.includes('mail') || m.includes('inbox')) return knowledge['mailbox'];
    if (m.includes('compose')) return knowledge['compose email'];
    if (m.includes('email') && m.includes('verif')) return knowledge['email verification'];
    if (m.includes('email')) return knowledge['email action'];
    if (m.includes('google')) return knowledge['google login'];
    if (m.includes('laravel')) return knowledge['laravel'];
    if (m.includes('workspace')) return knowledge['workspace'];
    if (m.includes('feature')) return knowledge['features'];
    if (m.includes('repohive')) return knowledge['repohive'];
    if (m.includes('help')) return knowledge['help'];
    if (m.includes('hi') || m.includes('hello') || m.includes('hey')) return knowledge['hi'];
    if (m.includes('thank')) return knowledge['thank you'];
    if (m.includes('bye') || m.includes('goodbye')) return knowledge['bye'];
    return "I'm not sure about that. Try asking about OTP, Mailbox, Email verification, or type 'help'! 😊";
  }

  function appendMsg(text, role) {
    const chatWindow = document.getElementById('chatWindow');
    const div = document.createElement('div');
    div.className = 'chat-message ' + role;
    div.innerHTML =
      '<div class="avatar">' + (role === 'bot' ? '🤖' : '👤') + '</div>' +
      '<div class="msg-content">' +
        '<div class="bubble">' + text + '</div>' +
        '<div class="msg-time">' + getTime() + '</div>' +
      '</div>';
    chatWindow.appendChild(div);
    chatWindow.scrollTop = chatWindow.scrollHeight;
  }

  function showTyping() {
    const chatWindow = document.getElementById('chatWindow');
    const div = document.createElement('div');
    div.className = 'chat-message bot';
    div.id = 'typing';
    div.innerHTML = '<div class="avatar">🤖</div><div class="typing-dots"><span></span><span></span><span></span></div>';
    chatWindow.appendChild(div);
    chatWindow.scrollTop = chatWindow.scrollHeight;
  }

  function hideTyping() {
    const t = document.getElementById('typing');
    if (t) t.remove();
  }

  function sendChat() {
    const input = document.getElementById('chatInput');
    const text = input.value.trim();
    if (!text) return;
    input.value = '';
    const sugg = document.getElementById('suggestions');
    if (sugg) sugg.style.display = 'none';
    appendMsg(text, 'user');
    showTyping();
    setTimeout(function() {
      hideTyping();
      appendMsg(getKnowledgeReply(text), 'bot');
    }, 800 + Math.random() * 500);
  }

  function sendSuggestion(el) {
    document.getElementById('chatInput').value = el.textContent;
    sendChat();
  }

  function handleChatKey(e) {
    if (e.key === 'Enter') sendChat();
  }

  // Show welcome message on load
  window.onload = function() {
    appendMsg('Hi! I\'m your RepoHive AI Assistant. How can I help you today? 👋', 'bot');
  };
</script>
</body>
</html>