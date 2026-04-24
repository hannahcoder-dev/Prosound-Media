<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('service')->latest()->paginate(10);
        return view('client.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $services = Service::active()->with('category')->orderBy('sort_order')->get();
        return view('client.bookings.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'priority' => 'required|in:low,medium,high,urgent',
            'deadline' => 'nullable|date|after:today',
        ]);

        $service = Service::findOrFail($validated['service_id']);
        $validated['user_id'] = auth()->id();
        $validated['estimated_price'] = $service->base_price;

        $booking = Booking::create($validated);

        return redirect()->route('client.bookings.show', $booking)->with('success', 'Booking submitted successfully!');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load('service', 'comments.user', 'projectFiles', 'invoices', 'payments');

        return view('client.bookings.show', compact('booking'));
    }

    public function addComment(Request $request, Booking $booking)
    {
        $this->authorize('view', $booking);

        $request->validate(['comment' => 'required|string|max:5000']);

        $booking->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
            'is_internal' => false,
        ]);

        return back()->with('success', 'Comment added.');
    }
}
