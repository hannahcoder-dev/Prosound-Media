@extends('layouts.auth') @section('title', 'Login')
@section('content')
<div class="auth-card">
    <h2>Welcome Back</h2>
    <p class="subtitle">Sign in to your Pro-Sound Media account</p>
    @if(session('status'))<div style="padding:0.75rem; background:#F0FDF4; border:1px solid #BBF7D0; border-radius:10px; color:#16A34A; margin-bottom:1.25rem; font-size:0.9rem;">{{ session('status') }}</div>@endif
    <form method="POST" action="{{ route('login') }}">@csrf
        <div class="form-group"><label class="form-label">Email Address</label><input type="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus placeholder="you@example.com">@error('email')<p class="error-text">{{ $message }}</p>@enderror</div>
        <div class="form-group"><label class="form-label" style="display:flex; justify-content:space-between;">Password @if(Route::has('password.request'))<a href="{{ route('password.request') }}" style="color:#FF0000; text-decoration:none; font-size:0.8rem;">Forgot?</a>@endif</label><input type="password" name="password" class="form-input" required placeholder="••••••••">@error('password')<p class="error-text">{{ $message }}</p>@enderror</div>
        <div class="form-group" style="display:flex; align-items:center; gap:0.5rem;"><input type="checkbox" name="remember" id="remember" style="accent-color:#FF0000;"><label for="remember" style="font-size:0.85rem; color:#64748B;">Remember me</label></div>
        <button type="submit" class="btn-submit"><i class="fas fa-sign-in-alt"></i> Sign In</button>
    </form>
</div>
<div class="auth-footer">Don't have an account? <a href="{{ route('register') }}">Create one</a></div>
@endsection
