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
            ['title' => 'All of the Lights', 'artist' => 'Kanye West', 'image_url' => 'songs/allofthelights.png', 'likes' => 100],
            ['title' => 'Don\'t Stop the Music', 'artist' => 'Rihanna', 'image_url' => 'songs/dontstopthemusic.png', 'likes' => 120],
            ['title' => 'In Da Club', 'artist' => '50 Cent', 'image_url' => 'songs/indaclub.png', 'likes' => 200],
            ['title' => 'Iron', 'artist' => 'Woodkid', 'image_url' => 'songs/iron.png', 'likes' => 130],
            ['title' => 'We Will Rock You', 'artist' => 'Queen', 'image_url' => 'songs/queen.png', 'likes' => 300],
            ['title' => 'Rude Boy', 'artist' => 'Rihanna', 'image_url' => 'songs/rihanna.png', 'likes' => 150],
            ['title' => 'Enter Sandman', 'artist' => 'Metallica', 'image_url' => 'songs/sandman.png', 'likes' => 180],
            ['title' => 'See You Again', 'artist' => 'Wiz Khalifa', 'image_url' => 'songs/seeyouagain.png', 'likes' => 220],
            ['title' => 'Waka Waka', 'artist' => 'Shakira', 'image_url' => 'songs/shakira.png', 'likes' => 250],
            ['title' => 'Sicko Mode', 'artist' => 'Travis Scott', 'image_url' => 'songs/travis.png', 'likes' => 400],
        ];

        foreach ($songs as $song) {
            Song::create($song);
        }
    }
}
