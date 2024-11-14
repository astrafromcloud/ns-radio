<?php

namespace App\Models\Golang\RadioService;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    protected $connection = "go-service-db";

    const UPDATED_AT = null;
    protected $fillable = ["user_id", "track_likes"];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function track() {
        return $this->belongsTo(Track::class, "track_likes");
    }

    public function newRelatedInstance($class)
    {
        if($class == User::class) {
            return new $class;
        }

        return parent::newRelatedInstance($class);
    }
}
