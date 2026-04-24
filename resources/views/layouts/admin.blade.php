<!DOCTYPE html>
<html lang="en" x-data="{ theme: localStorage.getItem('theme') || 'light' }" :data-theme="theme" x-init="$watch('theme', val => localStorage.setItem('theme', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') — Pro-Sound Media</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
            --accent-hover: #DC2626;
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
            --sidebar-bg: #0f0f17;
            --main-bg: #0a0a0f;
            --main-gradient: #0a0a0f;
            --card-bg: #16161f;
            --card-shadow: none;
            --card-backdrop: none;
            --accent: #FF0000;
            --accent-hover: #DC2626;
            --cyan: #06b6d4;
            --gold: #f59e0b;
            --text: #f1f5f9;
            --text-sec: #94a3b8;
            --text-muted: #64748b;
            --border: #1e1e2e;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--main-gradient); background-attachment: fixed; color: var(--text); display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 260px; min-height: 100vh; background: var(--sidebar-bg);
            border-right: 1px solid var(--border); padding: 1.5rem 0;
            position: fixed; left: 0; top: 0; bottom: 0; z-index: 100;
            display: flex; flex-direction: column; overflow-y: auto;
        }
        .sidebar-logo { padding: 0 1.5rem; font-size: 1.4rem; font-weight: 800; margin-bottom: 2rem; }
        .sidebar-logo span { color: var(--accent); }
        .sidebar-nav { flex: 1; }
        .nav-group { margin-bottom: 1.5rem; }
        .nav-group-title { padding: 0 1.5rem; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-muted); margin-bottom: 0.5rem; }
        .nav-item {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 1.5rem; color: var(--text-sec); font-size: 0.9rem;
            transition: all 0.2s; text-decoration: none; border-left: 3px solid transparent;
        }
        .nav-item:hover { background: rgba(124,58,237,0.08); color: var(--text); }
        .nav-item.active { background: rgba(124,58,237,0.1); color: var(--accent); border-left-color: var(--accent); }
        .nav-item i { width: 20px; text-align: center; font-size: 0.85rem; }
        .nav-badge { margin-left: auto; background: var(--accent); color: white; font-size: 0.7rem; padding: 0.15rem 0.5rem; border-radius: 999px; }

        /* Main */
        .main-content { flex: 1; margin-left: 260px; }
        .topbar {
            padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid var(--border); background: var(--sidebar-bg);
        }
        .topbar-title { font-size: 1.25rem; font-weight: 700; }
        .topbar-user { display: flex; align-items: center; gap: 0.75rem; }
        .topbar-user img, .topbar-avatar {
            width: 36px; height: 36px; border-radius: 10px; object-fit: cover;
            background: linear-gradient(135deg, var(--accent), var(--cyan));
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.9rem;
        }
        .content-area { padding: 2rem; }

        /* Cards */
        .admin-card {
            background: var(--card-bg); border: 1px solid var(--border); border-radius: 14px;
            padding: 1.5rem; transition: all 0.3s;
            box-shadow: var(--card-shadow);
            backdrop-filter: var(--card-backdrop);
        }
        .admin-card:hover { border-color: rgba(124,58,237,0.3); }
        .stat-card { display: flex; align-items: center; gap: 1rem; }
        .stat-icon {
            width: 50px; height: 50px; border-radius: 12px; display: flex;
            align-items: center; justify-content: center; font-size: 1.2rem;
        }
        .stat-number { font-size: 1.75rem; font-weight: 800; }
        .stat-label { color: var(--text-sec); font-size: 0.8rem; }

        /* Table */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th { text-align: left; padding: 0.75rem 1rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); border-bottom: 1px solid var(--border); }
        .admin-table td { padding: 0.75rem 1rem; border-bottom: 1px solid var(--border); font-size: 0.9rem; color: var(--text-sec); }
        .admin-table tr:hover td { background: rgba(124,58,237,0.03); }

        /* Badge */
        .badge { display: inline-flex; align-items: center; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
        .badge-success { background: rgba(16,185,129,0.15); color: var(--success); }
        .badge-warning { background: rgba(245,158,11,0.15); color: var(--warning); }
        .badge-danger { background: rgba(239,68,68,0.15); color: var(--danger); }
        .badge-primary { background: rgba(124,58,237,0.15); color: var(--accent); }
        .badge-info { background: rgba(6,182,212,0.15); color: var(--cyan); }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1.25rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; border: none; }
        .btn-accent { background: var(--accent); color: white; }
        .btn-accent:hover { background: var(--accent-hover); }
        .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text-sec); }
        .btn-outline:hover { border-color: var(--accent); color: var(--accent); }
        .btn-danger { background: rgba(239,68,68,0.15); color: var(--danger); }
        .btn-sm { padding: 0.35rem 0.8rem; font-size: 0.8rem; }

        /* Form */
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; margin-bottom: 0.35rem; font-size: 0.85rem; color: var(--text-sec); }
        .form-input {
            width: 100%; padding: 0.65rem 1rem; background: var(--main-bg); border: 1px solid var(--border);
            border-radius: 10px; color: var(--text); font-size: 0.9rem; font-family: inherit;
        }
        .form-input:focus { outline: none; border-color: var(--accent); }
        select.form-input { appearance: none; }
        textarea.form-input { resize: vertical; min-height: 100px; }

        /* Flash messages */
        .flash-success { padding: 0.75rem 1rem; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); border-radius: 10px; color: var(--success); margin-bottom: 1.5rem; font-size: 0.9rem; }
        .flash-error { padding: 0.75rem 1rem; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 10px; color: var(--danger); margin-bottom: 1.5rem; font-size: 0.9rem; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="sidebar-logo">PRO<span>SOUND</span></div>
        <nav class="sidebar-nav">
            <div class="nav-group">
                <div class="nav-group-title">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </div>
            <div class="nav-group">
                <div class="nav-group-title">Management</div>
                <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fas fa-users"></i> Users</a>
                <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="fas fa-headphones"></i> Services</a>
                <a href="{{ route('admin.bookings.index') }}" class="nav-item {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> Bookings</a>
                <a href="{{ route('admin.portfolios.index') }}" class="nav-item {{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}"><i class="fas fa-images"></i> Portfolio</a>
                <a href="{{ route('admin.blog.index') }}" class="nav-item {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"><i class="fas fa-pen-nib"></i> Blog</a>
            </div>
            <div class="nav-group">
                <div class="nav-group-title">Communication</div>
                <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Messages</a>
                <a href="{{ route('admin.testimonials.index') }}" class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"><i class="fas fa-star"></i> Testimonials</a>
            </div>
            <div class="nav-group">
                <div class="nav-group-title">Finance</div>
                <a href="{{ route('admin.payments.index') }}" class="nav-item {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}"><i class="fas fa-credit-card"></i> Payments</a>
                <a href="{{ route('admin.invoices.index') }}" class="nav-item {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}"><i class="fas fa-file-invoice"></i> Invoices</a>
            </div>
        </nav>
        <div style="padding: 1rem 1.5rem; border-top: 1px solid var(--border);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item" style="width: 100%; background: none; cursor: pointer; border: none; font-family: inherit; font-size: 0.9rem;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="main-content">
        <header class="topbar">
            <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
            <div class="topbar-user">
                <button @click="theme = theme === 'dark' ? 'light' : 'dark'" style="background:none; border:none; color:var(--text-sec); cursor:pointer; font-size:1.1rem; margin-right:1rem;" title="Toggle Theme">
                    <i class="fas" :class="theme === 'dark' ? 'fa-sun' : 'fa-moon'"></i>
                </button>
                <span style="color: var(--text-sec); font-size: 0.9rem;">{{ auth()->user()->name }}</span>
                <div class="topbar-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            </div>
        </header>

        <div class="content-area">
            @if(session('success'))
                <div class="flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="flash-error">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
