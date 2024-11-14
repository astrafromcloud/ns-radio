<?php

namespace App\Models\Golang\RadioService;

use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $connection = "go-service-db";

    public $timestamps = false;
    protected $fillable = ["slug"];

    public function tracksHistory() {
        return $this->belongsToMany(Track::class, BroadcastHistoryTrack::class, "broadcast_history", "track_history");
    }
}
