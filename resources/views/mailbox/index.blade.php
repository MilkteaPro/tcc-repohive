<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>RepoHive | Mailbox</title>
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

    .mailbox {
      display: flex;
      width: 100%;
      height: 100vh;
      background: #0d0d0f;
    }

    .sidebar {
      width: 260px;
      min-width: 260px;
      background: #16161a;
      border-right: 1px solid #2a2a35;
      display: flex;
      flex-direction: column;
      padding: 28px 18px;
      gap: 4px;
    }

    .brand {
      font-family: 'Syne', sans-serif;
      font-size: 20px;
      font-weight: 800;
      color: #f0c040;
      margin-bottom: 24px;
      padding: 0 10px;
    }

    .compose-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 13px;
      background: #f0c040;
      border: none;
      border-radius: 12px;
      color: #0d0d0f;
      font-family: 'Syne', sans-serif;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      margin-bottom: 24px;
      transition: all 0.2s;
    }

    .compose-btn:hover { background: #f5cc55; transform: translateY(-1px); }

    .nav-section {
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: #7c7c94;
      padding: 12px 10px 6px;
    }

    .menu {
      display: flex;
      align-items: center;
      padding: 11px 12px;
      border-radius: 10px;
      cursor: pointer;
      font-size: 14px;
      color: #7c7c94;
      text-decoration: none;
      transition: all 0.15s;
      margin-bottom: 2px;
    }

    .menu:hover { background: #1e1e24; color: #f0eff4; }

    .menu.active {
      background: #1e1e24;
      color: #f0eff4;
      border-left: 3px solid #f0c040;
      padding-left: 9px;
    }

    .menu span {
      margin-left: auto;
      background: #f0c040;
      color: #0d0d0f;
      font-size: 11px;
      font-weight: 700;
      padding: 2px 8px;
      border-radius: 20px;
    }

    .menu span.muted-badge {
      background: #2a2a35;
      color: #7c7c94;
    }

    .sidebar-footer { margin-top: auto; }

    .back-nav {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 11px 12px;
      border-radius: 10px;
      color: #7c7c94;
      font-size: 14px;
      text-decoration: none;
      transition: all 0.15s;
    }

    .back-nav:hover { color: #f0eff4; background: #1e1e24; }

    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      background: #0d0d0f;
    }

    .topbar {
      padding: 20px 28px;
      border-bottom: 1px solid #2a2a35;
      display: flex;
      align-items: center;
      gap: 16px;
      background: #16161a;
      flex-shrink: 0;
    }

    .topbar h2 {
      font-family: 'Syne', sans-serif;
      font-size: 20px;
      font-weight: 800;
      color: #f0eff4;
      margin: 0;
    }

    .topbar small { font-size: 13px; color: #7c7c94; }

    #searchMail {
      margin-left: auto;
      padding: 10px 16px;
      background: #1e1e24;
      border: 1px solid #2a2a35;
      border-radius: 10px;
      color: #f0eff4;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      outline: none;
      width: 220px;
      transition: border-color 0.2s;
    }

    #searchMail:focus { border-color: #f0c040; }
    #searchMail::placeholder { color: #7c7c94; }

    .mail-area { flex: 1; display: flex; overflow: hidden; }

    .mail-list {
      width: 320px;
      min-width: 320px;
      border-right: 1px solid #2a2a35;
      overflow-y: auto;
      background: #0d0d0f;
    }

    .mail-list::-webkit-scrollbar { width: 4px; }
    .mail-list::-webkit-scrollbar-thumb { background: #2a2a35; border-radius: 2px; }

    .mail-item {
      padding: 16px 20px;
      border-bottom: 1px solid #2a2a35;
      cursor: pointer;
      transition: background 0.15s;
      background: #0d0d0f;
    }

    .mail-item:hover { background: #1e1e24; }

    .mail-item.active {
      background: rgba(240,192,64,0.06);
      border-left: 3px solid #f0c040;
      padding-left: 17px;
    }

    .mail-row {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 6px;
    }

    .mail-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: #2a2a35;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      flex-shrink: 0;
    }

    .mail-sender { font-size: 14px; color: #7c7c94; flex: 1; }
    .mail-sender.unread { font-weight: 700; color: #f0eff4; }
    .mail-time { font-size: 11px; color: #7c7c94; }
    .mail-subject { font-size: 13px; font-weight: 600; color: #f0eff4; margin-bottom: 3px; }
    .mail-preview { font-size: 12px; color: #7c7c94; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    .unread-dot {
      width: 7px;
      height: 7px;
      background: #f0c040;
      border-radius: 50%;
      flex-shrink: 0;
    }

    .preview {
      flex: 1;
      padding: 32px;
      overflow-y: auto;
      background: #0d0d0f;
    }

    #previewTitle {
      font-family: 'Syne', sans-serif;
      font-size: 22px;
      font-weight: 800;
      color: #f0eff4;
      margin-bottom: 12px;
    }

    #previewMeta {
      font-size: 13px;
      color: #7c7c94;
      margin-bottom: 24px;
      padding-bottom: 24px;
      border-bottom: 1px solid #2a2a35;
    }

    #previewBody { font-size: 15px; color: #c8c8d8; line-height: 1.8; }

    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.7);
      z-index: 50;
      align-items: flex-end;
      justify-content: flex-end;
      padding: 24px;
    }

    .modal.open { display: flex; }

    .modal-card {
      width: 480px;
      background: #1e1e24;
      border: 1px solid #2a2a35;
      border-radius: 20px;
      box-shadow: 0 32px 80px rgba(0,0,0,0.6);
      padding: 28px;
      position: relative;
    }

    .modal-card h2 {
      font-family: 'Syne', sans-serif;
      font-size: 18px;
      font-weight: 800;
      color: #f0eff4;
      margin-bottom: 20px;
    }

    .close {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #2a2a35;
      border: none;
      color: #7c7c94;
      width: 32px;
      height: 32px;
      border-radius: 8px;
      font-size: 18px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
    }

    .close:hover { color: #f0eff4; background: #3a3a45; }

    .modal-card label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.8px;
      text-transform: uppercase;
      color: #7c7c94;
      margin-bottom: 8px;
      margin-top: 16px;
    }

    .modal-card input,
    .modal-card textarea {
      width: 100%;
      padding: 12px 16px;
      background: #16161a;
      border: 1px solid #2a2a35;
      border-radius: 10px;
      color: #f0eff4;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      outline: none;
      transition: border-color 0.2s;
    }

    .modal-card input:focus,
    .modal-card textarea:focus { border-color: #f0c040; }

    .modal-card input::placeholder,
    .modal-card textarea::placeholder { color: #7c7c94; }

    .modal-card textarea { height: 140px; resize: none; }

    .send-btn {
      width: 100%;
      padding: 13px;
      background: #f0c040;
      border: none;
      border-radius: 10px;
      color: #0d0d0f;
      font-family: 'Syne', sans-serif;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      margin-top: 20px;
      transition: all 0.2s;
    }

    .send-btn:hover { background: #f5cc55; }
    .send-btn:disabled { opacity: 0.6; cursor: not-allowed; }

    .toast {
      position: fixed;
      bottom: 24px;
      left: 50%;
      transform: translateX(-50%);
      background: #1e1e24;
      border: 1px solid #2a2a35;
      color: #f0eff4;
      padding: 12px 24px;
      border-radius: 12px;
      font-size: 14px;
      z-index: 100;
      display: none;
      box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    }

    .toast.success { border-color: #4ade80; color: #4ade80; }
    .toast.error { border-color: #ff5c5c; color: #ff5c5c; }
    .toast.show { display: block; }
  </style>
</head>
<body>

<div class="mailbox">
  <aside class="sidebar">
    <div class="brand">🐝 RepoHive</div>
    <button class="compose-btn" onclick="openCompose()">✏️ Compose</button>

    <div class="nav-section">Mailbox</div>
    <a class="menu active" id="inboxMenu" onclick="showInbox(this)">📥 Inbox <span id="inboxCount">3</span></a>
    <a class="menu" id="sentMenu" onclick="showSent(this)">📤 Sent <span id="sentCount" class="muted-badge">0</span></a>
    <a class="menu">📝 Drafts <span class="muted-badge">0</span></a>
    <a class="menu">🗃️ Archived <span class="muted-badge">4</span></a>

    <div class="nav-section">Quick Links</div>
    <a class="menu" href="{{ route('chatbot') }}">🤖 AI Chatbot</a>

    <div class="sidebar-footer">
      <a class="back-nav" href="{{ route('login') }}">← Back to Hub</a>
    </div>
  </aside>

  <main class="main">
    <header class="topbar">
      <div>
        <h2 id="mailTitle">Inbox</h2>
        <small id="userEmail">Verified User</small>
      </div>
      <input id="searchMail" placeholder="🔍 Search mail..." onkeyup="filterMail()">
    </header>

    <section class="mail-area">
      <div id="mailList" class="mail-list"></div>
      <div class="preview">
        <h2 id="previewTitle">Select an email</h2>
        <p id="previewMeta"></p>
        <p id="previewBody"></p>
      </div>
    </section>
  </main>
</div>

<div id="composeModal" class="modal">
  <div class="modal-card">
    <button class="close" onclick="closeCompose()">×</button>
    <h2>✏️ New Message</h2>
    <label>To</label>
    <input id="composeTo" type="email" placeholder="recipient@email.com">
    <label>Subject</label>
    <input id="composeSubject" type="text" placeholder="Email subject">
    <label>Message</label>
    <textarea id="composeBody" placeholder="Write your message..."></textarea>
    <button class="send-btn" id="sendBtn" onclick="sendEmail()">Send Email →</button>
  </div>
</div>

<div id="toast" class="toast"></div>

<script>
  const inboxEmails = [
    { id: 1, avatar: '🐝', sender: 'RepoHive Team', email: 'noreply@repohive.app', subject: 'Welcome to RepoHive Mail', preview: 'Your secure mailbox is now ready...', body: 'Your secure mailbox is now ready. You can receive workspace updates, system notifications, and team messages directly here.\n\nWelcome to RepoHive — Build Together. Ship Faster. 🐝', time: '9:00 AM', unread: true },
    { id: 2, avatar: '🔒', sender: 'Security', email: 'security@repohive.app', subject: 'OTP Verification Successful', preview: 'Your identity has been verified...', body: 'Your identity has been verified successfully via OTP. If you did not perform this action, please contact support immediately.', time: '9:17 AM', unread: true },
    { id: 3, avatar: '👤', sender: 'Douglas Hill', email: 'douglas@repohive.app', subject: 'Project Workspace Invitation', preview: 'You have been invited to join...', body: 'You have been invited to join the RepoHive project workspace. Collaborate with your team and start building together!', time: '10:30 AM', unread: true },
  ];

  let sentEmails = JSON.parse(localStorage.getItem('sentEmails') || '[]');
  let currentView = 'inbox';
  let currentEmails = [];

  function showToast(message, type) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = 'toast ' + type + ' show';
    setTimeout(function() { toast.className = 'toast'; }, 3000);
  }

  function renderMails(emails) {
    const list = document.getElementById('mailList');
    list.innerHTML = '';
    if (emails.length === 0) {
      list.innerHTML = '<div style="padding:24px;text-align:center;color:#7c7c94;font-size:14px;">No emails found</div>';
      return;
    }
    emails.forEach(function(email) {
      const item = document.createElement('div');
      item.className = 'mail-item' + (email.unread ? ' unread' : '');
      item.onclick = function() { openEmail(email, item); };
      item.innerHTML =
        '<div class="mail-row">' +
          '<div class="mail-avatar">' + email.avatar + '</div>' +
          '<div class="mail-sender' + (email.unread ? ' unread' : '') + '">' + email.sender + '</div>' +
          (email.unread ? '<div class="unread-dot"></div>' : '') +
          '<div class="mail-time">' + email.time + '</div>' +
        '</div>' +
        '<div class="mail-subject">' + email.subject + '</div>' +
        '<div class="mail-preview">' + email.preview + '</div>';
      list.appendChild(item);
    });
  }

  function openEmail(email, item) {
    document.querySelectorAll('.mail-item').forEach(function(i) { i.classList.remove('active'); });
    item.classList.add('active');
    item.classList.remove('unread');
    const dot = item.querySelector('.unread-dot');
    if (dot) dot.remove();
    email.unread = false;
    document.getElementById('previewTitle').textContent = email.subject;
    document.getElementById('previewMeta').textContent = 'From: ' + email.sender + ' <' + email.email + '> · ' + email.time;
    document.getElementById('previewBody').textContent = email.body;
  }

  function showInbox(el) {
    currentView = 'inbox';
    currentEmails = inboxEmails;
    document.getElementById('mailTitle').textContent = 'Inbox';
    document.querySelectorAll('.menu').forEach(function(m) { m.classList.remove('active'); });
    if (el) el.classList.add('active');
    renderMails(inboxEmails);
  }

  function showSent(el) {
    currentView = 'sent';
    sentEmails = JSON.parse(localStorage.getItem('sentEmails') || '[]');
    currentEmails = sentEmails;
    document.getElementById('mailTitle').textContent = 'Sent';
    document.querySelectorAll('.menu').forEach(function(m) { m.classList.remove('active'); });
    if (el) el.classList.add('active');
    renderMails(sentEmails);
  }

  function filterMail() {
    const q = document.getElementById('searchMail').value.toLowerCase();
    const filtered = currentEmails.filter(function(e) {
      return e.subject.toLowerCase().includes(q) || e.sender.toLowerCase().includes(q) || e.preview.toLowerCase().includes(q);
    });
    renderMails(filtered);
  }

  function openCompose() {
    document.getElementById('composeModal').classList.add('open');
  }

  function closeCompose() {
    document.getElementById('composeModal').classList.remove('open');
  }

  function sendEmail() {
    const to = document.getElementById('composeTo').value;
    const subject = document.getElementById('composeSubject').value;
    const body = document.getElementById('composeBody').value;

    if (!to || !subject || !body) {
      showToast('Please fill in all fields.', 'error');
      return;
    }

    const btn = document.getElementById('sendBtn');
    btn.textContent = 'Sending...';
    btn.disabled = true;

    fetch('/mailbox/send', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ to: to, subject: subject, body: body })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      if (data.success) {
        const newEmail = {
          id: Date.now(),
          avatar: '📤',
          sender: 'Me',
          email: to,
          subject: subject,
          preview: body.substring(0, 60) + '...',
          body: body,
          time: new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }),
          unread: false
        };
        sentEmails.unshift(newEmail);
        localStorage.setItem('sentEmails', JSON.stringify(sentEmails));
        document.getElementById('sentCount').textContent = sentEmails.length;
        document.getElementById('composeTo').value = '';
        document.getElementById('composeSubject').value = '';
        document.getElementById('composeBody').value = '';
        closeCompose();
        showToast('✅ Email sent successfully!', 'success');
      } else {
        showToast('❌ ' + data.message, 'error');
      }
    })
    .catch(function(err) {
      showToast('❌ Error: ' + err.message, 'error');
    })
    .finally(function() {
      btn.textContent = 'Send Email →';
      btn.disabled = false;
    });
  }

  showInbox(document.getElementById('inboxMenu'));
</script>
</body>
</html>