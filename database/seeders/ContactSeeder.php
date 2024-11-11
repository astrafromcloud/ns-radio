<?php

namespace Database\Seeders;

use App\Models\Contact;
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
        $contact = [
            'description' => [
                'ru' => 'Радиостанция NS Radio , 88.9 FM вышла в эфир с вещанием по городу Алматы в сентябре 2019 года. Это городская радиостанция, ориентированная на предоставление позитивной, полезной и актуальной информации о городе Алматы - его новостях и мероприятиях, достопримечательностях города и его окрестностей, туристических направлениях. Цель радио – популяризация города Алматы! Двухкиловатный передатчик RADIO NS обеспечивает уверенное покрытие сигналом территории всего города и окружающих его населенных пунктов.',
                'kk' => 'NS Radio 88,9 FM радиостанциясы 2019 жылдың қыркүйегінде Алматы қаласының барлық аумағында эфирге шықты. Бұл Алматы қаласы туралы жағымды, пайдалы және өзекті ақпаратты – оның жаңалықтары мен оқиғалары, қала мен оның маңындағы көрікті жерлер, туристік бағыттар туралы ақпарат беруге бағытталған қалалық радиостанция. Радионың мақсаты – Алматы қаласын танымал ету! Екі киловаттық RADIO NS таратқышы бүкіл қаланы және оның маңындағы елді мекендерді сенімді сигналмен қамтуды қамтамасыз етеді.'
            ],
            'phones' => ['+7-777-777-77-77', '+7-777-777-77-77', '+7-777-777-77-77'],
            'address' => [
                'ru' => 'г. Алматы, проспект Абая, 76/109, уг. ул. Ауэзова, 5 этаж',
                'kk' => 'Алматы қ., Абай даңғылы, 76/109, қиылыс. ст. Әуезова, 5 қабат'
            ],
            'email' => 'info@nsradio.kz',
            'instagram_url' => 'https://www.instagram.com/radio_ns/',
            'youtube_url' => 'https://www.youtube.com/@radions5722/videos',
            'whatsapp_url' => 'https://wa.me/77751060011',
            'telegram_url' => 'https://t.me/AlmatyRadioNS'
        ];

        Contact::create($contact);
    }
}
