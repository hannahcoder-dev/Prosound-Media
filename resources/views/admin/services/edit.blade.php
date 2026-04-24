@extends('layouts.admin')
@section('page-title', 'Edit Service')
@section('content')
<div class="admin-card" style="max-width: 700px;">
    <form method="POST" action="{{ route('admin.services.update', $service) }}">
        @csrf @method('PUT')
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
            <div class="form-group"><label class="form-label">Service Name *</label><input type="text" name="name" value="{{ old('name', $service->name) }}" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Category *</label><select name="category_id" class="form-input" required>@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ $service->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select></div>
        </div>
        <div class="form-group"><label class="form-label">Short Description</label><input type="text" name="short_description" value="{{ old('short_description', $service->short_description) }}" class="form-input"></div>
        <div class="form-group"><label class="form-label">Full Description</label><textarea name="description" class="form-input">{{ old('description', $service->description) }}</textarea></div>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
            <div class="form-group"><label class="form-label">Base Price (₦) *</label><input type="number" name="base_price" value="{{ old('base_price', $service->base_price) }}" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Price Unit</label><input type="text" name="price_unit" value="{{ old('price_unit', $service->price_unit) }}" class="form-input"></div>
            <div class="form-group"><label class="form-label">Icon</label><input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="form-input"></div>
        </div>
        <div class="form-group"><label class="form-label">Features (one per line)</label><textarea name="features" class="form-input" rows="5">{{ old('features', is_array($service->features) ? implode("\n", $service->features) : '') }}</textarea></div>
        <div style="display: flex; gap: 2rem; margin-bottom: 1rem;">
            <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-sec);"><input type="checkbox" name="is_featured" value="1" {{ $service->is_featured ? 'checked' : '' }}> Featured</label>
            <label style="display: flex; align-items: center; gap: 0.5rem; color: var(--text-sec);"><input type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}> Active</label>
        </div>
        <div style="display: flex; gap: 1rem;"><button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Update Service</button><a href="{{ route('admin.services.index') }}" class="btn btn-outline">Cancel</a></div>
    </form>
</div>
@endsection
