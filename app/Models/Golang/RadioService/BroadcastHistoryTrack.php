<?php

namespace App\Models\Golang\RadioService;

use Illuminate\Database\Eloquent\Model;

class BroadcastHistoryTrack extends Model
{
    protected $connection = "go-service-db";

    public function broadcast() {
        return $this->belongsTo(Broadcast::class, "broadcast_history");
    }

    public function track() {
        return $this->belongsTo(Track::class, "track_history");
    }
}
