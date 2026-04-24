@extends('layouts.admin') @section('page-title', 'Create Invoice') @section('content')
<div class="admin-card" style="max-width:600px;">
    <p style="margin-bottom:1rem; color:var(--text-sec);">Creating invoice for booking <strong>{{ $booking->booking_number }}</strong> — {{ $booking->title }}</p>
    <form method="POST" action="{{ route('admin.invoices.store') }}">@csrf
        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        <div class="form-group"><label class="form-label">Subtotal (₦) *</label><input type="number" step="0.01" name="subtotal" value="{{ $booking->estimated_price ?? $booking->final_price ?? 0 }}" class="form-input" required></div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group"><label class="form-label">Tax (₦)</label><input type="number" step="0.01" name="tax" value="0" class="form-input"></div>
            <div class="form-group"><label class="form-label">Discount (₦)</label><input type="number" step="0.01" name="discount" value="0" class="form-input"></div>
        </div>
        <div class="form-group"><label class="form-label">Due Date</label><input type="date" name="due_date" class="form-input"></div>
        <div class="form-group"><label class="form-label">Notes</label><textarea name="notes" class="form-input" rows="3"></textarea></div>
        <button type="submit" class="btn btn-accent"><i class="fas fa-file-invoice"></i> Create Invoice</button>
    </form>
</div>
@endsection
