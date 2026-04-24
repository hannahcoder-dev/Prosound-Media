@extends('layouts.client')
@section('page-title', 'New Booking')
@section('content')
<div class="client-card" style="max-width:650px;">
    <form method="POST" action="{{ route('client.bookings.store') }}">
        @csrf
        <div class="form-group">
            <label class="form-label">Select Service *</label>
            <select name="service_id" class="form-input" required id="serviceSelect">
                <option value="">Choose a service...</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" data-price="{{ $service->base_price }}">
                        {{ $service->name }} ({{ $service->category->name }}) — ₦{{ number_format($service->base_price) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Project Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-input" required placeholder="e.g. My EP Recording Session">
        </div>
        <div class="form-group">
            <label class="form-label">Project Description</label>
            <textarea name="description" class="form-input" rows="4" placeholder="Describe your project, requirements, and any special notes...">{{ old('description') }}</textarea>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label class="form-label">Priority *</label>
                <select name="priority" class="form-input" required>
                    <option value="low">Low — Flexible timeline</option>
                    <option value="medium" selected>Medium — Standard delivery</option>
                    <option value="high">High — Rush delivery</option>
                    <option value="urgent">Urgent — ASAP</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Preferred Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline') }}" class="form-input" min="{{ now()->addDay()->format('Y-m-d') }}">
            </div>
        </div>
        <div style="padding:1rem; background:rgba(124,58,237,0.08); border:1px solid rgba(124,58,237,0.2); border-radius:10px; margin-bottom:1.5rem;">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <span style="color:var(--text-sec);">Estimated Price</span>
                <span id="estimatedPrice" style="font-size:1.25rem; font-weight:700; color:var(--accent);">Select a service</span>
            </div>
        </div>
        <button type="submit" class="btn btn-accent" style="width:100%; justify-content:center; padding:0.85rem;"><i class="fas fa-paper-plane"></i> Submit Booking Request</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('serviceSelect').addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    const price = option.dataset.price;
    document.getElementById('estimatedPrice').textContent = price ? '₦' + parseInt(price).toLocaleString() : 'Select a service';
});
</script>
@endpush
