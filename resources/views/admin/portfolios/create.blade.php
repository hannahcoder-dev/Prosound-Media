@extends('layouts.admin') @section('page-title', 'Add Portfolio Item') @section('content')
<div class="admin-card" style="max-width:600px;"><form method="POST" action="{{ route('admin.portfolios.store') }}">@csrf
    <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="form-input" required></div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
        <div class="form-group"><label class="form-label">Category *</label><select name="category_id" class="form-input" required>@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></div>
        <div class="form-group"><label class="form-label">Media Type *</label><select name="media_type" class="form-input"><option value="audio">Audio</option><option value="video">Video</option><option value="image">Image</option></select></div>
    </div>
    <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-input" rows="3"></textarea></div>
    <div class="form-group"><label class="form-label">Media URL</label><input type="text" name="media_url" class="form-input"></div>
    <div class="form-group"><label class="form-label">Client Name</label><input type="text" name="client_name" class="form-input"></div>
    <div style="display:flex; gap:2rem; margin-bottom:1rem;">
        <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_featured" value="1"> Featured</label>
        <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_public" value="1" checked> Public</label>
    </div>
    <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Save</button>
</form></div>
@endsection
