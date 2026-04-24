@extends('layouts.admin')
@section('page-title', 'Edit Testimonial')
@section('content')
<div class="admin-card" style="max-width: 600px;">
    <form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}">@csrf @method('PUT')
        <div class="form-group"><label class="form-label">Client Name *</label><input type="text" name="client_name" value="{{ $testimonial->client_name }}" class="form-input" required></div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group"><label class="form-label">Title</label><input type="text" name="client_title" value="{{ $testimonial->client_title }}" class="form-input"></div>
            <div class="form-group"><label class="form-label">Company</label><input type="text" name="client_company" value="{{ $testimonial->client_company }}" class="form-input"></div>
        </div>
        <div class="form-group"><label class="form-label">Testimonial Content *</label><textarea name="content" class="form-input" rows="4" required>{{ $testimonial->content }}</textarea></div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group"><label class="form-label">Rating *</label><input type="number" name="rating" min="1" max="5" value="{{ $testimonial->rating }}" class="form-input"></div>
            <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" value="{{ $testimonial->sort_order }}" class="form-input"></div>
        </div>
        <div style="display:flex; gap:2rem; margin-bottom:1rem;">
            <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_featured" value="1" {{ $testimonial->is_featured ? 'checked' : '' }}> Featured</label>
            <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}> Active</label>
        </div>
        <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Update</button>
    </form>
</div>
@endsection
