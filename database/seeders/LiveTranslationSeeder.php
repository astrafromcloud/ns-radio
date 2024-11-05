<?php

namespace Database\Seeders;

use App\Models\LiveTranslation;
use Illuminate\Database\Seeder;

class LiveTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $liveTranslations = [
            'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239124&hd=2&autoplay=1" width="853" height="480" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" frameborder="0" allowfullscreen></iframe>'
        ];

        LiveTranslation::create($liveTranslations);
    }
}
