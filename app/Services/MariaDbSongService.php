<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class MariaDbSongService
{
    public function getTopSongs(int $limit = 10)
    {
        // Assuming a `songs` table in MariaDB with the required fields
        return DB::connection('mariadb')->table('songs')
            ->orderBy('likes', 'desc')
            ->limit($limit)
            ->get();
    }
}
