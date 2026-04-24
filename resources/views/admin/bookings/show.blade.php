@extends('layouts.admin')
@section('page-title', 'Booking ' . $booking->booking_number)
@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    <div>
        {{-- Booking Info --}}
        <div class="admin-card" style="margin-bottom: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3>{{ $booking->title }}</h3>
                <span class="badge badge-{{ $booking->status_badge }}" style="font-size: 0.85rem; padding: 0.3rem 1rem;">{{ ucfirst(str_replace('_',' ',$booking->status)) }}</span>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div><span style="color: var(--text-muted); font-size: 0.8rem;">Client</span><div>{{ $booking->user->name }}</div></div>
                <div><span style="color: var(--text-muted); font-size: 0.8rem;">Service</span><div>{{ $booking->service->name }}</div></div>
                <div><span style="color: var(--text-muted); font-size: 0.8rem;">Priority</span><div><span class="badge badge-{{ $booking->priority == 'urgent' ? 'danger' : 'warning' }}">{{ ucfirst($booking->priority) }}</span></div></div>
                <div><span style="color: var(--text-muted); font-size: 0.8rem;">Deadline</span><div>{{ $booking->deadline?->format('M d, Y') ?? 'Not set' }}</div></div>
                <div><span style="color: var(--text-muted); font-size: 0.8rem;">Est. Price</span><div style="color: var(--accent); font-weight: 600;">₦{{ number_format($booking->estimated_price ?? 0) }}</div></div>
                <div><span style="color: var(--text-muted); font-size: 0.8rem;">Total Paid</span><div style="color: var(--success); font-weight: 600;">₦{{ number_format($booking->total_paid) }}</div></div>
            </div>
            @if($booking->description)<p style="color: var(--text-sec); font-size: 0.9rem; line-height: 1.7; border-top: 1px solid var(--border); padding-top: 1rem;">{{ $booking->description }}</p>@endif
        </div>

        {{-- Comments --}}
        <div class="admin-card" style="margin-bottom: 1.5rem;">
            <h3 style="margin-bottom: 1rem;">Comments</h3>
            @foreach($booking->comments as $comment)
            <div style="padding: 1rem; background: {{ $comment->is_internal ? 'rgba(245,158,11,0.05)' : 'var(--main-bg)' }}; border-radius: 10px; margin-bottom: 0.75rem; border: 1px solid {{ $comment->is_internal ? 'rgba(245,158,11,0.2)' : 'var(--border)' }};">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span style="font-weight: 600; font-size: 0.9rem;">{{ $comment->user->name }} @if($comment->is_internal)<span class="badge badge-warning" style="margin-left: 0.5rem;">Internal</span>@endif</span>
                    <span style="color: var(--text-muted); font-size: 0.8rem;">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p style="color: var(--text-sec); font-size: 0.9rem;">{{ $comment->comment }}</p>
            </div>
            @endforeach
            <form method="POST" action="{{ route('admin.bookings.comment', $booking) }}" style="margin-top: 1rem;">
                @csrf
                <textarea name="comment" class="form-input" placeholder="Add a comment..." rows="3" required></textarea>
                <div style="display: flex; gap: 1rem; align-items: center; margin-top: 0.75rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-sec); font-size: 0.85rem;"><input type="checkbox" name="is_internal" value="1"> Internal note (not visible to client)</label>
                    <button class="btn btn-accent btn-sm" style="margin-left: auto;"><i class="fas fa-paper-plane"></i> Send</button>
                </div>
            </form>
        </div>
    </div>

    <div>
        {{-- Status Update --}}
        <div class="admin-card" style="margin-bottom: 1.5rem;">
            <h4 style="margin-bottom: 1rem;">Update Status</h4>
            <form method="POST" action="{{ route('admin.bookings.update-status', $booking) }}">
                @csrf @method('PATCH')
                <select name="status" class="form-input" style="margin-bottom: 0.75rem;">
                    @foreach(['pending','confirmed','in_progress','review','completed','delivered','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $booking->status == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                    @endforeach
                </select>
                <button class="btn btn-accent btn-sm" style="width: 100%;"><i class="fas fa-sync"></i> Update Status</button>
            </form>
        </div>

        {{-- Quick Actions --}}
        <div class="admin-card" style="margin-bottom: 1.5rem;">
            <h4 style="margin-bottom: 1rem;">Actions</h4>
            <a href="{{ route('admin.invoices.create', $booking) }}" class="btn btn-outline btn-sm" style="width: 100%; margin-bottom: 0.5rem; justify-content: center;"><i class="fas fa-file-invoice"></i> Generate Invoice</a>
            <form method="POST" action="{{ route('admin.bookings.destroy', $booking) }}" onsubmit="return confirm('Are you sure?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" style="width: 100%; justify-content: center;"><i class="fas fa-trash"></i> Delete Booking</button>
            </form>
        </div>

        {{-- Files --}}
        <div class="admin-card">
            <h4 style="margin-bottom: 1rem;">Files ({{ $booking->projectFiles->count() }})</h4>
            @forelse($booking->projectFiles as $file)
            <div style="padding: 0.5rem 0; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 0.85rem;">{{ $file->original_name }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $file->formatted_size }}</div>
                </div>
                @if($file->is_deliverable)<span class="badge badge-success">Deliverable</span>@endif
            </div>
            @empty
            <p style="color: var(--text-muted); font-size: 0.85rem;">No files uploaded yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
