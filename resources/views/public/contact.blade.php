@extends('layouts.public')
@section('title', 'Contact Us — Pro-Sound Media')

@section('content')
{{-- Hero Banner --}}
<section style="position:relative; height:400px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
    <img src="{{ asset('images/training-workshop.png') }}" alt="Contact Us" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(220,38,38,0.3) 100%);"></div>
    <div style="position:relative; z-index:2; text-align:center; padding:0 2rem;">
        <div class="section-badge" style="background:rgba(255,0,0,0.2); color:#FCA5A5; border:1px solid rgba(255,0,0,0.3);"><i class="fas fa-envelope"></i> Get In Touch</div>
        <h1 style="font-size:3rem; font-weight:900; color:white; margin-top:1rem; text-shadow:0 2px 20px rgba(0,0,0,0.5);">Contact Us</h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.1rem; max-width:600px; margin:1rem auto 0;">Have a project in mind? Let's discuss how we can deliver the perfect sound for your event or venue.</p>
    </div>
</section>

<section style="padding:5rem 2rem; background:var(--bg-soft);">
    <div class="container">

        <div style="display:grid; grid-template-columns:1fr 1.5fr; gap:3rem;">
            {{-- Contact Info --}}
            <div>
                <div class="card" style="margin-bottom:1.5rem;">
                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <div style="width:50px; height:50px; min-width:50px; border-radius:12px; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center;"><i class="fas fa-map-marker-alt fa-lg"></i></div>
                        <div>
                            <h4 style="margin-bottom:0.35rem;">Our Office</h4>
                            <p style="color:var(--text-sec); font-size:0.9rem; line-height:1.7;">Kolhed Records, Suit A42 Efab Mall,<br>Area II Shopping Complex, Ahmadu Bello Way,<br>Area II Garki, Abuja, Nigeria</p>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-bottom:1.5rem;">
                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <div style="width:50px; height:50px; min-width:50px; border-radius:12px; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center;"><i class="fas fa-phone fa-lg"></i></div>
                        <div>
                            <h4 style="margin-bottom:0.35rem;">Phone Numbers</h4>
                            <p style="color:var(--text-sec); font-size:0.9rem; line-height:1.8;">
                                <a href="tel:08035190167" style="color:var(--primary);">0803 519 0167</a><br>
                                <a href="tel:08094546479" style="color:var(--primary);">0809 454 6479</a><br>
                                <a href="tel:08163745793" style="color:var(--primary);">0816 374 5793</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div style="display:flex; gap:1rem; align-items:flex-start;">
                        <div style="width:50px; height:50px; min-width:50px; border-radius:12px; background:var(--primary-light); color:var(--primary); display:flex; align-items:center; justify-content:center;"><i class="fas fa-envelope fa-lg"></i></div>
                        <div>
                            <h4 style="margin-bottom:0.35rem;">Email</h4>
                            <p style="color:var(--text-sec); font-size:0.9rem;">info@prosoundmedia.ng</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="card">
                <h3 style="margin-bottom:1.5rem; font-size:1.25rem;">Send Us a Message</h3>
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div style="margin-bottom:1rem;"><label style="display:block; font-size:0.85rem; font-weight:600; color:var(--text-sec); margin-bottom:0.35rem;">Full Name *</label><input type="text" name="name" required style="width:100%; padding:0.7rem 1rem; border:1px solid var(--border); border-radius:10px; font-size:0.9rem; font-family:inherit; background:var(--bg-soft);" placeholder="John Doe"></div>
                        <div style="margin-bottom:1rem;"><label style="display:block; font-size:0.85rem; font-weight:600; color:var(--text-sec); margin-bottom:0.35rem;">Email *</label><input type="email" name="email" required style="width:100%; padding:0.7rem 1rem; border:1px solid var(--border); border-radius:10px; font-size:0.9rem; font-family:inherit; background:var(--bg-soft);" placeholder="you@example.com"></div>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div style="margin-bottom:1rem;"><label style="display:block; font-size:0.85rem; font-weight:600; color:var(--text-sec); margin-bottom:0.35rem;">Phone</label><input type="text" name="phone" style="width:100%; padding:0.7rem 1rem; border:1px solid var(--border); border-radius:10px; font-size:0.9rem; font-family:inherit; background:var(--bg-soft);" placeholder="0803 519 0167"></div>
                        <div style="margin-bottom:1rem;"><label style="display:block; font-size:0.85rem; font-weight:600; color:var(--text-sec); margin-bottom:0.35rem;">Subject *</label><input type="text" name="subject" required style="width:100%; padding:0.7rem 1rem; border:1px solid var(--border); border-radius:10px; font-size:0.9rem; font-family:inherit; background:var(--bg-soft);" placeholder="Event Sound Setup"></div>
                    </div>
                    <div style="margin-bottom:1.25rem;"><label style="display:block; font-size:0.85rem; font-weight:600; color:var(--text-sec); margin-bottom:0.35rem;">Message *</label><textarea name="message" rows="5" required style="width:100%; padding:0.7rem 1rem; border:1px solid var(--border); border-radius:10px; font-size:0.9rem; font-family:inherit; resize:vertical; background:var(--bg-soft);" placeholder="Tell us about your project..."></textarea></div>
                    <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;"><i class="fas fa-paper-plane"></i> Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
