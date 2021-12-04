<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'address', 'supplier', 'active',
    ];

    public $casts = [
        'active' => 'boolean',
        'rating' => 'float',
    ];

    public $appends = [
        'rating',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function getRatingAttribute(): float
    {
        $rating = 0;

        if ($this->loadExists('reviews')) {
            $rating = $this->reviews->average('rating');
        } else {
            $rating = $this->reviews()
                ->select(['id', 'hotel_id', 'rating'])
                ->average('rating');
        }

        return round($rating, 1);
    }
}
