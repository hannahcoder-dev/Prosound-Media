<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'active_bookings' => $user->bookings()->whereNotIn('status', ['completed', 'delivered', 'cancelled'])->count(),
            'completed_projects' => $user->bookings()->whereIn('status', ['completed', 'delivered'])->count(),
            'total_spent' => $user->payments()->successful()->sum('amount'),
            'pending_invoices' => Invoice::where('user_id', $user->id)->whereIn('status', ['sent', 'overdue'])->count(),
        ];

        $recentBookings = $user->bookings()->with('service')->latest()->limit(5)->get();
        $pendingInvoices = Invoice::where('user_id', $user->id)->whereIn('status', ['sent', 'overdue'])->latest()->limit(5)->get();

        return view('client.dashboard', compact('stats', 'recentBookings', 'pendingInvoices'));
    }
}
