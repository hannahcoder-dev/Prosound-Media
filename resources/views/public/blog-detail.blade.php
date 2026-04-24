@extends('layouts.public')
@section('title', $post->meta_title ?? $post->title . ' — Pro-Sound Media')

@section('content')
<article class="section">
    <div class="container" style="max-width:800px;">
        <a href="{{ route('blog.index') }}" style="color:var(--primary); font-size:0.9rem; font-weight:600; display:inline-flex; align-items:center; gap:0.5rem; margin-bottom:2rem;">
            <i class="fas fa-arrow-left"></i> Back to Blog
        </a>
        
        <div style="margin-bottom:2rem;">
            @if($post->category)
                <span style="font-size:0.8rem; font-weight:700; color:var(--primary); text-transform:uppercase; letter-spacing:0.05em; display:block; margin-bottom:1rem;">
                    {{ $post->category->name }}
                </span>
            @endif
            <h1 style="font-size:2.75rem; font-weight:900; color:var(--dark); line-height:1.2; margin-bottom:1.5rem;">{{ $post->title }}</h1>
            
            <div style="display:flex; flex-wrap:wrap; align-items:center; gap:1.5rem; padding-bottom:1.5rem; border-bottom:1px solid var(--border);">
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <div style="width:40px; height:40px; border-radius:50%; background:var(--primary); color:white; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                        {{ substr($post->author->name, 0, 1) }}
                    </div>
                    <div style="font-size:0.95rem; font-weight:600; color:var(--dark);">{{ $post->author->name }}</div>
                </div>
                <div style="color:var(--text-sec); font-size:0.9rem;"><i class="far fa-calendar-alt"></i> {{ $post->published_at?->format('F d, Y') }}</div>
                <div style="color:var(--text-sec); font-size:0.9rem;"><i class="far fa-clock"></i> {{ $post->reading_time }} min read</div>
                <div style="color:var(--text-sec); font-size:0.9rem;"><i class="far fa-eye"></i> {{ $post->views_count }} views</div>
            </div>
        </div>
        
        <div style="color:var(--text-sec); font-size:1.1rem; line-height:1.9;">
            {!! $post->content !!}
        </div>
        
        @if($post->tags->count())
        <div style="margin-top:3rem; padding-top:2rem; border-top:1px solid var(--border); display:flex; flex-wrap:wrap; gap:0.5rem;">
            @foreach($post->tags as $tag)
                <span style="background:var(--bg-soft); color:var(--text-sec); padding:0.4rem 1rem; border-radius:999px; font-size:0.85rem; font-weight:500;">
                    #{{ $tag->name }}
                </span>
            @endforeach
        </div>
        @endif
        
        <div class="card" style="margin-top:4rem; background:var(--bg-soft); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:2rem;">
            <div>
                <h3 style="font-size:1.25rem; font-weight:800; color:var(--dark); margin-bottom:0.5rem;">Need Professional Audio Engineering?</h3>
                <p style="color:var(--text-sec); font-size:0.95rem;">Contact our team to discuss your next project.</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Get in Touch</a>
        </div>
    </div>
</article>
@endsection
