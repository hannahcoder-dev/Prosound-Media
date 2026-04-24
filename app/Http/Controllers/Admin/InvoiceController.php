<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Booking;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('booking', 'user');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $invoices = $query->latest()->paginate(15);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create(Booking $booking)
    {
        return view('admin.invoices.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Booking::find($validated['booking_id'])->user_id;
        $validated['tax'] = $validated['tax'] ?? 0;
        $validated['discount'] = $validated['discount'] ?? 0;
        $validated['total'] = $validated['subtotal'] + $validated['tax'] - $validated['discount'];
        $validated['status'] = 'sent';

        $invoice = Invoice::create($validated);
        ActivityLog::log('invoice.created', "Created invoice: {$invoice->invoice_number}", $invoice);

        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('booking.service', 'user', 'payments');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load('booking.service', 'user');
        $pdf = Pdf::loadView('admin.invoices.pdf', compact('invoice'));
        return $pdf->download("Invoice-{$invoice->invoice_number}.pdf");
    }

    public function markPaid(Invoice $invoice)
    {
        $invoice->update(['status' => 'paid', 'paid_at' => now()]);
        ActivityLog::log('invoice.paid', "Invoice {$invoice->invoice_number} marked as paid", $invoice);

        return back()->with('success', 'Invoice marked as paid.');
    }
}
