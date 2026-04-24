@extends('layouts.public')
@section('title', $service->name . ' — Pro-Sound Media')

@section('content')
<section style="padding:5rem 2rem;">
    <div class="container" style="max-width:900px;">
        <a href="{{ route('services.index') }}" style="color:var(--primary); font-size:0.9rem; display:inline-flex; align-items:center; gap:0.5rem; margin-bottom:2rem;"><i class="fas fa-arrow-left"></i> Back to Services</a>

        <div class="card-icon" style="background:var(--primary-light); color:var(--primary); width:70px; height:70px; border-radius:18px; font-size:1.5rem; margin-bottom:1.5rem;"><i class="{{ $service->icon ?? 'fas fa-music' }}"></i></div>
        <span class="section-badge">{{ $service->category->name }}</span>
        <h1 class="section-title">{{ $service->name }}</h1>
        <p style="font-size:1.5rem; font-weight:800; color:var(--primary); margin-bottom:2rem;">{{ $service->formatted_price }} <span style="font-size:0.9rem; color:var(--text-muted); font-weight:400;">/ {{ $service->price_unit ?? 'project' }}</span></p>

        <div style="color:var(--text-sec); font-size:1rem; line-height:1.9; margin-bottom:2.5rem;">
            {!! nl2br(e($service->description ?? $service->short_description)) !!}
        </div>

        @if(is_array($service->features) && count($service->features))
        <div class="card" style="margin-bottom:2.5rem;">
            <h3 style="margin-bottom:1.25rem; font-size:1.1rem;">What's Included</h3>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem;">
                @foreach($service->features as $f)
                <div style="display:flex; align-items:center; gap:0.75rem; padding:0.5rem 0;">
                    <div style="width:28px; height:28px; min-width:28px; border-radius:8px; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center; font-size:0.7rem;"><i class="fas fa-check"></i></div>
                    <span style="font-size:0.9rem; color:var(--text-sec);">{{ $f }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div style="display:flex; gap:1rem;">
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg"><i class="fas fa-paper-plane"></i> Enquire Now</a>
            <a href="tel:08035190167" class="btn btn-outline btn-lg"><i class="fas fa-phone"></i> Call Us</a>
        </div>

        @if($relatedServices->count())
        <div style="margin-top:4rem; padding-top:3rem; border-top:1px solid var(--border);">
            <h3 style="margin-bottom:1.5rem;">Related Services</h3>
            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1.25rem;">
                @foreach($relatedServices as $rs)
                <a href="{{ route('services.show', $rs->slug) }}" class="card" style="text-decoration:none;">
                    <h4 style="margin-bottom:0.25rem;">{{ $rs->name }}</h4>
                    <span style="color:var(--primary); font-weight:700;">{{ $rs->formatted_price }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
