@extends('layouts.admin')
@section('page-title', 'Edit User')
@section('content')
<div class="admin-card" style="max-width: 600px;">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf @method('PUT')
        <div class="form-group"><label class="form-label">Full Name *</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Email *</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input" required></div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group"><label class="form-label">Phone</label><input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-input"></div>
            <div class="form-group"><label class="form-label">Company</label><input type="text" name="company" value="{{ old('company', $user->company) }}" class="form-input"></div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label class="form-label">Role *</label>
                <select name="role" class="form-input" required>
                    @foreach($roles as $role)<option value="{{ $role->slug }}" {{ $user->roles->first()?->slug == $role->slug ? 'selected' : '' }}>{{ $role->name }}</option>@endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-input">
                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Update User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
