<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory, HasTranslations;

    protected $guarded = false;

    protected $casts = [
        'name' => 'array',
    ];

    public $translatable = ['name'];
}
