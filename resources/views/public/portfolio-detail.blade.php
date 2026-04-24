@extends('layouts.public')
@section('title', $portfolio->title . ' — Pro-Sound Media Portfolio')

@section('content')
<section class="section">
    <div class="container" style="max-width:800px;">
        <a href="{{ route('portfolio.index') }}" style="color:var(--primary); font-size:0.9rem; font-weight:600; display:inline-flex; align-items:center; gap:0.5rem; margin-bottom:2rem;">
            <i class="fas fa-arrow-left"></i> Back to Portfolio
        </a>
        
        <div style="margin-bottom:1.5rem;">
            <span style="font-size:0.8rem; font-weight:700; padding:0.35rem 1rem; border-radius:999px; background:var(--primary-light); color:var(--primary); display:inline-block; margin-bottom:1rem;">
                {{ ucfirst($portfolio->media_type) }}
            </span>
            <h1 style="font-size:2.5rem; font-weight:800; color:var(--dark); line-height:1.2;">{{ $portfolio->title }}</h1>
        </div>
        
        <div style="border-radius:24px; overflow:hidden; margin-bottom:2rem; box-shadow:var(--shadow-xl);">
            <div style="aspect-ratio:16/9; background:linear-gradient(135deg, #F8FAFC, #E2E8F0); display:flex; align-items:center; justify-content:center; position:relative;">
                <i class="fas fa-play-circle" style="font-size:5rem; color:var(--primary); opacity:0.8; filter:drop-shadow(0 4px 6px rgba(0,0,0,0.1));"></i>
            </div>
        </div>
        
        <div class="card" style="margin-bottom:2rem;">
            <p style="color:var(--text-sec); font-size:1.05rem; line-height:1.9;">{{ $portfolio->description }}</p>
        </div>
        
        @if($portfolio->client_name)
        <div style="display:flex; align-items:center; gap:1rem; padding:1.5rem; background:var(--bg-soft); border-radius:16px;">
            <div style="width:48px; height:48px; border-radius:12px; background:var(--primary); color:white; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:1.2rem;">
                {{ substr($portfolio->client_name, 0, 1) }}
            </div>
            <div>
                <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.2rem;">Client</div>
                <div style="font-weight:700; color:var(--dark); font-size:1.1rem;">{{ $portfolio->client_name }}</div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
