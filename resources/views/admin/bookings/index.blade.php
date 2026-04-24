@extends('layouts.admin')
@section('page-title', 'Bookings')
@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <form style="display: flex; gap: 0.75rem;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search booking #..." class="form-input" style="width: 250px;">
        <select name="status" class="form-input" style="width: 150px;" onchange="this.form.submit()">
            <option value="">All Status</option>
            @foreach(['pending','confirmed','in_progress','review','completed','delivered','cancelled'] as $s)
                <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline btn-sm"><i class="fas fa-search"></i></button>
    </form>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Booking #</th><th>Title</th><th>Client</th><th>Service</th><th>Status</th><th>Priority</th><th>Date</th><th></th></tr></thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td><a href="{{ route('admin.bookings.show', $b) }}" style="color: var(--accent); font-weight: 600;">{{ $b->booking_number }}</a></td>
                <td>{{ Str::limit($b->title, 30) }}</td>
                <td>{{ $b->user->name }}</td>
                <td>{{ $b->service->name }}</td>
                <td><span class="badge badge-{{ $b->status_badge }}">{{ ucfirst(str_replace('_',' ',$b->status)) }}</span></td>
                <td><span class="badge badge-{{ $b->priority == 'urgent' ? 'danger' : ($b->priority == 'high' ? 'warning' : 'info') }}">{{ ucfirst($b->priority) }}</span></td>
                <td style="font-size: 0.85rem;">{{ $b->created_at->format('M d') }}</td>
                <td><a href="{{ route('admin.bookings.show', $b) }}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 1rem;">{{ $bookings->links() }}</div>
</div>
@endsection
