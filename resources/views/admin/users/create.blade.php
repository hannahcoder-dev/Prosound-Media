@extends('layouts.admin')
@section('page-title', 'Add User')
@section('content')
<div class="admin-card" style="max-width: 600px;">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="form-group"><label class="form-label">Full Name *</label><input type="text" name="name" value="{{ old('name') }}" class="form-input" required></div>
        <div class="form-group"><label class="form-label">Email *</label><input type="email" name="email" value="{{ old('email') }}" class="form-input" required></div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group"><label class="form-label">Password *</label><input type="password" name="password" class="form-input" required></div>
            <div class="form-group"><label class="form-label">Confirm Password *</label><input type="password" name="password_confirmation" class="form-input" required></div>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group"><label class="form-label">Phone</label><input type="text" name="phone" value="{{ old('phone') }}" class="form-input"></div>
            <div class="form-group"><label class="form-label">Company</label><input type="text" name="company" value="{{ old('company') }}" class="form-input"></div>
        </div>
        <div class="form-group">
            <label class="form-label">Role *</label>
            <select name="role" class="form-input" required>
                @foreach($roles as $role)<option value="{{ $role->slug }}">{{ $role->name }}</option>@endforeach
            </select>
        </div>
        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Create User</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
