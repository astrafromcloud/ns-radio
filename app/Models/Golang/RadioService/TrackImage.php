<?php

namespace App\Models\Golang\RadioService;

use Illuminate\Database\Eloquent\Model;

class TrackImage extends Model
{
    protected $connection = "go-service-db";

    public $timestamps = false;
    protected $fillable = ["name", "track_image"];

    public function track()
    {
        return $this->belongsTo(Track::class, "track_image");
    }
}
