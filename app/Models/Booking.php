<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'service_id', 'booking_number', 'title', 'description',
        'status', 'priority', 'deadline', 'estimated_price', 'final_price',
        'admin_notes', 'started_at', 'completed_at', 'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'estimated_price' => 'decimal:2',
            'final_price' => 'decimal:2',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($booking) {
            if (empty($booking->booking_number)) {
                $booking->booking_number = 'PS-' . strtoupper(Str::random(8));
            }
        });
    }

    // ── Relationships ──
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function comments()
    {
        return $this->hasMany(BookingComment::class);
    }

    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function qrCode()
    {
        return $this->morphOne(QrCode::class, 'qr_codeable');
    }

    // ── Scopes ──
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ── Accessors ──
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'confirmed' => 'info',
            'in_progress' => 'primary',
            'review' => 'secondary',
            'completed' => 'success',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }

    public function getTotalPaidAttribute(): float
    {
        return $this->payments()->where('status', 'successful')->sum('amount');
    }
}
