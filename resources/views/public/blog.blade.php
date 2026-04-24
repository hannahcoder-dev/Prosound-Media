@extends('layouts.public')
@section('title', 'Blog — Pro-Sound Media')

@section('content')
{{-- Hero Banner --}}
<section style="position:relative; height:400px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
    <img src="{{ asset('images/live-concert.png') }}" alt="Our Blog" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(220,38,38,0.3) 100%);"></div>
    <div style="position:relative; z-index:2; text-align:center; padding:0 2rem;">
        <div class="section-badge" style="background:rgba(255,0,0,0.2); color:#FCA5A5; border:1px solid rgba(255,0,0,0.3);"><i class="fas fa-newspaper"></i> Latest News</div>
        <h1 style="font-size:3rem; font-weight:900; color:white; margin-top:1rem; text-shadow:0 2px 20px rgba(0,0,0,0.5);">{{ isset($category) ? $category->name : 'Our Blog' }}</h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.1rem; max-width:600px; margin:1rem auto 0;">Tips, tutorials, and insights from the Pro-Sound engineering team.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        @if($posts->count())
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 1.75rem;">
            @foreach($posts as $post)
            <div class="card" style="padding:0; overflow:hidden; border:none; box-shadow:var(--shadow-lg); display:flex; flex-direction:column;">
                <a href="{{ route('blog.show', $post->slug) }}" style="display:block; height:220px; background:linear-gradient(135deg, var(--primary-light), var(--bg-soft)); position:relative; overflow:hidden;">
                    <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center;">
                        <i class="fas fa-newspaper" style="font-size:3.5rem; color:var(--primary); opacity:0.8;"></i>
                    </div>
                </a>
                <div style="padding:1.5rem; flex:1; display:flex; flex-direction:column; background:white; border:1px solid var(--border); border-top:none; border-radius:0 0 var(--radius) var(--radius);">
                    @if($post->category)
                        <span style="font-size:0.75rem; font-weight:700; color:var(--primary); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:0.75rem; display:block;">
                            {{ $post->category->name }}
                        </span>
                    @endif
                    <h3 style="font-size:1.25rem; font-weight:800; color:var(--dark); margin-bottom:0.75rem; line-height:1.4;">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p style="color:var(--text-sec); font-size:0.95rem; line-height:1.6; margin-bottom:1.5rem; flex:1;">
                        {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
                    </p>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-top:1rem; border-top:1px solid var(--border-light); color:var(--text-muted); font-size:0.85rem; font-weight:500;">
                        <span><i class="far fa-calendar-alt" style="margin-right:0.3rem;"></i> {{ $post->published_at?->format('F d, Y') ?? 'Draft' }}</span>
                        <span><i class="far fa-clock" style="margin-right:0.3rem;"></i> {{ $post->reading_time }} min read</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:3rem;">{{ $posts->links() }}</div>
        @else
        <div class="card" style="padding:5rem 2rem; text-align:center;">
            <div style="width:80px; height:80px; border-radius:50%; background:var(--bg-soft); color:var(--text-muted); display:flex; align-items:center; justify-content:center; font-size:2rem; margin:0 auto 1.5rem;"><i class="fas fa-pen-nib"></i></div>
            <h3 style="font-size:1.5rem; font-weight:800; color:var(--dark); margin-bottom:0.5rem;">Coming Soon</h3>
            <p style="color:var(--text-sec); font-size:1.05rem;">We're preparing insightful content about sound engineering. Stay tuned!</p>
        </div>
        @endif
    </div>
</section>
@endsection
