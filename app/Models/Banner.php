<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
                $maxOrder = static::where('is_active', true)->max('order') ?? 0;
                $banner->order = $maxOrder + 1;
            }
        });

        static::deleting(function ($banner) {
            if ($banner->is_active) {
                $deletedOrder = $banner->order;

                DB::transaction(function () use ($deletedOrder) {
                    static::where('is_active', true)
                        ->where('order', '>', $deletedOrder)
                        ->increment('order', -1);
                });
            }
        });

        static::updating(function ($banner) {
            if ($banner->isDirty('is_active')) {
                DB::transaction(function () use ($banner) {
                    if ($banner->is_active == false) {
                        $deactivatedOrder = $banner->order;

                        static::where('is_active', true)
                            ->where('order', '>', $deactivatedOrder)
                            ->increment('order', -1);

                        $banner->order = 0;
                    } else {
                        $maxOrder = static::where('is_active', true)->max('order') ?? 0;
                        $banner->order = $maxOrder + 1;
                    }
                });
            }
        });
    }

    /**
     * Validate if the given order is unique among active banners
     *
     * @param int $order
     * @param int|null $excludeId Exclude a specific banner ID from the check
     * @return bool
     */
    public static function validateOrder($order, $excludeId = null)
    {
        $query = static::where('order', $order)
            ->where('is_active', true);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return !$query->exists();
    }

    /**
     * Reorder all active banners sequentially
     *
     * @return void
     */
    public static function reorderAll()
    {
        DB::transaction(function () {
            $banners = static::where('is_active', true)
                ->orderBy('order')
                ->get();

            foreach ($banners as $index => $banner) {
                $banner->update(['order' => $index + 1]);
            }
        });
    }

    /**
     * Move banner to a specific position
     *
     * @param int $newOrder
     * @return bool
     */
    public function moveToPosition($newOrder)
    {
        if (!$this->is_active) {
            return false;
        }

        return DB::transaction(function () use ($newOrder) {
            $oldOrder = $this->order;

            if ($oldOrder === $newOrder) {
                return true;
            }

            if ($oldOrder < $newOrder) {
                static::where('is_active', true)
                    ->where('order', '>', $oldOrder)
                    ->where('order', '<=', $newOrder)
                    ->increment('order', -1);
            } else {
                static::where('is_active', true)
                    ->where('order', '>=', $newOrder)
                    ->where('order', '<', $oldOrder)
                    ->increment('order', 1);
            }

            $this->update(['order' => $newOrder]);
            return true;
        });
    }
}
