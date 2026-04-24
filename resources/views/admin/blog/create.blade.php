@extends('layouts.admin') @section('page-title', 'New Blog Post') @section('content')
<div class="admin-card" style="max-width:800px;"><form method="POST" action="{{ route('admin.blog.store') }}">@csrf
    <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="form-input" required></div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
        <div class="form-group"><label class="form-label">Category</label><select name="category_id" class="form-input"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></div>
        <div class="form-group"><label class="form-label">Status *</label><select name="status" class="form-input"><option value="draft">Draft</option><option value="published">Published</option></select></div>
    </div>
    <div class="form-group"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-input" rows="2"></textarea></div>
    <div class="form-group"><label class="form-label">Content *</label><textarea name="content" class="form-input" rows="12" required></textarea></div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
        <div class="form-group"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-input"></div>
        <div class="form-group"><label class="form-label">Meta Description</label><input type="text" name="meta_description" class="form-input"></div>
    </div>
    <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Publish</button>
</form></div>
@endsection
