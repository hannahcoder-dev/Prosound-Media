<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') — Pro-Sound Media</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#F8FAFC; color:#1E293B; min-height:100vh; display:flex; align-items:center; justify-content:center; }
        .auth-container { width:100%; max-width:440px; padding:1rem; }
        .auth-logo { text-align:center; margin-bottom:2rem; display:flex; align-items:center; justify-content:center; }
        .auth-logo img { height: 140px; width: auto; object-fit: contain; mix-blend-mode: multiply; filter: contrast(1.3) saturate(1.2); transform: scale(1.2); transform-origin: center center; }
        .auth-card { background:white; border:1px solid #E2E8F0; border-radius:20px; padding:2.5rem; box-shadow:0 10px 40px rgba(0,0,0,0.06); }
        .auth-card h2 { font-size:1.5rem; margin-bottom:0.25rem; }
        .auth-card .subtitle { color:#64748B; font-size:0.9rem; margin-bottom:2rem; }
        .form-group { margin-bottom:1.25rem; }
        .form-label { display:block; font-size:0.85rem; font-weight:600; color:#475569; margin-bottom:0.35rem; }
        .form-input { width:100%; padding:0.75rem 1rem; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:12px; color:#1E293B; font-size:0.95rem; font-family:inherit; transition:border-color 0.3s; }
        .form-input:focus { outline:none; border-color:#FF0000; }
        .btn-submit { width:100%; padding:0.85rem; background:#FF0000; color:white; border:none; border-radius:12px; font-size:1rem; font-weight:600; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:0.5rem; }
        .btn-submit:hover { background:#cc0000; transform:translateY(-2px); box-shadow:0 8px 30px rgba(255,0,0,0.25); }
        .auth-footer { text-align:center; margin-top:1.5rem; font-size:0.9rem; color:#64748B; }
        .auth-footer a { color:#FF0000; font-weight:600; text-decoration:none; }
        .auth-footer a:hover { text-decoration: underline; }
        .error-text { color:#EF4444; font-size:0.8rem; margin-top:0.25rem; }
    </style>
</head>
<body>
    <div class="auth-container">
        <a href="{{ route('home') }}" class="auth-logo" style="text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Pro-Sound Media Logo">
        </a>
        @yield('content')
    </div>
</body>
</html>
