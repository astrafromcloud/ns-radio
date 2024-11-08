<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    /** @use HasFactory<\Database\Factories\BannerFactory> */
    use HasFactory;

    protected $guarded = false;

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($banner) {
            if (!$banner->order) {
                $banner->order = static::max('order') + 1;
            }
        });

        static::deleting(function ($banner) {
            $deletedOrder = $banner->order;

            Banner::where('order', '>', $deletedOrder)
                ->decrement('order');
        });
    }
}
