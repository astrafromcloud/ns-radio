<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Broadcaster extends Model
{
    /** @use HasFactory<\Database\Factories\BroadcasterFactory> */
    use HasFactory, HasTranslations;

    protected $guarded = false;

    public $translatable = ['bio'];

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }
}
