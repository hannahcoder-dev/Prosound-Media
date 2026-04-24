@extends('layouts.auth') @section('title', 'Create Account')
@section('content')
<div class="auth-card">
    <h2>Get Started</h2>
    <p class="subtitle">Create your Pro-Sound Media account</p>
    <form method="POST" action="{{ route('register') }}">@csrf
        <div class="form-group"><label class="form-label">Full Name</label><input type="text" name="name" class="form-input" value="{{ old('name') }}" required autofocus placeholder="John Doe">@error('name')<p class="error-text">{{ $message }}</p>@enderror</div>
        <div class="form-group"><label class="form-label">Email Address</label><input type="email" name="email" class="form-input" value="{{ old('email') }}" required placeholder="you@example.com">@error('email')<p class="error-text">{{ $message }}</p>@enderror</div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group"><label class="form-label">Password</label><input type="password" name="password" class="form-input" required placeholder="••••••••">@error('password')<p class="error-text">{{ $message }}</p>@enderror</div>
            <div class="form-group"><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" class="form-input" required placeholder="••••••••"></div>
        </div>
        <button type="submit" class="btn-submit"><i class="fas fa-rocket"></i> Create Account</button>
    </form>
</div>
<div class="auth-footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></div>
@endsection
