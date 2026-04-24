@extends('layouts.admin') @section('page-title', 'Invoice ' . $invoice->invoice_number) @section('content')
<div style="max-width:700px;">
    <div class="admin-card" style="margin-bottom:1.5rem;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <h3>{{ $invoice->invoice_number }}</h3>
            <span class="badge badge-{{ $invoice->status == 'paid' ? 'success' : 'warning' }}" style="font-size:0.85rem; padding:0.3rem 1rem;">{{ ucfirst($invoice->status) }}</span>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1.5rem;">
            <div><span style="color:var(--text-muted); font-size:0.8rem;">Client</span><div>{{ $invoice->user->name }}</div></div>
            <div><span style="color:var(--text-muted); font-size:0.8rem;">Service</span><div>{{ $invoice->booking->service->name }}</div></div>
        </div>
        <div style="border-top:1px solid var(--border); padding-top:1rem;">
            <div style="display:flex; justify-content:space-between; padding:0.5rem 0; color:var(--text-sec);"><span>Subtotal</span><span>₦{{ number_format($invoice->subtotal, 2) }}</span></div>
            <div style="display:flex; justify-content:space-between; padding:0.5rem 0; color:var(--text-sec);"><span>Tax</span><span>₦{{ number_format($invoice->tax, 2) }}</span></div>
            <div style="display:flex; justify-content:space-between; padding:0.5rem 0; color:var(--text-sec);"><span>Discount</span><span>-₦{{ number_format($invoice->discount, 2) }}</span></div>
            <div style="display:flex; justify-content:space-between; padding:0.75rem 0; border-top:1px solid var(--border); font-size:1.2rem; font-weight:700;"><span>Total</span><span style="color:var(--accent);">₦{{ number_format($invoice->total, 2) }}</span></div>
        </div>
    </div>
    <div style="display:flex; gap:0.75rem;">
        <a href="{{ route('admin.invoices.pdf', $invoice) }}" class="btn btn-accent"><i class="fas fa-download"></i> Download PDF</a>
        @if($invoice->status !== 'paid')
        <form method="POST" action="{{ route('admin.invoices.mark-paid', $invoice) }}">@csrf @method('PATCH')<button class="btn btn-outline" style="color:var(--success); border-color:var(--success);"><i class="fas fa-check"></i> Mark Paid</button></form>
        @endif
    </div>
</div>
@endsection
