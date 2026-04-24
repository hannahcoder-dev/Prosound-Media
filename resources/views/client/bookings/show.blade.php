@extends('layouts.client')
@section('page-title', 'Booking ' . $booking->booking_number)
@section('content')
<div style="display:grid; grid-template-columns:2fr 1fr; gap:1.5rem;">
    <div>
        {{-- Booking Details --}}
        <div class="client-card" style="margin-bottom:1.5rem;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
                <h3>{{ $booking->title }}</h3>
                <span class="badge badge-{{ $booking->status_badge }}" style="font-size:0.85rem; padding:0.3rem 1rem;">{{ ucfirst(str_replace('_',' ',$booking->status)) }}</span>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                <div><span style="color:var(--text-muted); font-size:0.8rem;">Service</span><div>{{ $booking->service->name }}</div></div>
                <div><span style="color:var(--text-muted); font-size:0.8rem;">Priority</span><div><span class="badge badge-{{ $booking->priority=='urgent'?'danger':'warning' }}">{{ ucfirst($booking->priority) }}</span></div></div>
                <div><span style="color:var(--text-muted); font-size:0.8rem;">Deadline</span><div>{{ $booking->deadline?->format('M d, Y') ?? 'Not set' }}</div></div>
                <div><span style="color:var(--text-muted); font-size:0.8rem;">Created</span><div>{{ $booking->created_at->format('M d, Y') }}</div></div>
            </div>
            @if($booking->description)
            <div style="border-top:1px solid var(--border); padding-top:1rem;">
                <p style="color:var(--text-sec); font-size:0.9rem; line-height:1.8;">{{ $booking->description }}</p>
            </div>
            @endif
        </div>

        {{-- Comments --}}
        <div class="client-card" style="margin-bottom:1.5rem;">
            <h3 style="margin-bottom:1rem; font-size:1rem;">Messages</h3>
            @foreach($booking->comments->where('is_internal', false) as $comment)
            <div style="padding:1rem; background:var(--main-bg); border-radius:10px; margin-bottom:0.75rem; border:1px solid var(--border);">
                <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem;">
                    <span style="font-weight:600; font-size:0.9rem;">{{ $comment->user->name }}</span>
                    <span style="color:var(--text-muted); font-size:0.8rem;">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p style="color:var(--text-sec); font-size:0.9rem;">{{ $comment->comment }}</p>
            </div>
            @endforeach
            <form method="POST" action="{{ route('client.bookings.comment', $booking) }}" style="margin-top:1rem;">
                @csrf
                <textarea name="comment" class="form-input" placeholder="Send a message to the team..." rows="3" required></textarea>
                <button class="btn btn-accent btn-sm" style="margin-top:0.75rem;"><i class="fas fa-paper-plane"></i> Send</button>
            </form>
        </div>
    </div>

    <div>
        {{-- Files --}}
        <div class="client-card" style="margin-bottom:1.5rem;">
            <h4 style="margin-bottom:1rem; font-size:0.95rem;">Project Files</h4>
            @foreach($booking->projectFiles as $file)
            <div style="padding:0.5rem 0; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
                <div style="font-size:0.85rem;">
                    <i class="fas fa-file" style="color:var(--accent); margin-right:0.5rem;"></i>{{ $file->original_name }}
                    @if($file->is_deliverable)<span class="badge badge-success" style="margin-left:0.25rem;">Deliverable</span>@endif
                </div>
                <a href="{{ route('client.files.download', $file) }}" class="btn btn-outline btn-sm"><i class="fas fa-download"></i></a>
            </div>
            @endforeach

            <form method="POST" action="{{ route('client.files.upload', $booking) }}" enctype="multipart/form-data" style="margin-top:1rem;">
                @csrf
                <input type="file" name="file" class="form-input" required style="font-size:0.85rem;">
                <button class="btn btn-accent btn-sm" style="width:100%; margin-top:0.5rem; justify-content:center;"><i class="fas fa-upload"></i> Upload File</button>
            </form>
        </div>

        {{-- Invoices --}}
        <div class="client-card">
            <h4 style="margin-bottom:1rem; font-size:0.95rem;">Invoices</h4>
            @forelse($booking->invoices as $inv)
            <div style="padding:0.75rem; border:1px solid var(--border); border-radius:10px; margin-bottom:0.5rem;">
                <div style="display:flex; justify-content:space-between;">
                    <span style="font-weight:600; font-size:0.85rem;">{{ $inv->invoice_number }}</span>
                    <span class="badge badge-{{ $inv->status=='paid'?'success':'warning' }}">{{ ucfirst($inv->status) }}</span>
                </div>
                <div style="color:var(--accent); font-weight:700; margin-top:0.25rem;">₦{{ number_format($inv->total) }}</div>
                @if($inv->status !== 'paid')
                <form method="POST" action="{{ route('client.payments.paystack', $inv) }}" style="margin-top:0.5rem;">@csrf
                    <button class="btn btn-accent btn-sm" style="width:100%; justify-content:center;"><i class="fas fa-lock"></i> Pay Now</button>
                </form>
                @endif
            </div>
            @empty
            <p style="color:var(--text-muted); font-size:0.85rem;">No invoices yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
