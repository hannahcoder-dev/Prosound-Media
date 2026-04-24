@extends('layouts.admin')
@section('page-title', 'Services')
@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <form style="display: flex; gap: 0.75rem;"><input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-input" style="width: 250px;"><button class="btn btn-outline btn-sm"><i class="fas fa-search"></i></button></form>
    <a href="{{ route('admin.services.create') }}" class="btn btn-accent"><i class="fas fa-plus"></i> Add Service</a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Service</th><th>Category</th><th>Price</th><th>Featured</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td><span class="badge badge-info">{{ $service->category->name }}</span></td>
                <td style="color: var(--accent); font-weight: 600;">{{ $service->formatted_price }}</td>
                <td>{!! $service->is_featured ? '<i class="fas fa-star" style="color: var(--gold);"></i>' : '<i class="far fa-star" style="color: var(--text-muted);"></i>' !!}</td>
                <td><span class="badge {{ $service->is_active ? 'badge-success' : 'badge-danger' }}">{{ $service->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 1rem;">{{ $services->links() }}</div>
</div>
@endsection
