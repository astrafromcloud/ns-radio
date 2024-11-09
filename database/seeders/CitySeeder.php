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
            ['name' => ['ru' => 'Актау', 'kk' => 'Ақтау', 'en' => 'Aqtau'], 'frequency' => '106.2 FM'],
            ['name' => ['ru' => 'Караганда', 'kk' => 'Қарағанды', 'en' => 'Qaragandy'], 'frequency' => '105.6 FM'],
            ['name' => ['ru' => 'Актобе', 'kk' => 'Ақтөбе', 'en' => 'Aqtobe'], 'frequency' => '103.8 FM'],
            ['name' => ['ru' => 'Кокшетау', 'kk' => 'Көкшетау', 'en' => 'Kokshetau'], 'frequency' => '105.7 FM'],
            ['name' => ['ru' => 'Алматы', 'kk' => 'Алматы', 'en' => 'Almaty'], 'frequency' => '106.0 FM'],
            ['name' => ['ru' => 'Костанай', 'kk' => 'Қостанай', 'en' => 'Qostanay'], 'frequency' => '107.0 FM'],
            ['name' => ['ru' => 'Астана', 'kk' => 'Астана', 'en' => 'Astana'], 'frequency' => '105.9 FM'],
            ['name' => ['ru' => 'Кызылорда', 'kk' => 'Қызылорда', 'en' => 'Qyzylorda'], 'frequency' => '107.7 FM'],
            ['name' => ['ru' => 'Атырау', 'kk' => 'Атырау', 'en' => 'Atyrau'], 'frequency' => '104.4 FM'],
            ['name' => ['ru' => 'Павлодар', 'kk' => 'Павлодар', 'en' => 'Pavlodar'], 'frequency' => '104.6 FM'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
