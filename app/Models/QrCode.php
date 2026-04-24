<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QrCode extends Model
{
    protected $fillable = [
        'qr_codeable_id', 'qr_codeable_type', 'code', 'qr_image_path',
        'scan_count', 'last_scanned_at',
    ];

    protected function casts(): array
    {
        return ['last_scanned_at' => 'datetime'];
    }

    protected static function booted(): void
    {
        static::creating(function ($qrCode) {
            if (empty($qrCode->code)) {
                $qrCode->code = 'QR-' . strtoupper(Str::random(12));
            }
        });
    }

    public function qrCodeable()
    {
        return $this->morphTo();
    }

    public function recordScan(): void
    {
        $this->increment('scan_count');
        $this->update(['last_scanned_at' => now()]);
    }
}
