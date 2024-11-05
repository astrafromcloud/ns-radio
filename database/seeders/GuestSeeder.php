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
                'image_url' => 'guests/program1.webp',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Алена Малышева',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'guests/program2.webp',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'guests/program3.webp',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'guests/program4.webp',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program' => 'Утреннее шоу «Твоё утро!»',
                'views' => 625,
                'image_url' => 'guests/program5.webp',
                'hashtag' => '#RadioNS',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
            ],
        ];

        foreach ($guests as $guestData) {
            Guest::create($guestData);
        }
    }
}
