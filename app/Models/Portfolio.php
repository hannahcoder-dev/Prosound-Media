<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'description', 'media_type',
        'media_url', 'thumbnail_url', 'client_name', 'is_featured', 'is_public', 'views_count',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_public' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'category_id');
    }

    public function qrCode()
    {
        return $this->morphOne(QrCode::class, 'qr_codeable');
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
