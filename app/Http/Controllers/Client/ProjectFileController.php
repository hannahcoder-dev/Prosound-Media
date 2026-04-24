<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ProjectFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    public function upload(Request $request, Booking $booking)
    {
        $this->authorize('view', $booking);

        $request->validate([
            'file' => 'required|file|max:51200', // 50MB max
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs("bookings/{$booking->id}", $filename, 'public');

        ProjectFile::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return back()->with('success', 'File uploaded successfully.');
    }

    public function download(ProjectFile $file)
    {
        $this->authorize('view', $file->booking);

        $file->increment('download_count');
        return Storage::disk('public')->download($file->file_path, $file->original_name);
    }
}
