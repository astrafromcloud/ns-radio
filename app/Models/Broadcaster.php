<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcaster extends Model
{
    /** @use HasFactory<\Database\Factories\BroadcasterFactory> */
    use HasFactory;

    protected $guarded = false;
}
