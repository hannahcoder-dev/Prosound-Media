@extends('layouts.public')
@section('title', 'Portfolio — Pro-Sound Media')

@section('content')
{{-- Hero Banner --}}
<section style="position:relative; height:400px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
    <img src="{{ asset('images/church-sound.png') }}" alt="Our Portfolio" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(220,38,38,0.3) 100%);"></div>
    <div style="position:relative; z-index:2; text-align:center; padding:0 2rem;">
        <div class="section-badge" style="background:rgba(255,0,0,0.2); color:#FCA5A5; border:1px solid rgba(255,0,0,0.3);"><i class="fas fa-images"></i> Our Portfolio</div>
        <h1 style="font-size:3rem; font-weight:900; color:white; margin-top:1rem; text-shadow:0 2px 20px rgba(0,0,0,0.5);">A Symphony of Success Projects</h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.1rem; max-width:600px; margin:1rem auto 0;">Explore our work across audio installations, live sound, and sound engineering.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        @if($portfolios->count())
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach($portfolios as $item)
            <a href="{{ route('portfolio.show', $item->slug) }}" class="card" style="padding:0; overflow:hidden; border:none; box-shadow:var(--shadow);">
                <div style="position:relative; height:200px;">
                    <div style="position:absolute; inset:0; background:linear-gradient(135deg, var(--primary-light), #F1F5F9); display:flex; align-items:center; justify-content:center;">
                        <i class="{{ $item->media_type === 'audio' ? 'fas fa-music' : ($item->media_type === 'video' ? 'fas fa-film' : 'fas fa-image') }}" style="font-size:3rem; color:var(--primary); opacity:0.8;"></i>
                    </div>
                </div>
                <div style="padding:1.5rem; background:white; border: 1px solid var(--border); border-top: none; border-radius: 0 0 var(--radius) var(--radius);">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:0.5rem;">
                        <h3 style="font-size:1.1rem; font-weight:700; color:var(--dark);">{{ $item->title }}</h3>
                        <span style="font-size:0.75rem; font-weight:600; padding:0.25rem 0.6rem; border-radius:999px; background:var(--primary-light); color:var(--primary);">{{ ucfirst($item->media_type) }}</span>
                    </div>
                    <p style="color:var(--text-muted); font-size:0.85rem;">{{ $item->category?->name ?? 'Project' }}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div style="margin-top:2rem;">{{ $portfolios->links() }}</div>
        @else
        <div class="card" style="padding:4rem; text-align:center;">
            <div class="card-icon" style="margin:0 auto 1rem; background:var(--bg-soft); color:var(--text-muted); width:80px; height:80px; border-radius:50%; font-size:2rem;"><i class="fas fa-folder-open"></i></div>
            <h3 style="font-size:1.25rem; font-weight:700; color:var(--dark); margin-bottom:0.5rem;">Coming Soon</h3>
            <p style="color:var(--text-sec);">Our portfolio showcase is being curated. Check back soon!</p>
        </div>
        @endif
    </div>
</section>
@endsection
