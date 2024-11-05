<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    protected $guarded = false;

    public function broadcasters(): BelongsToMany
    {
        return $this->belongsToMany(Broadcaster::class, 'broadcaster_program')
            ->withTimestamps();
    }
}
