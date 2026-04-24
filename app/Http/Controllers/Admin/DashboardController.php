<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Message;
use App\Models\Payment;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'active_bookings' => Booking::whereNotIn('status', ['completed', 'delivered', 'cancelled'])->count(),
            'monthly_revenue' => Payment::successful()->whereMonth('paid_at', now()->month)->sum('amount'),
            'pending_messages' => Message::new()->count(),
            'total_bookings' => Booking::count(),
            'completed_projects' => Booking::whereIn('status', ['completed', 'delivered'])->count(),
        ];

        $recentBookings = Booking::with('user', 'service')->latest()->limit(5)->get();
        $recentActivities = ActivityLog::with('user')->latest()->limit(10)->get();
        $recentPayments = Payment::with('user', 'booking')
            ->successful()
            ->latest('paid_at')
            ->limit(5)
            ->get();

        $newMessages = Message::where('status', 'new')
            ->latest()
            ->limit(5)
            ->get();

        $monthlyRevenue = Payment::successful()
            ->where('paid_at', '>=', now()->subMonths(12))
            ->select(DB::raw('MONTH(paid_at) as month'), DB::raw('YEAR(paid_at) as year'), DB::raw('SUM(amount) as total'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $bookingStatusStats = Booking::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->orderByDesc('total')
            ->get();

        $staffMembers = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->whereIn('slug', ['admin', 'staff']);
            })
            ->orderBy('name')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentBookings',
            'recentActivities',
            'monthlyRevenue',
            'recentPayments',
            'newMessages',
            'bookingStatusStats',
            'staffMembers'
        ));
    }
}
