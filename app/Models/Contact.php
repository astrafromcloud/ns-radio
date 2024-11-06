<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory, HasTranslations;

    protected $guarded = false;

    protected $casts = [
        'phones' => 'array',
        'description' => 'array',
        'address' => 'array',
    ];
    public $translatable = ['description', 'address'];
}
