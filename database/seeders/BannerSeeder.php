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
                'content' => 'banners/2.png',
                'order' => 1,
                'content_type' => 'image'
                //                'video_url' => '/assets/banner/video1.mp4',
            ],
            [
                //                'image_url' => '/assets/banner/banner2.png',
                'content' => 'banners/video1.mp4',
                'order' => 2,
                'content_type' => 'video'
            ],
            [
                //                'image_url' => '/assets/banner/banner2.png',
                'content' => 'banners/video2.mp4',
                'order' => 3,
                'content_type' => 'video'

            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
