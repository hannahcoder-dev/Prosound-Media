@extends('layouts.client')
@section('page-title', 'Dashboard')
@section('content')
<div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:1.25rem; margin-bottom:2rem;">
    @foreach([
        ['label'=>'Active Bookings', 'value'=>$stats['active_bookings'], 'icon'=>'fas fa-calendar-check', 'color'=>'var(--accent)', 'bg'=>'rgba(124,58,237,0.15)'],
        ['label'=>'Completed Projects', 'value'=>$stats['completed_projects'], 'icon'=>'fas fa-check-circle', 'color'=>'var(--success)', 'bg'=>'rgba(16,185,129,0.15)'],
        ['label'=>'Total Spent', 'value'=>'₦'.number_format($stats['total_spent']), 'icon'=>'fas fa-wallet', 'color'=>'var(--cyan)', 'bg'=>'rgba(6,182,212,0.15)'],
        ['label'=>'Pending Invoices', 'value'=>$stats['pending_invoices'], 'icon'=>'fas fa-file-invoice', 'color'=>'var(--gold)', 'bg'=>'rgba(245,158,11,0.15)'],
    ] as $stat)
    <div class="client-card stat-card">
        <div class="stat-icon" style="background:{{ $stat['bg'] }}; color:{{ $stat['color'] }};"><i class="{{ $stat['icon'] }}"></i></div>
        <div><div class="stat-number">{{ $stat['value'] }}</div><div class="stat-label">{{ $stat['label'] }}</div></div>
    </div>
    @endforeach
</div>

<div style="display:grid; grid-template-columns:1.5fr 1fr; gap:1.5rem;">
    {{-- Recent Bookings --}}
    <div class="client-card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem;">
            <h3 style="font-size:1rem;">Recent Bookings</h3>
            <a href="{{ route('client.bookings.create') }}" class="btn btn-accent btn-sm"><i class="fas fa-plus"></i> New Booking</a>
        </div>
        <table class="client-table"><thead><tr><th>Booking</th><th>Service</th><th>Status</th><th>Date</th></tr></thead><tbody>
            @forelse($recentBookings as $b)
            <tr>
                <td><a href="{{ route('client.bookings.show', $b) }}" style="color:var(--accent); font-weight:600;">{{ $b->booking_number }}</a></td>
                <td>{{ $b->service->name }}</td>
                <td><span class="badge badge-{{ $b->status_badge }}">{{ ucfirst(str_replace('_',' ',$b->status)) }}</span></td>
                <td style="font-size:0.85rem;">{{ $b->created_at->format('M d') }}</td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center; color:var(--text-muted);">No bookings yet. <a href="{{ route('client.bookings.create') }}" style="color:var(--accent);">Create one!</a></td></tr>
            @endforelse
        </tbody></table>
    </div>

    {{-- Pending Invoices --}}
    <div class="client-card">
        <h3 style="font-size:1rem; margin-bottom:1.25rem;">Pending Invoices</h3>
        @forelse($pendingInvoices as $inv)
        <div style="padding:0.75rem; border:1px solid var(--border); border-radius:10px; margin-bottom:0.75rem; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <div style="font-weight:600; font-size:0.9rem;">{{ $inv->invoice_number }}</div>
                <div style="font-size:0.8rem; color:var(--text-muted);">Due {{ $inv->due_date?->format('M d') ?? 'N/A' }}</div>
            </div>
            <div style="text-align:right;">
                <div style="color:var(--accent); font-weight:700;">₦{{ number_format($inv->total) }}</div>
                <form method="POST" action="{{ route('client.payments.paystack', $inv) }}" style="margin-top:0.25rem;">@csrf
                    <button class="btn btn-accent btn-sm"><i class="fas fa-lock"></i> Pay</button>
                </form>
            </div>
        </div>
        @empty
        <p style="color:var(--text-muted); text-align:center; font-size:0.9rem;">No pending invoices 🎉</p>
        @endforelse
    </div>
</div>
@endsection
