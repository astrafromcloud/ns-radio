<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $cities = [
            [
                'name' => ['ru' => 'Актау', 'kk' => 'Ақтау', 'en' => 'Aktau'],
                'frequency' => '106.2 FM',
            ],
            [
                'name' => ['ru' => 'Караганда', 'kk' => 'Қарағанды', 'en' => 'Karaganda'],
                'frequency' => '105.6 FM',
            ],
            [
                'name' => ['ru' => 'Актобе', 'kk' => 'Ақтөбе', 'en' => 'Aktobe'],
                'frequency' => '103.8 FM',
            ],
            [
                'name' => ['ru' => 'Кокшетау', 'kk' => 'Көкшетау', 'en' => 'Kokshetau'],
                'frequency' => '105.7 FM',
            ],
            [
                'name' => ['ru' => 'Алматы', 'kk' => 'Алматы', 'en' => 'Almaty'],
                'frequency' => '106.0 FM',
            ],
            [
                'name' => ['ru' => 'Костанай', 'kk' => 'Қостанай', 'en' => 'Kostanay'],
                'frequency' => '107.0 FM',
            ],
            [
                'name' => ['ru' => 'Астана', 'kk' => 'Астана', 'en' => 'Astana'],
                'frequency' => '105.9 FM',
            ],
            [
                'name' => ['ru' => 'Кызылорда', 'kk' => 'Қызылорда', 'en' => 'Kyzylorda'],
                'frequency' => '107.7 FM',
            ],
            [
                'name' => ['ru' => 'Атырау', 'kk' => 'Атырау', 'en' => 'Atyrau'],
                'frequency' => '104.4 FM',
            ],
            [
                'name' => ['ru' => 'Павлодар', 'kk' => 'Павлодар', 'en' => 'Pavlodar'],
                'frequency' => '104.6 FM',
            ],
            [
                'name' => ['ru' => 'Усть-Каменогорск', 'kk' => 'Өскемен', 'en' => 'Ust-Kamenogorsk'],
                'frequency' => '107.0 FM',
            ],
            [
                'name' => ['ru' => 'Экибастуз', 'kk' => 'Екібастұз', 'en' => 'Ekibastuz'],
                'frequency' => '104.2 FM',
            ],
            [
                'name' => ['ru' => 'Кентау', 'kk' => 'Кентау', 'en' => 'Kentaу'],
                'frequency' => '101.6 FM',
            ],
            [
                'name' => ['ru' => 'Кульсары', 'kk' => 'Құлсары', 'en' => 'Qulsary'],
                'frequency' => '101.5 FM',
            ],
            [
                'name' => ['ru' => 'Петропавловск', 'kk' => 'Қызылжар', 'en' => 'Petropavl'],
                'frequency' => '101.6 FM',
            ],
            [
                'name' => ['ru' => 'Семей', 'kk' => 'Семей', 'en' => 'Semey'],
                'frequency' => '102.8 FM',
            ],
            [
                'name' => ['ru' => 'Жезказган', 'kk' => 'Жезқазған', 'en' => 'Dzhezkazgan'],
                'frequency' => '103.7 FM',
            ],
            [
                'name' => ['ru' => 'Аксай', 'kk' => 'Ақсай', 'en' => 'Aksay'],
                'frequency' => '105.0 FM',
            ],
            [
                'name' => ['ru' => 'Тараз', 'kk' => 'Тараз', 'en' => 'Taraz'],
                'frequency' => '103.9 FM',
            ],
            [
                'name' => ['ru' => 'Щучинск', 'kk' => 'Шу', 'en' => 'Shchūchīnsk'],
                'frequency' => '102.3 FM',
            ],
            [
                'name' => ['ru' => 'Талдыкорган', 'kk' => 'Талдықорган', 'en' => 'Taldykorgan'],
                'frequency' => '105.4 FM',
            ],
            [
                'name' => ['ru' => 'Рудный', 'kk' => 'Рудный', 'en' => 'Rudnyy'],
                'frequency' => '105.7 FM',
            ],
            [
                'name' => ['ru' => 'Лисаковск', 'kk' => 'Лисаковск', 'en' => 'Lisakovsk'],
                'frequency' => '104.6 FM',
            ],
            [
                'name' => ['ru' => 'Риддер', 'kk' => 'Риддер', 'en' => 'Ridder'],
                'frequency' => '103.1 FM',
            ],
            [
                'name' => ['ru' => 'Балхаш', 'kk' => 'Балқаш', 'en' => 'Balqash'],
                'frequency' => '102.6 FM',
            ],
            [
                'name' => ['ru' => 'Алтай', 'kk' => 'Алтай', 'en' => 'Altay'],
                'frequency' => '103.3 FM',
            ],
            [
                'name' => ['ru' => 'Уральск', 'kk' => 'Орал', 'en' => 'Oral'],
                'frequency' => '104.6 FM',
            ],
            [
                'name' => ['ru' => 'Шымкент', 'kk' => 'Шымкент', 'en' => 'Shymkent'],
                'frequency' => '105.9 FM',
            ],
        ];


        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
