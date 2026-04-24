@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
<div class="auth-card">
    <h2>Reset Your Password</h2>
    <p class="subtitle">Enter your email and we will send you a secure password reset link.</p>

    @if (session('status'))
        <div style="padding:0.75rem; background:#F0FDF4; border:1px solid #BBF7D0; border-radius:10px; color:#16A34A; margin-bottom:1.25rem; font-size:0.9rem;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
            @error('email')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-paper-plane"></i> Send Reset Link
        </button>
    </form>
</div>
<div class="auth-footer">Remembered your password? <a href="{{ route('login') }}">Back to login</a></div>
@endsection
