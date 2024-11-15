<?php

namespace App\Models\Golang\RadioService;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $connection = "go-service-db";

    public $timestamps = false;
    protected $fillable = ["name", "sanitized_name"];

    public function tracks()
    {
        return $this->hasMany(Track::class, "author_tracks");
    }

    protected static function booted()
    {
        static::deleting(function (Author $author) {
            $authorTrackIds = $author->tracks()->pluck('id');

            BroadcastHistoryTrack::whereIn("track_history", $authorTrackIds)->delete();

            $author->tracks()->with("image")->get()->each(fn($tr) => $tr->delete());
        });
    }
}
