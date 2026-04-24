<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pro-Sound Media — Audio Engineering Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'Pro-Sound Media — Professional Audio Engineering Solutions. Live Sound Reinforcements, Trainings, Consultancy, Live Recordings, and Audio Installations in Abuja, Nigeria.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #FF0000; /* Pure Red from logo */
            --brand-crimson: #DC2626; 
            --primary-dark: #cc0000;
            --primary-light: #FEE2E2;
            --secondary: #1E293B;
            --dark: #0F172A;
            --text: #1E293B;
            --text-sec: #475569;
            --text-muted: #94A3B8;
            --bg: #FFFFFF;
            --bg-soft: #F8FAFC;
            --bg-card: #FFFFFF;
            --border: #E2E8F0;
            --border-light: #F1F5F9;
            --shadow: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 40px rgba(0,0,0,0.08);
            --shadow-xl: 0 20px 60px rgba(0,0,0,0.1);
            --radius: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed; top: 0; width: 100%; z-index: 1000;
            padding: 0.4rem 0;
            background: rgba(255,255,255,0.95); backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s;
        }
        .navbar.scrolled { box-shadow: var(--shadow); padding: 0.25rem 0; }
        .navbar.scrolled .nav-logo img { height: 85px; transform: scale(1.1); }
        .nav-container { max-width: 1280px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center; }
        .nav-logo { display: flex; align-items: center; text-decoration: none; flex-shrink: 0; }
        .nav-logo img { height: 110px; width: auto; object-fit: contain; mix-blend-mode: multiply; filter: contrast(1.3) saturate(1.2); transform: scale(1.25); transform-origin: left center; transition: all 0.3s ease; }
        .nav-links { display: flex; align-items: center; gap: 1.75rem; }
        .nav-links a { font-size: 0.9rem; font-weight: 500; color: var(--text-sec); transition: color 0.2s; white-space: nowrap; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }
        .nav-cta { display: flex; align-items: center; gap: 0.75rem; flex-shrink: 0; }
        .btn-nav { padding: 0.5rem 1.25rem; border-radius: 10px; font-size: 0.85rem; font-weight: 600; transition: all 0.2s; white-space: nowrap; }
        .btn-nav-outline { border: 1px solid var(--border); color: var(--text-sec); }
        .btn-nav-outline:hover { border-color: var(--primary); color: var(--primary); }
        .btn-nav-primary { background: var(--primary); color: white; border: 1px solid var(--primary); }
        .btn-nav-primary:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 15px rgba(220,38,38,0.3); }

        /* ── SECTIONS ── */
        .section { padding: 5rem 2rem; }
        .section-alt { background: var(--bg-soft); }
        .container { max-width: 1280px; margin: 0 auto; }
        .section-badge { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1rem; background: var(--primary-light); color: var(--primary); font-size: 0.8rem; font-weight: 600; border-radius: 999px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem; }
        .section-title { font-size: 2.5rem; font-weight: 800; color: var(--dark); margin-bottom: 0.75rem; line-height: 1.2; }
        .section-subtitle { color: var(--text-sec); font-size: 1.1rem; max-width: 600px; line-height: 1.8; }

        /* ── CARDS ── */
        .card {
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: var(--radius); padding: 2rem; transition: all 0.3s;
        }
        .card:hover { border-color: var(--primary); box-shadow: var(--shadow-lg); transform: translateY(-3px); }
        .card-icon {
            width: 56px; height: 56px; border-radius: 14px; display: flex;
            align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 1.25rem;
        }

        /* ── BUTTONS ── */
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 2rem; border-radius: 12px; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.3s; border: none; text-decoration: none; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 25px rgba(220,38,38,0.3); }
        .btn-outline { background: transparent; border: 2px solid var(--border); color: var(--text); }
        .btn-outline:hover { border-color: var(--primary); color: var(--primary); }
        .btn-white { background: white; color: var(--dark); }
        .btn-white:hover { background: var(--bg-soft); }
        .btn-lg { padding: 1rem 2.5rem; font-size: 1rem; }

        /* ── FOOTER ── */
        .footer { background: var(--dark); color: #CBD5E1; padding: 4rem 2rem 2rem; }
        .footer-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; }
        .footer-logo-wrap { margin-bottom: 3rem; }
        /* The brightness filter was overwriting the red. This new formula keeps Media white but forces the waveform and Pro-Sound to be saturated vibrant red. */
        .footer-logo-wrap img { 
            height: 120px; width: auto;
            mix-blend-mode: screen; filter: invert(1) hue-rotate(180deg) saturate(2); 
            transform: scale(1.25); transform-origin: left center; 
        }
        .footer-text { color: #94A3B8; font-size: 0.9rem; line-height: 1.8; margin-bottom: 1.5rem; }
        .footer-heading { color: white; font-weight: 700; font-size: 0.95rem; margin-bottom: 1.25rem; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 0.6rem; }
        .footer-links a { color: #94A3B8; font-size: 0.9rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--primary); }
        .footer-bottom { border-top: 1px solid #1E293B; padding-top: 2rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; color: #64748B; }
        .footer-socials { display: flex; gap: 1rem; }
        .footer-socials a { display: flex; width: 40px; height: 40px; border-radius: 10px; background: rgba(255,255,255,0.06); align-items: center; justify-content: center; color: #94A3B8; transition: all 0.2s; }
        .footer-socials a:hover { background: var(--primary); color: white; }
        .contact-info-item { display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 0.75rem; color: #94A3B8; font-size: 0.9rem; }
        .contact-info-item i { color: var(--primary); margin-top: 0.2rem; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .section-title { font-size: 2rem; }
        }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .footer-grid { grid-template-columns: 1fr; }
            .section { padding: 3rem 1.5rem; }
            .section-title { font-size: 1.75rem; }
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar" x-data="{ scrolled: false }" @scroll.window="scrolled = window.scrollY > 50" :class="{ 'scrolled': scrolled }">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Pro-Sound Media Logo">
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('services.index') }}" class="{{ request()->routeIs('services.*') ? 'active' : '' }}">Services</a>
                <a href="{{ route('portfolio.index') }}" class="{{ request()->routeIs('portfolio.*') ? 'active' : '' }}">Portfolio</a>
                <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </div>
            <div class="nav-cta">
                @auth
                    @if(auth()->user()->isStaff())
                        <a href="{{ route('admin.dashboard') }}" class="btn-nav btn-nav-primary">Dashboard</a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="btn-nav btn-nav-primary">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-nav btn-nav-outline">Login</a>
                    <a href="{{ route('register') }}" class="btn-nav btn-nav-primary">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main style="margin-top: 130px;">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo-wrap">
                        <img src="{{ asset('images/logo.png') }}" alt="Pro-Sound Media Logo">
                    </div>
                    <p class="footer-text">Professional sound reinforcement, live recordings, training and audio installations across Nigeria.</p>
                    <div class="footer-socials">
                        <a href="https://facebook.com/prosoundmedia" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://instagram.com/prosoundmedia" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtube.com/@prosoundmedia" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
                        <a href="https://twitter.com/prosoundmedia" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div>
                    <div class="footer-heading">Our Services</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('services.index') }}">Live Sound Reinforcements</a></li>
                        <li><a href="{{ route('services.index') }}">Trainings & Consultancy</a></li>
                        <li><a href="{{ route('services.index') }}">Live Recordings & Gigs</a></li>
                        <li><a href="{{ route('services.index') }}">Audio Installations</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-heading">Quick Links</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
                        <li><a href="{{ route('pricing') }}">Pricing</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-heading">Contact Info</div>
                    <div class="contact-info-item"><i class="fas fa-map-marker-alt"></i><span>Kolhed Records, Suit A42 Efab Mall,<br>Area II Shopping Complex, Ahmadu Bello Way,<br>Area II Garki, Abuja</span></div>
                    <div class="contact-info-item"><i class="fas fa-phone"></i><span>0803 519 0167 | 0809 454 6479<br>0816 374 5793</span></div>
                    <div class="contact-info-item"><i class="fas fa-envelope"></i><span>info@prosoundmedia.ng</span></div>
                </div>
            </div>
            <div class="footer-bottom">
                <span>&copy; {{ date('Y') }} Pro-Sound Media. All rights reserved.</span>
                <span>Audio Engineering Solutions by Lawrence Amana</span>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Smooth scroll
            document.querySelectorAll('a[href^="#"]').forEach(a => {
                a.addEventListener('click', e => {
                    e.preventDefault();
                    document.querySelector(a.getAttribute('href'))?.scrollIntoView({ behavior: 'smooth' });
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
