@extends('layouts.public')
@section('title', 'Pricing — Pro-Sound Media')

@section('content')
{{-- Hero Banner --}}
<section style="position:relative; height:400px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
    <img src="{{ asset('images/mall-installation.png') }}" alt="Our Pricing" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(220,38,38,0.3) 100%);"></div>
    <div style="position:relative; z-index:2; text-align:center; padding:0 2rem;">
        <div class="section-badge" style="background:rgba(255,0,0,0.2); color:#FCA5A5; border:1px solid rgba(255,0,0,0.3);"><i class="fas fa-tag"></i> Pricing</div>
        <h1 style="font-size:3rem; font-weight:900; color:white; margin-top:1rem; text-shadow:0 2px 20px rgba(0,0,0,0.5);">Transparent Pricing Plans</h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.1rem; max-width:600px; margin:1rem auto 0;">Professional audio engineering packages tailored for every need and budget.</p>
    </div>
</section>

<section style="padding:5rem 2rem; background:var(--bg-soft);">
    <div class="container">

        <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1.5rem; margin-bottom:4rem;">
            @php
            $plans = [
                [
                    'name' => 'Basic',
                    'price' => '150,000',
                    'desc' => 'Perfect for small events and gatherings',
                    'features' => ['Small PA system setup', '1 Sound Engineer', 'Up to 200 guests', '4-hour event coverage', 'Basic microphone package', 'Standard mixing'],
                    'featured' => false,
                ],
                [
                    'name' => 'Professional',
                    'price' => '450,000',
                    'desc' => 'Ideal for concerts, conferences & churches',
                    'features' => ['Full line array system', '2 Sound Engineers', 'Up to 2,000 guests', '8-hour event coverage', 'Premium microphones', 'Multi-track recording', 'Stage monitoring', 'Lighting integration'],
                    'featured' => true,
                ],
                [
                    'name' => 'Enterprise',
                    'price' => 'Custom',
                    'desc' => 'For permanent installations & large events',
                    'features' => ['Custom system design', 'Full engineering team', 'Unlimited capacity', 'Multi-day events', 'Professional recording', 'Video production', 'Installation & setup', 'Ongoing maintenance'],
                    'featured' => false,
                ],
            ];
            @endphp

            @foreach($plans as $plan)
            <div class="card" style="text-align:center; {{ $plan['featured'] ? 'border-color:var(--primary); position:relative; transform:scale(1.03); box-shadow:var(--shadow-xl);' : '' }}">
                @if($plan['featured'])<div style="position:absolute; top:-12px; left:50%; transform:translateX(-50%); background:var(--primary); color:white; font-size:0.75rem; font-weight:700; padding:0.3rem 1.5rem; border-radius:999px;">MOST POPULAR</div>@endif
                <h3 style="font-size:1.35rem; font-weight:800; margin-bottom:0.25rem; margin-top:{{ $plan['featured'] ? '0.5rem' : '0' }};">{{ $plan['name'] }}</h3>
                <p style="color:var(--text-muted); font-size:0.85rem; margin-bottom:1.5rem;">{{ $plan['desc'] }}</p>
                <div style="margin-bottom:2rem;">
                    <span style="font-size:0.9rem; color:var(--text-muted);">from</span>
                    <div style="font-size:2.5rem; font-weight:900; color:{{ $plan['featured'] ? 'var(--primary)' : 'var(--dark)' }};">₦{{ $plan['price'] }}</div>
                </div>
                <ul style="list-style:none; text-align:left; margin-bottom:2rem;">
                    @foreach($plan['features'] as $f)
                    <li style="padding:0.5rem 0; border-bottom:1px solid var(--border-light); font-size:0.9rem; color:var(--text-sec); display:flex; align-items:center; gap:0.75rem;">
                        <i class="fas fa-check" style="color:var(--primary); font-size:0.75rem;"></i> {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('contact') }}" class="btn {{ $plan['featured'] ? 'btn-primary' : 'btn-outline' }}" style="width:100%; justify-content:center;">Get Started</a>
            </div>
            @endforeach
        </div>

        {{-- FAQ --}}
        <div style="max-width:700px; margin:0 auto;">
            <div style="text-align:center; margin-bottom:2rem;">
                <h2 class="section-title" style="font-size:2rem;">Frequently Asked Questions</h2>
            </div>
            @foreach([
                ['q' => 'How far in advance should I book?', 'a' => 'We recommend booking at least 2-4 weeks in advance for most events. For large-scale events or installations, 1-2 months advance notice is ideal.'],
                ['q' => 'Do you travel outside Abuja?', 'a' => 'Absolutely! We cover events and installations nationwide across Nigeria. Travel costs are included in our quotes for locations within 200km of Abuja.'],
                ['q' => 'What brands of equipment do you use?', 'a' => 'We work with industry-standard brands including JBL, QSC, Yamaha, Allen & Heath, Shure, and Sennheiser.'],
                ['q' => 'Do you offer installation warranties?', 'a' => 'Yes, all permanent installations come with a standard 12-month warranty covering equipment and workmanship.'],
            ] as $faq)
            <div x-data="{ open: false }" style="border:1px solid var(--border); border-radius:12px; margin-bottom:0.75rem; overflow:hidden;">
                <button @click="open = !open" style="width:100%; padding:1rem 1.5rem; display:flex; justify-content:space-between; align-items:center; background:white; border:none; cursor:pointer; font-family:inherit; font-size:0.95rem; font-weight:600; color:var(--text);">
                    {{ $faq['q'] }}
                    <i class="fas" :class="open ? 'fa-minus' : 'fa-plus'" style="color:var(--primary); font-size:0.8rem;"></i>
                </button>
                <div x-show="open" x-transition style="padding:0 1.5rem 1rem; color:var(--text-sec); font-size:0.9rem; line-height:1.7;">{{ $faq['a'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
