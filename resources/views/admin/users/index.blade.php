@extends('layouts.admin')
@section('page-title', 'Users')
@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <form style="display: flex; gap: 0.75rem;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." class="form-input" style="width: 250px;">
        <select name="role" class="form-input" style="width: 150px;" onchange="this.form.submit()">
            <option value="">All Roles</option>
            @foreach($roles as $role)<option value="{{ $role->slug }}" {{ request('role') == $role->slug ? 'selected' : '' }}>{{ $role->name }}</option>@endforeach
        </select>
        <button class="btn btn-outline btn-sm"><i class="fas fa-search"></i></button>
    </form>
    <a href="{{ route('admin.users.create') }}" class="btn btn-accent"><i class="fas fa-plus"></i> Add User</a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, var(--accent), var(--cyan)); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem; color: white;">{{ substr($user->name, 0, 1) }}</div>
                    {{ $user->name }}
                </td>
                <td>{{ $user->email }}</td>
                <td><span class="badge badge-primary">{{ $user->roles->first()?->name ?? 'N/A' }}</span></td>
                <td><span class="badge {{ $user->is_active ? 'badge-success' : 'badge-danger' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span></td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" style="display: inline;">@csrf @method('PATCH')
                        <button class="btn btn-sm {{ $user->is_active ? 'btn-danger' : 'btn-outline' }}"><i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 1rem;">{{ $users->links() }}</div>
</div>
@endsection
