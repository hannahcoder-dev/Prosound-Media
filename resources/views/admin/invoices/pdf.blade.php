<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Invoice {{ $invoice->invoice_number }}</title>
<style>body{font-family:Arial,sans-serif;font-size:14px;color:#333;margin:40px;} .header{display:flex;justify-content:space-between;margin-bottom:40px;} .logo{font-size:24px;font-weight:bold;color:#7c3aed;} table{width:100%;border-collapse:collapse;margin:20px 0;} th,td{padding:10px;text-align:left;border-bottom:1px solid #eee;} th{background:#f8f9fa;} .total-row{font-weight:bold;font-size:16px;} .footer{margin-top:40px;text-align:center;color:#666;font-size:12px;}</style>
</head><body>
<div class="header"><div><div class="logo">PROSOUND MEDIA</div><div style="color:#666;">15 Studio Lane, Victoria Island, Lagos</div><div style="color:#666;">info@prosoundmedia.com</div></div><div style="text-align:right;"><h2>INVOICE</h2><div>{{ $invoice->invoice_number }}</div><div>Date: {{ $invoice->created_at->format('M d, Y') }}</div>@if($invoice->due_date)<div>Due: {{ $invoice->due_date->format('M d, Y') }}</div>@endif</div></div>
<div style="margin-bottom:30px;"><strong>Bill To:</strong><div>{{ $invoice->user->name }}</div><div>{{ $invoice->user->email }}</div>@if($invoice->user->company)<div>{{ $invoice->user->company }}</div>@endif</div>
<table><thead><tr><th>Description</th><th>Service</th><th style="text-align:right;">Amount</th></tr></thead><tbody>
<tr><td>{{ $invoice->booking->title }}</td><td>{{ $invoice->booking->service->name }}</td><td style="text-align:right;">₦{{ number_format($invoice->subtotal, 2) }}</td></tr>
</tbody></table>
<div style="width:300px;margin-left:auto;">
<div style="display:flex;justify-content:space-between;padding:5px 0;"><span>Subtotal</span><span>₦{{ number_format($invoice->subtotal, 2) }}</span></div>
<div style="display:flex;justify-content:space-between;padding:5px 0;"><span>Tax</span><span>₦{{ number_format($invoice->tax, 2) }}</span></div>
<div style="display:flex;justify-content:space-between;padding:5px 0;"><span>Discount</span><span>-₦{{ number_format($invoice->discount, 2) }}</span></div>
<div style="display:flex;justify-content:space-between;padding:10px 0;border-top:2px solid #333;font-size:18px;font-weight:bold;"><span>Total</span><span style="color:#7c3aed;">₦{{ number_format($invoice->total, 2) }}</span></div>
</div>
@if($invoice->notes)<div style="margin-top:30px;"><strong>Notes:</strong><p>{{ $invoice->notes }}</p></div>@endif
<div class="footer"><p>Thank you for your business!</p><p>Pro-Sound Media — Premium Audio & Media Production</p></div>
</body></html>
