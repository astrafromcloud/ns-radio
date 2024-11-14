<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class Song extends Model
{
    /** @use HasFactory<\Database\Factories\SongFactory> */
    use HasFactory;

    protected $guarded = false;

    public function getRows()
    {
        $songs = Http::get('http://service.ns-radio.init.kz/bc/top-chart')->json();

        $songs = Arr::map($songs, function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'author_name' => $item['author'],
                'image' => $item['image'] ?? null,
                'likes' => $item['likes_count'],
                'has_in_chart' => $item['has_in_chart'],
                'created_at' => $item['created_at'],
                'latest_history_id' => $item['history'][0]['id'] ?? null,
                'latest_history_created_at' => $item['history'][0]['created_at'] ?? null,
            ];
        });

        return $songs;
    }

}
