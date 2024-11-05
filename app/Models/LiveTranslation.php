<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveTranslation extends Model
{
    /** @use HasFactory<\Database\Factories\LiveTranslationFactory> */
    use HasFactory;

    protected $guarded = false;
}
