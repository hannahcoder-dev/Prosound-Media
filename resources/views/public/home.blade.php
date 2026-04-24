@extends('layouts.public')
@section('title', 'Pro-Sound Media — Audio Engineering Solutions')

@section('content')

{{-- HERO SECTION --}}
<section style="position:relative; min-height:90vh; display:flex; align-items:center; overflow:hidden;">
    <div style="position:absolute; inset:0; z-index:0;">
        <img src="/images/hero-live-sound.png" alt="Live Sound Setup" style="width:100%; height:100%; object-fit:cover;">
        <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(15,23,42,0.6) 50%, rgba(220,38,38,0.2) 100%);"></div>
    </div>
    <div class="container" style="position:relative; z-index:2; padding:0 2rem;">
        <div style="max-width:700px;">

            <h1 style="font-size:3.5rem; font-weight:900; color:white; line-height:1.15; margin-bottom:1.25rem;">
                Professional Sound<br>
                That <span style="color:#DC2626;">Delivers</span> Impact
            </h1>
            <p style="color:#CBD5E1; font-size:1.15rem; line-height:1.8; margin-bottom:2.5rem; max-width:550px;">
                From live sound reinforcements to church installations — we bring world-class audio engineering to your events, venues, and productions across Nigeria.
            </p>
            <div style="display:flex; gap:1rem; flex-wrap:wrap;">
                <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg"><i class="fas fa-headphones"></i> Our Services</a>
                <a href="{{ route('contact') }}" class="btn btn-white btn-lg"><i class="fas fa-phone"></i> Contact Us</a>
            </div>
            <div style="display:flex; gap:3rem; margin-top:3rem;">
                <div><div style="font-size:2rem; font-weight:800; color:white;">500+</div><div style="color:#94A3B8; font-size:0.85rem;">Events Covered</div></div>
                <div><div style="font-size:2rem; font-weight:800; color:white;">15+</div><div style="color:#94A3B8; font-size:0.85rem;">Years Experience</div></div>
                <div><div style="font-size:2rem; font-weight:800; color:white;">200+</div><div style="color:#94A3B8; font-size:0.85rem;">Installations</div></div>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES SECTION --}}
<section class="section section-alt" id="services">
    <div class="container">
        <div style="text-align:center; margin-bottom:3.5rem;">
            <div class="section-badge"><i class="fas fa-cog"></i> What We Do</div>
            <h2 class="section-title">Our Core Services</h2>
            <p class="section-subtitle" style="margin:0 auto;">Comprehensive audio engineering solutions for every need — from live events to permanent installations.</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1.5rem;">
            @php
            $coreServices = [
                ['icon' => 'fas fa-volume-up', 'title' => 'Live Sound Reinforcements', 'desc' => 'Professional PA systems and sound reinforcement for concerts, conferences, weddings, and corporate events of any scale.', 'img' => '/images/live-concert.png', 'color' => '#DC2626', 'bg' => '#FEE2E2'],
                ['icon' => 'fas fa-graduation-cap', 'title' => 'Trainings & Consultancy', 'desc' => 'Expert audio engineering training programs and sound system consultancy for churches, venues, and organizations.', 'img' => '/images/training-workshop.png', 'color' => '#2563EB', 'bg' => '#DBEAFE'],
                ['icon' => 'fas fa-microphone', 'title' => 'Live Recordings & Gigs', 'desc' => 'Professional multi-track live recording services for concerts, church services, and special performances.', 'img' => '/images/studio-engineer.png', 'color' => '#059669', 'bg' => '#D1FAE5'],
                ['icon' => 'fas fa-church', 'title' => 'Church Audio Systems', 'desc' => 'Complete sound system design, installation, and optimization for churches and worship centers of all sizes.', 'img' => '/images/church-sound.png', 'color' => '#7C3AED', 'bg' => '#EDE9FE'],
                ['icon' => 'fas fa-building', 'title' => 'Mall & Airport Installations', 'desc' => 'Commercial distributed audio systems for shopping malls, airports, hotels, and public spaces.', 'img' => '/images/mall-installation.png', 'color' => '#D97706', 'bg' => '#FEF3C7'],
                ['icon' => 'fas fa-music', 'title' => 'Club & Venue Audio', 'desc' => 'High-energy sound systems for nightclubs, lounges, and entertainment venues with immersive audio experiences.', 'img' => '/images/hero-live-sound.png', 'color' => '#DC2626', 'bg' => '#FEE2E2'],
            ];
            @endphp

            @foreach ($coreServices as $svc)
            <div class="card" style="overflow:hidden; padding:0;">
                <div style="height:180px; overflow:hidden;">
                    <img src="{{ $svc['img'] }}" alt="{{ $svc['title'] }}" style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                </div>
                <div style="padding:1.5rem;">
                    <div class="card-icon" style="background:{{ $svc['bg'] }}; color:{{ $svc['color'] }}; margin-bottom:1rem;"><i class="{{ $svc['icon'] }}"></i></div>
                    <h3 style="font-size:1.15rem; font-weight:700; margin-bottom:0.5rem;">{{ $svc['title'] }}</h3>
                    <p style="color:var(--text-sec); font-size:0.9rem; line-height:1.7;">{{ $svc['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align:center; margin-top:3rem;">
            <a href="{{ route('services.index') }}" class="btn btn-primary"><i class="fas fa-arrow-right"></i> View All Services</a>
        </div>
    </div>
</section>

{{-- ABOUT / WHY CHOOSE US --}}
<section class="section">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center;">
            <div>
                <div style="position:relative;">
                    <img src="/images/studio-engineer.png" alt="Pro-Sound Engineer" style="width:100%; border-radius:20px; box-shadow:var(--shadow-xl);">
                    <div style="position:absolute; bottom:-20px; right:-20px; background:var(--primary); color:white; padding:1.5rem 2rem; border-radius:16px; box-shadow:0 10px 30px rgba(220,38,38,0.3);">
                        <div style="font-size:2rem; font-weight:900;">15+</div>
                        <div style="font-size:0.85rem; opacity:0.9;">Years of Excellence</div>
                    </div>
                </div>
            </div>
            <div>
                <div class="section-badge"><i class="fas fa-star"></i> Why Choose Us</div>
                <h2 class="section-title">Audio Engineering Led by Experience</h2>
                <p style="color:var(--text-sec); font-size:1rem; line-height:1.8; margin-bottom:2rem;">
                    Under the leadership of <strong>Lawrence Amana</strong>, Senior Audio Engineer & CEO, Pro-Sound Media has become a trusted name in professional sound reinforcement and audio installations across Nigeria.
                </p>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
                    @foreach([
                        ['icon' => 'fas fa-shield-alt', 'title' => 'Certified Engineers', 'desc' => 'Trained professionals with industry certifications'],
                        ['icon' => 'fas fa-clock', 'title' => '24/7 Support', 'desc' => 'Round-the-clock technical assistance'],
                        ['icon' => 'fas fa-tools', 'title' => 'Premium Equipment', 'desc' => 'World-class sound systems and gear'],
                        ['icon' => 'fas fa-map-marker-alt', 'title' => 'Nationwide Coverage', 'desc' => 'Events and installations across Nigeria'],
                    ] as $feature)
                    <div style="display:flex; gap:1rem; padding:1rem; background:var(--bg-soft); border-radius:12px;">
                        <div style="width:40px; height:40px; min-width:40px; border-radius:10px; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center;"><i class="{{ $feature['icon'] }}"></i></div>
                        <div>
                            <div style="font-weight:700; font-size:0.9rem; margin-bottom:0.2rem;">{{ $feature['title'] }}</div>
                            <div style="color:var(--text-muted); font-size:0.8rem;">{{ $feature['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PORTFOLIO SHOWCASE --}}
<section class="section section-alt">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <div class="section-badge"><i class="fas fa-images"></i> Our Work</div>
            <h2 class="section-title">Recent Projects</h2>
            <p class="section-subtitle" style="margin:0 auto;">A glimpse of our professional audio engineering work across events, venues, and installations.</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:1rem;">
            @php
                $portfolio = [
                    ['img' => '/images/live-concert.png', 'title' => 'Live Concert Setup', 'cat' => 'Sound Reinforcement'],
                    ['img' => '/images/church-sound.png', 'title' => 'Worship Center Install', 'cat' => 'Installation'],
                    ['img' => '/images/mall-installation.png', 'title' => 'Commercial Audio', 'cat' => 'Installation'],
                    ['img' => '/images/training-workshop.png', 'title' => 'Audio Training', 'cat' => 'Training'],
                ];
            @endphp
            @foreach ($portfolio as $item)
            <div style="position:relative; border-radius:16px; overflow:hidden; aspect-ratio:1; cursor:pointer; group;" onmouseover="this.querySelector('.overlay').style.opacity='1'" onmouseout="this.querySelector('.overlay').style.opacity='0'">
                <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <div class="overlay" style="position:absolute; inset:0; background:linear-gradient(to top, rgba(15,23,42,0.9), transparent); display:flex; flex-direction:column; justify-content:flex-end; padding:1.25rem; opacity:0; transition:opacity 0.3s;">
                    <div style="color:white; font-weight:700;">{{ $item['title'] }}</div>
                    <div style="color:#FCA5A5; font-size:0.8rem;">{{ $item['cat'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center; margin-top:2.5rem;">
            <a href="{{ route('portfolio.index') }}" class="btn btn-outline"><i class="fas fa-th"></i> View Full Portfolio</a>
        </div>
    </div>
</section>

{{-- TESTIMONIALS --}}
@if($testimonials->count())
<section class="section">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <div class="section-badge"><i class="fas fa-quote-left"></i> Testimonials</div>
            <h2 class="section-title">What Clients Say</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1.5rem;">
            @foreach($testimonials->take(3) as $t)
            <div class="card">
                <div style="color:#FBBF24; font-size:0.9rem; margin-bottom:1rem;">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star"></i>@endfor</div>
                <p style="color:var(--text-sec); font-size:0.95rem; line-height:1.8; margin-bottom:1.5rem; font-style:italic;">"{{ Str::limit($t->content, 150) }}"</p>
                <div style="display:flex; align-items:center; gap:0.75rem; border-top:1px solid var(--border); padding-top:1rem;">
                    <div style="width:42px; height:42px; border-radius:12px; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center; font-weight:700;">{{ substr($t->client_name, 0, 1) }}</div>
                    <div>
                        <div style="font-weight:700; font-size:0.9rem;">{{ $t->client_name }}</div>
                        <div style="color:var(--text-muted); font-size:0.8rem;">{{ $t->client_title }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA SECTION --}}
<section style="padding:5rem 2rem; background:linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #DC2626 150%); position:relative; overflow:hidden;">
    <div style="position:absolute; top:0; right:0; width:400px; height:400px; background:radial-gradient(circle, rgba(220,38,38,0.15), transparent 70%);"></div>
    <div class="container" style="position:relative; z-index:2;">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center;">
            <div>
                <h2 style="font-size:2.5rem; font-weight:800; color:white; margin-bottom:1rem; line-height:1.2;">Ready to Elevate Your Sound?</h2>
                <p style="color:#CBD5E1; font-size:1.05rem; line-height:1.8; margin-bottom:2rem;">Whether you need sound reinforcement for your next event, a permanent audio installation, or professional training — we're here to help.</p>
                <div style="display:flex; gap:1rem; flex-wrap:wrap;">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Get a Quote</a>
                    <a href="tel:08035190167" class="btn btn-white btn-lg"><i class="fas fa-phone"></i> Call: 0803 519 0167</a>
                </div>
            </div>
            <div style="text-align:right;">
                <img src="/images/church-sound.png" alt="Church Audio" style="width:100%; max-width:450px; border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.3);">
            </div>
        </div>
    </div>
</section>

@endsection
