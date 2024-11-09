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

        static::updating(function ($banner) {
            if ($banner->isDirty('is_active')) {
                if ($banner->is_active == false) {
                    $deactivatedOrder = $banner->order;

                    Banner::where('order', '>', $deactivatedOrder)
                        ->where('is_active', true)
                        ->decrement('order');
                } else {
                    $banner->order = Banner::where('is_active', true)->max('order') + 1;
                }
            }
        });
    }
}
