@extends('layouts.public')
@section('title', 'About Us — Pro-Sound Media')

@section('content')
{{-- Hero Banner --}}
<section style="position:relative; height:400px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
    <img src="{{ asset('images/studio-engineer.png') }}" alt="About Pro-Sound Media" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(220,38,38,0.3) 100%);"></div>
    <div style="position:relative; z-index:2; text-align:center; padding:0 2rem;">
        <div class="section-badge" style="background:rgba(255,0,0,0.2); color:#FCA5A5; border:1px solid rgba(255,0,0,0.3);"><i class="fas fa-info-circle"></i> About Us</div>
        <h1 style="font-size:3rem; font-weight:900; color:white; margin-top:1rem; text-shadow:0 2px 20px rgba(0,0,0,0.5);">Audio Engineering Solutions That Speak</h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.1rem; max-width:600px; margin:1rem auto 0;">Over 15 years of delivering excellence in professional audio engineering across Nigeria.</p>
    </div>
</section>

{{-- Content --}}
<section style="padding:5rem 2rem; background:var(--bg-soft);">
    <div class="container" style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center;">
        <div>
            <h2 class="section-title" style="font-size:2.25rem;">Our Story</h2>
            <p style="color:var(--text-sec); font-size:1.05rem; line-height:1.8; margin-bottom:1.5rem;">
                Founded and led by <strong>Lawrence Amana</strong>, Senior Audio Engineer & CEO, Pro-Sound Media has been delivering excellence in professional audio engineering for over 15 years across Nigeria.
            </p>
            <p style="color:var(--text-sec); font-size:0.95rem; line-height:1.8;">
                Based in Abuja, we specialize in live sound reinforcements, audio installations for churches, clubs, malls, and airports, as well as professional training and consultancy services.
            </p>
        </div>
        <div>
            <img src="{{ asset('images/studio-engineer.png') }}" alt="Lawrence Amana - Pro-Sound Media" style="width:100%; border-radius:20px; box-shadow:var(--shadow-xl);">
        </div>
    </div>
</section>

{{-- Values --}}
<section class="section">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <div class="section-badge"><i class="fas fa-heart"></i> Our Values</div>
            <h2 class="section-title">What Drives Us</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:1.5rem;">
            @foreach([
                ['icon' => 'fas fa-medal', 'title' => 'Excellence', 'desc' => 'We deliver nothing less than world-class audio engineering on every project.'],
                ['icon' => 'fas fa-handshake', 'title' => 'Integrity', 'desc' => 'Honest, transparent relationships with clients built on trust and results.'],
                ['icon' => 'fas fa-lightbulb', 'title' => 'Innovation', 'desc' => 'Staying at the forefront of audio technology and engineering techniques.'],
                ['icon' => 'fas fa-users', 'title' => 'Service', 'desc' => 'Client satisfaction is our ultimate measure of success.'],
            ] as $value)
            <div class="card" style="text-align:center;">
                <div class="card-icon" style="background:var(--primary-light); color:var(--primary); margin:0 auto 1rem;"><i class="{{ $value['icon'] }}"></i></div>
                <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.5rem;">{{ $value['title'] }}</h3>
                <p style="color:var(--text-sec); font-size:0.9rem; line-height:1.7;">{{ $value['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CEO Spotlight --}}
<section class="section section-alt">
    <div class="container">
        <div style="max-width:700px; margin:0 auto; text-align:center;">
            <div style="width:100px; height:100px; border-radius:50%; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:2.5rem; font-weight:900; margin:0 auto 1.5rem;">LA</div>
            <h3 style="font-size:1.5rem; font-weight:800; margin-bottom:0.25rem;">Lawrence Amana</h3>
            <p style="color:var(--primary); font-weight:600; margin-bottom:1.5rem;">Senior Audio Engineer & CEO</p>
            <p style="color:var(--text-sec); font-size:1.05rem; line-height:1.8; font-style:italic;">
                "Our mission is simple — to deliver audio engineering solutions that exceed expectations every single time. From a 50-person church service to a 50,000-seat concert, we bring the same level of professionalism, precision, and passion."
            </p>
        </div>
    </div>
</section>

{{-- Testimonials --}}
@if($testimonials->count())
<section class="section">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <div class="section-badge"><i class="fas fa-star"></i> Testimonials</div>
            <h2 class="section-title">Client Voices</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1.5rem;">
            @foreach($testimonials->take(6) as $t)
            <div class="card">
                <div style="color:#FBBF24; margin-bottom:0.75rem;">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star"></i>@endfor</div>
                <p style="color:var(--text-sec); font-size:0.9rem; line-height:1.7; margin-bottom:1rem;">"{{ $t->content }}"</p>
                <div style="font-weight:700; font-size:0.9rem;">{{ $t->client_name }}</div>
                <div style="color:var(--text-muted); font-size:0.8rem;">{{ $t->client_title }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
