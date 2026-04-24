<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingComment;
use App\Models\Service;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('user', 'service');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('booking_number', 'like', "%{$request->search}%")
                  ->orWhere('title', 'like', "%{$request->search}%");
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('user', 'service', 'comments.user', 'projectFiles.user', 'payments', 'invoices');
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,in_progress,review,completed,delivered,cancelled']);

        $oldStatus = $booking->status;
        $booking->status = $request->status;

        if ($request->status === 'in_progress' && !$booking->started_at) {
            $booking->started_at = now();
        }
        if ($request->status === 'completed') {
            $booking->completed_at = now();
        }
        if ($request->status === 'delivered') {
            $booking->delivered_at = now();
        }

        $booking->save();

        ActivityLog::log('booking.status', "Booking {$booking->booking_number}: {$oldStatus} → {$request->status}", $booking);

        return back()->with('success', "Booking status updated to {$request->status}.");
    }

    public function addComment(Request $request, Booking $booking)
    {
        $request->validate([
            'comment' => 'required|string|max:5000',
            'is_internal' => 'boolean',
        ]);

        $booking->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'is_internal' => $request->boolean('is_internal'),
        ]);

        return back()->with('success', 'Comment added.');
    }

    public function updateNotes(Request $request, Booking $booking)
    {
        $request->validate(['admin_notes' => 'nullable|string']);
        $booking->update(['admin_notes' => $request->admin_notes]);

        return back()->with('success', 'Notes updated.');
    }

    public function destroy(Booking $booking)
    {
        ActivityLog::log('booking.deleted', "Deleted booking: {$booking->booking_number}");
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted.');
    }
}
