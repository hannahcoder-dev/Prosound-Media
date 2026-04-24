<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingComment extends Model
{
    protected $fillable = ['booking_id', 'user_id', 'comment', 'is_internal', 'attachments'];

    protected function casts(): array
    {
        return [
            'is_internal' => 'boolean',
            'attachments' => 'array',
        ];
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
