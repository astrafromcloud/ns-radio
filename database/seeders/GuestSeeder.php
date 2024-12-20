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
                'program_id' => 1,
                'views' => 625,
                'image_url' => 'guests/program1.webp',
                'hashtag' => '#RadioNS',
                'video_type' => 'vk',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=2&autoplay=1" width="853" height="480" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Алена Малышева',
                'program_id' => 1,
                'views' => 625,
                'image_url' => 'guests/program2.webp',
                'hashtag' => '#RadioNS',
                'video_type' => 'youtube',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=2&autoplay=1" width="853" height="480" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program_id' => 1,
                'views' => 625,
                'image_url' => 'guests/program3.webp',
                'hashtag' => '#RadioNS',
                'video_type' => 'vk',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=2&autoplay=1" width="853" height="480" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program_id' => 1,
                'views' => 625,
                'image_url' => 'guests/program4.webp',
                'hashtag' => '#RadioNS',
                'video_type' => 'youtube',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=2&autoplay=1" width="853" height="480" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>'
            ],
            [
                'name' => 'Павел Смелов',
                'program_id' => 1,
                'views' => 625,
                'image_url' => 'guests/program5.webp',
                'hashtag' => '#RadioNS',
                'video_type' => 'vk',
                'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=2&autoplay=1" width="853" height="480" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>'
            ],
        ];

        foreach ($guests as $guestData) {
            Guest::create($guestData);
        }
    }
}
