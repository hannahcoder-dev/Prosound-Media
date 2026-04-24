@extends('layouts.admin')
@section('page-title', 'Add Service')
@section('content')
<div class="admin-card" style="max-width: 700px;">
    <form method="POST" action="{{ route('admin.services.store') }}">
        @csrf
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
            <div class="form-group"><label class="form-label">Service Name *</label><input type="text" name="name" value="{{ old('name') }}" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Category *</label><select name="category_id" class="form-input" required>@foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->name }}</option>@endforeach</select></div>
        </div>
        <div class="form-group"><label class="form-label">Short Description</label><input type="text" name="short_description" value="{{ old('short_description') }}" class="form-input"></div>
        <div class="form-group"><label class="form-label">Full Description</label><textarea name="description" class="form-input">{{ old('description') }}</textarea></div>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
            <div class="form-group"><label class="form-label">Base Price (₦) *</label><input type="number" name="base_price" value="{{ old('base_price', 0) }}" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Price Unit</label><input type="text" name="price_unit" value="{{ old('price_unit', 'per project') }}" class="form-input"></div>
            <div class="form-group"><label class="form-label">Icon (FA class)</label><input type="text" name="icon" value="{{ old('icon', 'fas fa-music') }}" class="form-input"></div>
        </div>
        <div class="form-group"><label class="form-label">Features (one per line)</label><textarea name="features" class="form-input" rows="5" placeholder="Feature 1&#10;Feature 2">{{ old('features') }}</textarea></div>
        <div style="display: flex; gap: 2rem; margin-bottom: 1rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-sec);"><input type="checkbox" name="is_featured" value="1"> Featured</label>
            <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-sec);"><input type="checkbox" name="is_active" value="1" checked> Active</label>
        </div>
        <div style="display: flex; gap: 1rem;"><button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Create Service</button><a href="{{ route('admin.services.index') }}" class="btn btn-outline">Cancel</a></div>
    </form>
</div>
@endsection
