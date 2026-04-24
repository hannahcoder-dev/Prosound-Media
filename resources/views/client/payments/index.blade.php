@extends('layouts.client')
@section('page-title', 'Payment History')
@section('content')
<div class="client-card">
    <table class="client-table"><thead><tr><th>Reference</th><th>Booking</th><th>Amount</th><th>Gateway</th><th>Status</th><th>Date</th></tr></thead><tbody>
        @forelse($payments as $p)
        <tr>
            <td style="font-family:monospace; font-size:0.8rem;">{{ $p->gateway_reference ?? '—' }}</td>
            <td><a href="{{ route('client.bookings.show', $p->booking_id) }}" style="color:var(--accent);">{{ $p->booking?->booking_number }}</a></td>
            <td style="font-weight:600;">₦{{ number_format($p->amount) }}</td>
            <td><span class="badge badge-info">{{ ucfirst($p->gateway) }}</span></td>
            <td><span class="badge badge-{{ $p->status=='successful'?'success':($p->status=='pending'?'warning':'danger') }}">{{ ucfirst($p->status) }}</span></td>
            <td style="font-size:0.85rem;">{{ $p->created_at->format('M d, Y') }}</td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center; color:var(--text-muted); padding:2rem;">No payment history yet</td></tr>
        @endforelse
    </tbody></table>
    <div style="margin-top:1rem;">{{ $payments->links() }}</div>
</div>
@endsection
