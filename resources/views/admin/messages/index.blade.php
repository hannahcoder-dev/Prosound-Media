@extends('layouts.admin')
@section('page-title', 'Messages')
@section('content')
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>From</th><th>Subject</th><th>Status</th><th>Date</th><th></th></tr></thead>
        <tbody>
            @foreach($messages as $msg)
            <tr>
                <td><div>{{ $msg->name }}</div><div style="font-size:0.8rem; color:var(--text-muted);">{{ $msg->email }}</div></td>
                <td>{{ Str::limit($msg->subject, 40) }}</td>
                <td><span class="badge badge-{{ $msg->status == 'new' ? 'warning' : ($msg->status == 'replied' ? 'success' : 'info') }}">{{ ucfirst($msg->status) }}</span></td>
                <td style="font-size:0.85rem;">{{ $msg->created_at->format('M d, Y') }}</td>
                <td><a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 1rem;">{{ $messages->links() }}</div>
</div>
@endsection
