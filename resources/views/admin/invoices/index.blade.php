@extends('layouts.admin') @section('page-title', 'Invoices') @section('content')
<div class="admin-card">
<table class="admin-table"><thead><tr><th>Invoice #</th><th>Client</th><th>Total</th><th>Status</th><th>Due Date</th><th></th></tr></thead><tbody>
    @foreach($invoices as $inv)
    <tr><td style="font-weight:600; color:var(--accent);">{{ $inv->invoice_number }}</td><td>{{ $inv->user->name }}</td><td>₦{{ number_format($inv->total) }}</td><td><span class="badge badge-{{ $inv->status == 'paid' ? 'success' : ($inv->status == 'overdue' ? 'danger' : 'warning') }}">{{ ucfirst($inv->status) }}</span></td><td>{{ $inv->due_date?->format('M d, Y') ?? '—' }}</td>
    <td style="display:flex; gap:0.5rem;"><a href="{{ route('admin.invoices.show', $inv) }}" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i></a><a href="{{ route('admin.invoices.pdf', $inv) }}" class="btn btn-outline btn-sm"><i class="fas fa-download"></i></a></td></tr>
    @endforeach
</tbody></table><div style="margin-top:1rem;">{{ $invoices->links() }}</div></div>
@endsection
