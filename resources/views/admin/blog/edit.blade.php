@extends('layouts.admin') @section('page-title', 'Edit Post') @section('content')
<div class="admin-card" style="max-width:800px;"><form method="POST" action="{{ route('admin.blog.update', $post) }}">@csrf @method('PUT')
    <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" value="{{ $post->title }}" class="form-input" required></div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
        <div class="form-group"><label class="form-label">Category</label><select name="category_id" class="form-input"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}" {{ $post->category_id==$c->id?'selected':'' }}>{{ $c->name }}</option>@endforeach</select></div>
        <div class="form-group"><label class="form-label">Status</label><select name="status" class="form-input">@foreach(['draft','published','archived'] as $s)<option value="{{ $s }}" {{ $post->status==$s?'selected':'' }}>{{ ucfirst($s) }}</option>@endforeach</select></div>
    </div>
    <div class="form-group"><label class="form-label">Excerpt</label><textarea name="excerpt" class="form-input" rows="2">{{ $post->excerpt }}</textarea></div>
    <div class="form-group"><label class="form-label">Content *</label><textarea name="content" class="form-input" rows="12" required>{{ $post->content }}</textarea></div>
    <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Update</button>
</form></div>
@endsection
