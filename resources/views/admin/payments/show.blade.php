@extends('layouts.admin') @section('page-title', 'Payment Details') @section('content')
<div class="admin-card" style="max-width:600px;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Reference</span><div style="font-family:monospace;">{{ $payment->gateway_reference }}</div></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Amount</span><div style="font-size:1.5rem; font-weight:800; color:var(--accent);">{{ $payment->formatted_amount }}</div></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Client</span><div>{{ $payment->user->name }}</div></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Gateway</span><div>{{ ucfirst($payment->gateway) }}</div></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Status</span><div><span class="badge badge-{{ $payment->status == 'successful' ? 'success' : 'warning' }}">{{ ucfirst($payment->status) }}</span></div></div>
        <div><span style="color:var(--text-muted); font-size:0.8rem;">Date</span><div>{{ $payment->created_at->format('M d, Y H:i') }}</div></div>
    </div>
</div>
@endsection
