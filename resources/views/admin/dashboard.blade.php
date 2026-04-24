@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('content')
@php
    $statusColors = [
        'pending' => ['color' => 'var(--warning)', 'bg' => 'rgba(245,158,11,0.15)'],
        'confirmed' => ['color' => 'var(--cyan)', 'bg' => 'rgba(6,182,212,0.15)'],
        'in_progress' => ['color' => 'var(--accent)', 'bg' => 'rgba(124,58,237,0.15)'],
        'review' => ['color' => 'var(--accent)', 'bg' => 'rgba(124,58,237,0.15)'],
        'completed' => ['color' => 'var(--success)', 'bg' => 'rgba(16,185,129,0.15)'],
        'delivered' => ['color' => 'var(--success)', 'bg' => 'rgba(16,185,129,0.15)'],
        'cancelled' => ['color' => 'var(--danger)', 'bg' => 'rgba(239,68,68,0.15)'],
    ];
@endphp

{{-- Stat Cards --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2rem;">
    @foreach([
        ['label' => 'Total Users', 'value' => $stats['total_users'], 'icon' => 'fas fa-users', 'color' => 'var(--accent)', 'bg' => 'rgba(124,58,237,0.15)'],
        ['label' => 'Active Bookings', 'value' => $stats['active_bookings'], 'icon' => 'fas fa-calendar-check', 'color' => 'var(--cyan)', 'bg' => 'rgba(6,182,212,0.15)'],
        ['label' => 'Monthly Revenue', 'value' => '₦' . number_format($stats['monthly_revenue']), 'icon' => 'fas fa-chart-line', 'color' => 'var(--success)', 'bg' => 'rgba(16,185,129,0.15)'],
        ['label' => 'Pending Messages', 'value' => $stats['pending_messages'], 'icon' => 'fas fa-envelope', 'color' => 'var(--gold)', 'bg' => 'rgba(245,158,11,0.15)'],
    ] as $stat)
    <div class="admin-card stat-card">
        <div class="stat-icon" style="background: {{ $stat['bg'] }}; color: {{ $stat['color'] }};">
            <i class="{{ $stat['icon'] }}"></i>
        </div>
        <div>
            <div class="stat-number">{{ $stat['value'] }}</div>
            <div class="stat-label">{{ $stat['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; margin-bottom: 1.5rem;">
    @foreach([
        ['label' => 'Total Bookings', 'value' => $stats['total_bookings'], 'icon' => 'fas fa-list-check', 'color' => 'var(--text)', 'bg' => 'rgba(148,163,184,0.15)'],
        ['label' => 'Completed Projects', 'value' => $stats['completed_projects'], 'icon' => 'fas fa-award', 'color' => 'var(--success)', 'bg' => 'rgba(16,185,129,0.15)'],
    ] as $extraStat)
    <div class="admin-card stat-card">
        <div class="stat-icon" style="background: {{ $extraStat['bg'] }}; color: {{ $extraStat['color'] }};">
            <i class="{{ $extraStat['icon'] }}"></i>
        </div>
        <div>
            <div class="stat-number">{{ $extraStat['value'] }}</div>
            <div class="stat-label">{{ $extraStat['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
    {{-- Recent Bookings --}}
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h3 style="font-size: 1rem;">Recent Bookings</h3>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline btn-sm">View All</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr><th>Booking</th><th>Client</th><th>Service</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($recentBookings as $booking)
                <tr>
                    <td><a href="{{ route('admin.bookings.show', $booking) }}" style="color: var(--accent);">{{ $booking->booking_number }}</a></td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td><span class="badge badge-{{ $booking->status_badge }}">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align: center; color: var(--text-muted);">No bookings yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Recent Activity --}}
    <div class="admin-card">
        <h3 style="font-size: 1rem; margin-bottom: 1.25rem;">Recent Activity</h3>
        @forelse($recentActivities as $activity)
        <div style="padding: 0.75rem 0; border-bottom: 1px solid var(--border); display: flex; gap: 0.75rem;">
            <div style="width: 32px; height: 32px; min-width: 32px; border-radius: 8px; background: rgba(124,58,237,0.1); display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-bolt" style="font-size: 0.7rem; color: var(--accent);"></i>
            </div>
            <div>
                <div style="font-size: 0.85rem;">{{ $activity->description }}</div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $activity->created_at->diffForHumans() }}</div>
            </div>
        </div>
        @empty
        <p style="color: var(--text-muted); font-size: 0.9rem;">No recent activity</p>
        @endforelse
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
    {{-- Revenue Trend --}}
    <div class="admin-card">
        <h3 style="font-size: 1rem; margin-bottom: 1.25rem;">Revenue Trend (12 Months)</h3>
        <div style="display: grid; gap: 0.6rem;">
            @forelse($monthlyRevenue as $entry)
                @php
                    $monthLabel = \Carbon\Carbon::createFromDate($entry->year, $entry->month, 1)->format('M Y');
                    $width = $stats['monthly_revenue'] > 0 ? min(100, ($entry->total / max(1, $stats['monthly_revenue'])) * 100) : 0;
                @endphp
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 0.2rem;">
                        <span style="color: var(--text-sec);">{{ $monthLabel }}</span>
                        <strong>₦{{ number_format($entry->total) }}</strong>
                    </div>
                    <div style="height: 8px; background: var(--main-bg); border-radius: 999px; overflow: hidden;">
                        <div style="width: {{ $width }}%; height: 100%; background: linear-gradient(90deg, var(--accent), var(--cyan));"></div>
                    </div>
                </div>
            @empty
                <p style="color: var(--text-muted); font-size: 0.9rem;">No revenue data yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Booking Status Overview --}}
    <div class="admin-card">
        <h3 style="font-size: 1rem; margin-bottom: 1.25rem;">Booking Status Overview</h3>
        <div style="display: grid; gap: 0.65rem;">
            @forelse($bookingStatusStats as $statusRow)
                @php
                    $statusStyle = $statusColors[$statusRow->status] ?? ['color' => 'var(--text-sec)', 'bg' => 'rgba(148,163,184,0.15)'];
                @endphp
                <div style="display: flex; align-items: center; justify-content: space-between; border: 1px solid var(--border); border-radius: 10px; padding: 0.7rem 0.9rem;">
                    <span class="badge" style="background: {{ $statusStyle['bg'] }}; color: {{ $statusStyle['color'] }};">
                        {{ ucfirst(str_replace('_', ' ', $statusRow->status)) }}
                    </span>
                    <strong>{{ number_format($statusRow->total) }}</strong>
                </div>
            @empty
                <p style="color: var(--text-muted); font-size: 0.9rem;">No status data available.</p>
            @endforelse
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
    {{-- Latest Payments --}}
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h3 style="font-size: 1rem;">Latest Payments</h3>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline btn-sm">Payments</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr><th>Client</th><th>Booking</th><th>Amount</th><th>Date</th></tr>
            </thead>
            <tbody>
                @forelse($recentPayments as $payment)
                    <tr>
                        <td>{{ $payment->user?->name ?? 'N/A' }}</td>
                        <td>{{ $payment->booking?->booking_number ?? 'N/A' }}</td>
                        <td style="font-weight: 600; color: var(--success);">₦{{ number_format($payment->amount) }}</td>
                        <td>{{ optional($payment->paid_at)->format('M d, Y') ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="text-align: center; color: var(--text-muted);">No recent successful payments</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- New Messages --}}
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h3 style="font-size: 1rem;">Newest Messages</h3>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline btn-sm">Messages</a>
        </div>
        <div style="display: grid; gap: 0.7rem;">
            @forelse($newMessages as $message)
                <div style="border: 1px solid var(--border); border-radius: 10px; padding: 0.75rem 0.9rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                        <strong style="font-size: 0.9rem;">{{ $message->name }}</strong>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $message->created_at->diffForHumans() }}</span>
                    </div>
                    <p style="font-size: 0.85rem; color: var(--text-sec); margin: 0.3rem 0;">{{ $message->subject ?: 'No subject' }}</p>
                    <a href="{{ route('admin.messages.show', $message) }}" style="color: var(--accent); text-decoration: none; font-size: 0.82rem;">Open message</a>
                </div>
            @empty
                <p style="color: var(--text-muted); font-size: 0.9rem;">No new messages right now.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="admin-card" style="margin-top: 1.5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
        <h3 style="font-size: 1rem;">Team Directory</h3>
        <a href="{{ route('admin.users.index', ['role' => 'staff']) }}" class="btn btn-outline btn-sm">View Staff</a>
    </div>
    <table class="admin-table">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Role</th><th>Phone</th><th>Status</th></tr>
        </thead>
        <tbody>
            @forelse($staffMembers as $staff)
                @php
                    $primaryRole = $staff->roles->pluck('slug')->first();
                @endphp
                <tr>
                    <td>{{ $staff->name }}</td>
                    <td>{{ $staff->email }}</td>
                    <td>{{ str_replace('_', ' ', ucfirst($primaryRole ?? 'N/A')) }}</td>
                    <td>{{ $staff->phone ?: 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $staff->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $staff->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="text-align: center; color: var(--text-muted);">No team accounts found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
