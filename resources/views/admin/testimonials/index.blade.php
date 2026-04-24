@extends('layouts.admin')
@section('page-title', 'Testimonials')
@section('content')
<div style="display: flex; justify-content: flex-end; margin-bottom: 1.5rem;">
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-accent"><i class="fas fa-plus"></i> Add Testimonial</a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Client</th><th>Rating</th><th>Featured</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($testimonials as $t)
            <tr>
                <td><div>{{ $t->client_name }}</div><div style="font-size:0.8rem; color:var(--text-muted);">{{ $t->client_title }}</div></td>
                <td style="color: var(--gold);">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star"></i>@endfor</td>
                <td>{!! $t->is_featured ? '<i class="fas fa-star" style="color:var(--gold)"></i>' : '—' !!}</td>
                <td><span class="badge {{ $t->is_active ? 'badge-success' : 'badge-danger' }}">{{ $t->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td style="display:flex; gap:0.5rem;">
                    <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
