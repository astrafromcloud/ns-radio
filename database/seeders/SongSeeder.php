<?php

namespace Database\Seeders;

// database/seeders/SongsTableSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Song;

class SongSeeder extends Seeder
{
    public function run()
    {
        $songs = [
            ['title' => 'All of the Lights', 'artist' => 'Kanye West', 'rank' => 1, 'image_url' => 'songs/allofthelights.png', 'likes' => 100],
            ['title' => 'Don\'t Stop the Music', 'artist' => 'Rihanna', 'rank' => 2, 'image_url' => 'songs/dontstopthemusic.png', 'likes' => 120],
            ['title' => 'In Da Club', 'artist' => '50 Cent', 'rank' => 3, 'image_url' => 'songs/indaclub.png', 'likes' => 200],
            ['title' => 'Iron', 'artist' => 'Woodkid', 'rank' => 4, 'image_url' => 'songs/iron.png', 'likes' => 130],
            ['title' => 'We Will Rock You', 'artist' => 'Queen', 'rank' => 5, 'image_url' => 'songs/queen.png', 'likes' => 300],
            ['title' => 'Rude Boy', 'artist' => 'Rihanna', 'rank' => 6, 'image_url' => 'songs/rihanna.png', 'likes' => 150],
            ['title' => 'Enter Sandman', 'artist' => 'Metallica', 'rank' => 7, 'image_url' => 'songs/sandman.png', 'likes' => 180],
            ['title' => 'See You Again', 'artist' => 'Wiz Khalifa', 'rank' => 8, 'image_url' => 'songs/seeyouagain.png', 'likes' => 220],
            ['title' => 'Waka Waka', 'artist' => 'Shakira', 'rank' => 9, 'image_url' => 'songs/shakira.png', 'likes' => 250],
            ['title' => 'Sicko Mode', 'artist' => 'Travis Scott', 'rank' => 10, 'image_url' => 'songs/travis.png', 'likes' => 400],
        ];

        foreach ($songs as $song) {
            Song::create($song);
        }
    }
}
