<?php

namespace App\Models\Golang\RadioService;

use Illuminate\Database\Eloquent\Model;

class ChartTrack extends Model
{
    protected $connection = "go-service-db";

    protected $fillable = ["track_chart_track"];

    public function track() {
        return $this->belongsTo(Track::class, "track_chart_track");
    }
}
