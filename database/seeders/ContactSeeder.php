<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'description' => 'Радиостанция NS Radio , 88.9 FM вышла в эфир с вещанием по городу Алматы в сентябре 2019 года. Это городская радиостанция, ориентированная на предоставление позитивной, полезной и актуальной информации о городе Алматы - его новостях и мероприятиях, достопримечательностях города и его окрестностей, туристических направлениях. Цель радио – популяризация города Алматы! Двухкиловатный передатчик RADIO NS обеспечивает уверенное покрытие сигналом территории всего города и окружающих его населенных пунктов.',
            'phones' => json_encode([
                '+7 (727) 315-24-15',
                '+7 (701) 375-23-10',
                '+7 (777) 816-33-99',
            ]),
            'address' => 'г. Алматы, проспект Абая, 76/109, уг. ул. Ауэзова, 5 этаж',
            'email' => 'info@nsradio.kz',
            'instagram_url' => 'https://www.instagram.com/radio_ns/',
            'youtube_url' => 'https://www.youtube.com/@radions5722/videos',
            'whatsapp_url' => 'https://wa.me/77712345678',
            'telegram_url' => 'https://t.me/nsradio'

        ]);
    }
}
