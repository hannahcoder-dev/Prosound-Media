@extends('layouts.admin') @section('page-title', 'Payments') @section('content')
<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-bottom:1.5rem;">
    <div class="admin-card stat-card"><div class="stat-icon" style="background:rgba(16,185,129,0.15); color:var(--success);"><i class="fas fa-chart-line"></i></div><div><div class="stat-number">₦{{ number_format($totalRevenue) }}</div><div class="stat-label">Total Revenue</div></div></div>
    <div class="admin-card stat-card"><div class="stat-icon" style="background:rgba(124,58,237,0.15); color:var(--accent);"><i class="fas fa-calendar"></i></div><div><div class="stat-number">₦{{ number_format($monthlyRevenue) }}</div><div class="stat-label">This Month</div></div></div>
</div>
<div class="admin-card">
<table class="admin-table"><thead><tr><th>Reference</th><th>Client</th><th>Amount</th><th>Gateway</th><th>Status</th><th>Date</th></tr></thead><tbody>
    @foreach($payments as $p)
    <tr><td style="font-family:monospace; font-size:0.8rem;">{{ $p->gateway_reference ?? '—' }}</td><td>{{ $p->user->name }}</td><td style="font-weight:600;">₦{{ number_format($p->amount) }}</td><td><span class="badge badge-info">{{ ucfirst($p->gateway) }}</span></td><td><span class="badge badge-{{ $p->status == 'successful' ? 'success' : ($p->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($p->status) }}</span></td><td style="font-size:0.85rem;">{{ $p->created_at->format('M d, Y') }}</td></tr>
    @endforeach
</tbody></table><div style="margin-top:1rem;">{{ $payments->links() }}</div></div>
@endsection
