<!DOCTYPE html>
<html lang="en" x-data="{ theme: localStorage.getItem('theme') || 'light' }" :data-theme="theme" x-init="$watch('theme', val => localStorage.setItem('theme', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Client Portal') — Pro-Sound Media</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            /* Light mode variables */
            --sidebar-bg: rgba(255, 255, 255, 0.95);
            --main-bg: #f8fafc;
            --main-gradient: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 60%, #ffe4e6 100%);
            --card-bg: rgba(255, 255, 255, 0.85);
            --card-shadow: 0 8px 30px rgba(0,0,0,0.04);
            --card-backdrop: blur(16px);
            --accent: #FF0000;
            --cyan: #0284c7;
            --gold: #d97706;
            --text: #0f172a;
            --text-sec: #475569;
            --text-muted: #94a3b8;
            --border: rgba(226, 232, 240, 0.8);
            --success: #059669;
            --danger: #dc2626;
            --warning: #d97706;
        }
        [data-theme="dark"] {
            /* Dark mode variables */
            --sidebar-bg:#0f0f17; --main-bg:#0a0a0f; --main-gradient: #0a0a0f; --card-bg:#16161f; --card-shadow: none; --card-backdrop: none; --accent:#FF0000; --cyan:#06b6d4; --gold:#f59e0b; --text:#f1f5f9; --text-sec:#94a3b8; --text-muted:#64748b; --border:#1e1e2e; --success:#10b981; --danger:#ef4444; --warning:#f59e0b; 
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:var(--main-gradient); background-attachment: fixed; color:var(--text); display:flex; min-height:100vh; }
        .sidebar { width:240px; min-height:100vh; background:var(--sidebar-bg); border-right:1px solid var(--border); padding:1.5rem 0; position:fixed; left:0; top:0; bottom:0; z-index:100; display:flex; flex-direction:column; }
        .sidebar-logo { padding:0 1.5rem; font-size:1.3rem; font-weight:800; margin-bottom:2rem; }
        .sidebar-logo span { color:var(--accent); }
        .nav-item { display:flex; align-items:center; gap:0.75rem; padding:0.65rem 1.5rem; color:var(--text-sec); font-size:0.9rem; transition:all 0.2s; text-decoration:none; border-left:3px solid transparent; }
        .nav-item:hover { background:rgba(124,58,237,0.08); color:var(--text); }
        .nav-item.active { background:rgba(124,58,237,0.1); color:var(--accent); border-left-color:var(--accent); }
        .nav-item i { width:20px; text-align:center; font-size:0.85rem; }
        .main-content { flex:1; margin-left:240px; }
        .topbar { padding:1rem 2rem; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--border); background:var(--sidebar-bg); }
        .topbar-title { font-size:1.25rem; font-weight:700; }
        .content-area { padding:2rem; }
        .client-card { background:var(--card-bg); border:1px solid var(--border); border-radius:14px; padding:1.5rem; transition:all 0.3s; box-shadow: var(--card-shadow); backdrop-filter: var(--card-backdrop); }
        .client-card:hover { border-color:rgba(124,58,237,0.3); }
        .stat-card { display:flex; align-items:center; gap:1rem; }
        .stat-icon { width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; }
        .stat-number { font-size:1.75rem; font-weight:800; }
        .stat-label { color:var(--text-sec); font-size:0.8rem; }
        .btn { display:inline-flex; align-items:center; gap:0.5rem; padding:0.5rem 1.25rem; border-radius:10px; font-size:0.85rem; font-weight:600; cursor:pointer; transition:all 0.2s; text-decoration:none; border:none; }
        .btn-accent { background:var(--accent); color:white; }
        .btn-accent:hover { background:#6d28d9; }
        .btn-outline { background:transparent; border:1px solid var(--border); color:var(--text-sec); }
        .btn-outline:hover { border-color:var(--accent); color:var(--accent); }
        .btn-sm { padding:0.35rem 0.8rem; font-size:0.8rem; }
        .badge { display:inline-flex; align-items:center; padding:0.2rem 0.6rem; border-radius:999px; font-size:0.75rem; font-weight:600; }
        .badge-success { background:rgba(16,185,129,0.15); color:var(--success); }
        .badge-warning { background:rgba(245,158,11,0.15); color:var(--warning); }
        .badge-danger { background:rgba(239,68,68,0.15); color:var(--danger); }
        .badge-primary { background:rgba(124,58,237,0.15); color:var(--accent); }
        .badge-info { background:rgba(6,182,212,0.15); color:var(--cyan); }
        .client-table { width:100%; border-collapse:collapse; }
        .client-table th { text-align:left; padding:0.75rem 1rem; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.05em; color:var(--text-muted); border-bottom:1px solid var(--border); }
        .client-table td { padding:0.75rem 1rem; border-bottom:1px solid var(--border); font-size:0.9rem; color:var(--text-sec); }
        .form-group { margin-bottom:1.25rem; }
        .form-label { display:block; margin-bottom:0.35rem; font-size:0.85rem; color:var(--text-sec); }
        .form-input { width:100%; padding:0.65rem 1rem; background:var(--main-bg); border:1px solid var(--border); border-radius:10px; color:var(--text); font-size:0.9rem; font-family:inherit; }
        .form-input:focus { outline:none; border-color:var(--accent); }
        textarea.form-input { resize:vertical; min-height:100px; }
        .flash-success { padding:0.75rem 1rem; background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3); border-radius:10px; color:var(--success); margin-bottom:1.5rem; font-size:0.9rem; }
        .flash-error { padding:0.75rem 1rem; background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.3); border-radius:10px; color:var(--danger); margin-bottom:1.5rem; font-size:0.9rem; }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="sidebar">
        <a href="{{ route('home') }}" class="sidebar-logo" style="text-decoration:none;">PRO<span>SOUND</span></a>
        <nav style="flex:1;">
            <a href="{{ route('client.dashboard') }}" class="nav-item {{ request()->routeIs('client.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i> Dashboard</a>
            <a href="{{ route('client.bookings.index') }}" class="nav-item {{ request()->routeIs('client.bookings.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> My Bookings</a>
            <a href="{{ route('client.bookings.create') }}" class="nav-item {{ request()->routeIs('client.bookings.create') ? 'active' : '' }}"><i class="fas fa-plus-circle"></i> New Booking</a>
            <a href="{{ route('client.payments.index') }}" class="nav-item {{ request()->routeIs('client.payments.*') ? 'active' : '' }}"><i class="fas fa-credit-card"></i> Payments</a>
        </nav>
        <div style="padding:1rem 1.5rem; border-top:1px solid var(--border);">
            <div style="font-size:0.85rem; margin-bottom:0.5rem;">{{ auth()->user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" style="background:none; border:none; color:var(--text-muted); cursor:pointer; font-size:0.85rem; font-family:inherit;"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>
    </aside>
    <div class="main-content">
        <header class="topbar">
            <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
            <div style="display:flex; align-items:center;">
                <button @click="theme = theme === 'dark' ? 'light' : 'dark'" style="background:none; border:none; color:var(--text-sec); cursor:pointer; font-size:1.1rem; outline:none;" title="Toggle Theme"><i class="fas" :class="theme === 'dark' ? 'fa-sun' : 'fa-moon'"></i></button>
            </div>
        </header>
        <div class="content-area">
            @if(session('success'))<div class="flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
            @if(session('error'))<div class="flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif
            @if($errors->any())<div class="flash-error">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</body>
</html>
