<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Broadcaster extends Model
{
    /** @use HasFactory<\Database\Factories\BroadcasterFactory> */
    use HasFactory, HasTranslations;

    protected $guarded = false;

    public $translatable = ['bio'];

    protected $casts = [
        'bio' => 'array'
    ];

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'broadcaster_program')
            ->withTimestamps();
    }

    public function getBioAttribute($value)
    {
        return $value ? $value : '';
    }

    public function broadcasterViewType()
    {
        return $this->belongsTo(BroadcasterViewType::class);
    }
}
