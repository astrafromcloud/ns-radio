<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;

class GuestSeeder extends Seeder
{
    public function run()
    {
        $guests = [
            [
                'name' => 'Полина Гагарина',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'https://ns-radio.init.kz/_next/image?url=%2Fassets%2Fimg%2Fprogram%2Fprogram1.jpg&w=2048&q=75',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Алена Малышева',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'https://ns-radio.init.kz/_next/image?url=%2Fassets%2Fimg%2Fprogram%2Fprogram2.png&w=2048&q=75',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'https://ns-radio.init.kz/_next/image?url=%2Fassets%2Fimg%2Fprogram%2Fprogram3.jpeg&w=2048&q=75',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'https://ns-radio.init.kz/_next/image?url=%2Fassets%2Fimg%2Fprogram%2Fprogram4.jpg&w=2048&q=75',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'https://ns-radio.init.kz/_next/image?url=%2Fassets%2Fimg%2Fprogram%2Fprogram5.png&w=2048&q=75',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
        ];

        foreach ($guests as $guestData) {
            Guest::create($guestData);
        }
    }
}
