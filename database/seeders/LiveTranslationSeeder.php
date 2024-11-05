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
            'video_url' => '<iframe src="https://vk.com/video_ext.php?oid=-21723674&id=456239074&hd=1" allow="autoplay; encrypted-media; fullscreen; picture-in-picture; screen-wake-lock;" allowFullScreen></iframe>'
        ];

        LiveTranslation::create($liveTranslations);
    }
}
