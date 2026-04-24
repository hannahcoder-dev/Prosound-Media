<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('user', 'booking', 'invoice');

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->gateway) {
            $query->where('gateway', $request->gateway);
        }

        $payments = $query->latest()->paginate(15);
        $totalRevenue = Payment::successful()->sum('amount');
        $monthlyRevenue = Payment::successful()->whereMonth('paid_at', now()->month)->sum('amount');

        return view('admin.payments.index', compact('payments', 'totalRevenue', 'monthlyRevenue'));
    }

    public function show(Payment $payment)
    {
        $payment->load('user', 'booking', 'invoice');
        return view('admin.payments.show', compact('payment'));
    }
}
