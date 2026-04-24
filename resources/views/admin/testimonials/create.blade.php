@extends('layouts.admin')
@section('page-title', 'Add Testimonial')
@section('content')
<div class="admin-card" style="max-width: 600px;">
    <form method="POST" action="{{ route('admin.testimonials.store') }}">@csrf
        <div class="form-group"><label class="form-label">Client Name *</label><input type="text" name="client_name" class="form-input" required></div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group"><label class="form-label">Title</label><input type="text" name="client_title" class="form-input"></div>
            <div class="form-group"><label class="form-label">Company</label><input type="text" name="client_company" class="form-input"></div>
        </div>
        <div class="form-group"><label class="form-label">Testimonial Content *</label><textarea name="content" class="form-input" rows="4" required></textarea></div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
            <div class="form-group"><label class="form-label">Rating (1-5) *</label><input type="number" name="rating" min="1" max="5" value="5" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Sort Order</label><input type="number" name="sort_order" value="0" class="form-input"></div>
        </div>
        <div style="display:flex; gap:2rem; margin-bottom:1rem;">
            <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_featured" value="1"> Featured</label>
            <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        </div>
        <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Save</button>
    </form>
</div>
@endsection
