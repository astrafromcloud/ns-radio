<?php

namespace App\Models\Golang\RadioService;

use App\Models\User;
use App\Utils\StrUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Track extends Model
{
    protected $connection = "go-service-db";
    protected $fillable = ["name", "sanitized_name", "likes_count", "author_tracks"];

    public function author()
    {
        return $this->belongsTo(Author::class, "author_tracks");
    }

    public function broadcasts()
    {
        return $this->belongsToMany(Broadcast::class, BroadcastHistoryTrack::class, "track_history", "broadcast_history");
    }

    public function likes()
    {
        return $this->hasMany(UserLike::class, "track_likes");
    }

    public function likedUsers()
    {
        $userIds = $this->likes()->distinct("user_id")->pluck("user_id")->toArray();

        return User::query()->whereIn("id", $userIds);
    }

    public function getLikedUsersAttribute()
    {
        return $this->likedUsers()->get();
    }

    public function image()
    {
        return $this->hasOne(TrackImage::class, "track_image");
    }

    public function topChart()
    {
        return $this->hasOne(ChartTrack::class, "track_chart_track");
    }

    public function newRelatedInstance($class)
    {
        if ($class == User::class) {
            return tap(new $class, function ($instance) {
                $instance->setConnection(config("database.default"));
            });
        }

        return parent::newRelatedInstance($class);
    }

    protected static function booted()
    {
        static::saving(function ($track) {
            $track->sanitized_name = StrUtils::sanitize($track->name);
        });

        static::deleting(function (Track $track) {
            if ($track->image) {
                if (is_string($track->image?->name) && Str::startsWith($track->image->name, "laravel://")) {
                    $path = Str::substr($track->image->name, Str::length("laravel://"));

                    $disks = ['local', 'public'];

                    // Check each disk if the file exists and delete it
                    foreach ($disks as $diskName) {
                        // If the disk has the file, delete it
                        if (Storage::disk($diskName)->exists($path)) {
                            Storage::disk($diskName)->delete($path);
                        }
                    }
                }

                $track->image->delete(); // Delete the related image
            }

            ChartTrack::where("track_chart_track", $track->id)->delete();
            BroadcastHistoryTrack::where("track_history", $track->id)->delete();
        });
    }
}
