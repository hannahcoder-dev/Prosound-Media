@extends('layouts.client')
@section('page-title', 'My Bookings')
@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('client.bookings.create') }}" class="btn btn-accent"><i class="fas fa-plus"></i> New Booking</a>
</div>
<div class="client-card">
    <table class="client-table"><thead><tr><th>Booking #</th><th>Title</th><th>Service</th><th>Status</th><th>Priority</th><th>Created</th><th></th></tr></thead><tbody>
        @forelse($bookings as $b)
        <tr>
            <td style="font-weight:600; color:var(--accent);">{{ $b->booking_number }}</td>
            <td>{{ Str::limit($b->title, 30) }}</td>
            <td>{{ $b->service->name }}</td>
            <td><span class="badge badge-{{ $b->status_badge }}">{{ ucfirst(str_replace('_',' ',$b->status)) }}</span></td>
            <td><span class="badge badge-{{ $b->priority=='urgent'?'danger':($b->priority=='high'?'warning':'info') }}">{{ ucfirst($b->priority) }}</span></td>
            <td style="font-size:0.85rem;">{{ $b->created_at->format('M d, Y') }}</td>
            <td><a href="{{ route('client.bookings.show', $b) }}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a></td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center; color:var(--text-muted); padding:2rem;">No bookings yet. <a href="{{ route('client.bookings.create') }}" style="color:var(--accent);">Create your first booking!</a></td></tr>
        @endforelse
    </tbody></table>
    <div style="margin-top:1rem;">{{ $bookings->links() }}</div>
</div>
@endsection
