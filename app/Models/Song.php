<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Sushi\Sushi;

class Song extends Model
{
    /** @use HasFactory<\Database\Factories\SongFactory> */
    use HasFactory, Sushi;

    protected $guarded = false;

    public function getRows()
    {

        $songs = Http::get('http://localhost:8001/bc/tracks')->json();

        $songs = Arr::map($songs, function ($item) {
            Log::info($item); // Log each item individually for inspection
            return [
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
