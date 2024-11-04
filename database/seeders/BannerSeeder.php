<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        // Example data extracted from your HTML
        $banners = [
            [
                'image_url' => 'banners/1.png',
//                'video_url' => '/assets/banner/video1.mp4',
                'description' => 'This is the first banner description.',
            ],
            [
//                'image_url' => '/assets/banner/banner2.png',
                'video_url' => 'banners/video1.mp4',
                'description' => 'This is the second banner description.',
            ],
            [
//                'image_url' => '/assets/banner/banner2.png',
                'video_url' => 'banner/video2.mp4',
                'description' => 'This is the third banner description.',
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
