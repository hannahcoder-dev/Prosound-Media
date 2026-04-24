@extends('layouts.public')
@section('title', 'Services — Pro-Sound Media')

@section('content')
{{-- Hero Banner --}}
<section style="position:relative; height:400px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
    <img src="{{ asset('images/hero-live-sound.png') }}" alt="Our Services" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(220,38,38,0.3) 100%);"></div>
    <div style="position:relative; z-index:2; text-align:center; padding:0 2rem;">
        <div class="section-badge" style="background:rgba(255,0,0,0.2); color:#FCA5A5; border:1px solid rgba(255,0,0,0.3);"><i class="fas fa-headphones"></i> Our Services</div>
        <h1 style="font-size:3rem; font-weight:900; color:white; margin-top:1rem; text-shadow:0 2px 20px rgba(0,0,0,0.5);">Professional Audio Solutions</h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.1rem; max-width:600px; margin:1rem auto 0;">Complete audio engineering services — from live sound reinforcement to permanent installations.</p>
    </div>
</section>

<section style="padding:5rem 2rem; background:var(--bg-soft);">
    <div class="container">

        @foreach($categories as $category)
        <div style="margin-bottom:3rem;">
            <h2 style="font-size:1.5rem; font-weight:700; margin-bottom:1.5rem; padding-bottom:0.75rem; border-bottom:2px solid var(--primary-light);">
                <i class="fas fa-folder" style="color:var(--primary); margin-right:0.5rem;"></i> {{ $category->name }}
            </h2>
            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1.5rem;">
                @foreach($category->services as $service)
                <div class="card">
                    <div class="card-icon" style="background:var(--primary-light); color:var(--primary);"><i class="{{ $service->icon ?? 'fas fa-music' }}"></i></div>
                    <h3 style="font-size:1.1rem; font-weight:700; margin-bottom:0.5rem;">{{ $service->name }}</h3>
                    <p style="color:var(--text-sec); font-size:0.9rem; line-height:1.7; margin-bottom:1rem;">{{ $service->short_description }}</p>
                    @if(is_array($service->features))
                    <ul style="list-style:none; margin-bottom:1.25rem;">
                        @foreach(array_slice($service->features, 0, 4) as $f)
                        <li style="font-size:0.85rem; color:var(--text-sec); padding:0.3rem 0; display:flex; align-items:center; gap:0.5rem;">
                            <i class="fas fa-check" style="color:var(--primary); font-size:0.7rem;"></i> {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-top:1rem; border-top:1px solid var(--border);">
                        <span style="font-size:1.25rem; font-weight:800; color:var(--primary);">{{ $service->formatted_price }}</span>
                        <a href="{{ route('services.show', $service->slug) }}" style="color:var(--primary); font-weight:600; font-size:0.85rem;">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
