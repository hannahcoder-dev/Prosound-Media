@extends('layouts.admin') @section('page-title', 'Edit Portfolio Item') @section('content')
<div class="admin-card" style="max-width:600px;"><form method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}">@csrf @method('PUT')
    <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" value="{{ $portfolio->title }}" class="form-input" required></div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
        <div class="form-group"><label class="form-label">Category *</label><select name="category_id" class="form-input">@foreach($categories as $c)<option value="{{ $c->id }}" {{ $portfolio->category_id==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach</select></div>
        <div class="form-group"><label class="form-label">Media Type *</label><select name="media_type" class="form-input"><option value="audio" {{ $portfolio->media_type=='audio'?'selected':'' }}>Audio</option><option value="video" {{ $portfolio->media_type=='video'?'selected':'' }}>Video</option><option value="image" {{ $portfolio->media_type=='image'?'selected':'' }}>Image</option></select></div>
    </div>
    <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-input" rows="3">{{ $portfolio->description }}</textarea></div>
    <div class="form-group"><label class="form-label">Media URL</label><input type="text" name="media_url" value="{{ $portfolio->media_url }}" class="form-input"></div>
    <div class="form-group"><label class="form-label">Client Name</label><input type="text" name="client_name" value="{{ $portfolio->client_name }}" class="form-input"></div>
    <div style="display:flex; gap:2rem; margin-bottom:1rem;">
        <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_featured" value="1" {{ $portfolio->is_featured?'checked':'' }}> Featured</label>
        <label style="display:flex; align-items:center; gap:0.5rem; color:var(--text-sec);"><input type="checkbox" name="is_public" value="1" {{ $portfolio->is_public?'checked':'' }}> Public</label>
    </div>
    <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Update</button>
</form></div>
@endsection
