@extends('layouts.admin')
@section('page-title', 'Message from ' . $message->name)
@section('content')
<div style="max-width: 700px;">
    <div class="admin-card" style="margin-bottom: 1.5rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
            <div><span style="color:var(--text-muted); font-size:0.8rem;">From</span><div>{{ $message->name }}</div></div>
            <div><span style="color:var(--text-muted); font-size:0.8rem;">Email</span><div>{{ $message->email }}</div></div>
            <div><span style="color:var(--text-muted); font-size:0.8rem;">Phone</span><div>{{ $message->phone ?? 'N/A' }}</div></div>
            <div><span style="color:var(--text-muted); font-size:0.8rem;">Date</span><div>{{ $message->created_at->format('M d, Y H:i') }}</div></div>
        </div>
        <div style="border-top: 1px solid var(--border); padding-top: 1rem;">
            <h4 style="margin-bottom: 0.5rem;">{{ $message->subject }}</h4>
            <p style="color: var(--text-sec); line-height: 1.8;">{{ $message->message }}</p>
        </div>
    </div>
    @if($message->admin_reply)
    <div class="admin-card" style="margin-bottom: 1.5rem; border-color: rgba(16,185,129,0.3);">
        <h4 style="color: var(--success); margin-bottom: 0.5rem;">Your Reply</h4>
        <p style="color: var(--text-sec);">{{ $message->admin_reply }}</p>
        <div style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.5rem;">Replied {{ $message->replied_at->diffForHumans() }}</div>
    </div>
    @else
    <div class="admin-card">
        <h4 style="margin-bottom: 1rem;">Reply</h4>
        <form method="POST" action="{{ route('admin.messages.reply', $message) }}">
            @csrf
            <textarea name="admin_reply" class="form-input" rows="4" required placeholder="Type your reply..."></textarea>
            <button class="btn btn-accent" style="margin-top: 0.75rem;"><i class="fas fa-reply"></i> Send Reply</button>
        </form>
    </div>
    @endif
</div>
@endsection
