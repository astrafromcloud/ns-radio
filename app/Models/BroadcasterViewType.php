<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BroadcasterViewType extends Model
{
    protected $guarded = false;

    public function broadcasters() {
        return $this->hasMany(Broadcaster::class);
    }
}
