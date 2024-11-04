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
            ['name' => ['ru' => 'Актау', 'kaz' => 'Ақтау'], 'frequency' => '106.2 FM'],
            ['name' => ['ru' => 'Караганда', 'kaz' => 'Қарағанды'], 'frequency' => '105.6 FM'],
            ['name' => ['ru' => 'Актобе', 'kaz' => 'Ақтөбе'], 'frequency' => '103.8 FM'],
            ['name' => ['ru' => 'Кокшетау', 'kaz' => 'Көкшетау'], 'frequency' => '105.7 FM'],
            ['name' => ['ru' => 'Алматы', 'kaz' => 'Алматы'], 'frequency' => '106.0 FM'],
            ['name' => ['ru' => 'Костанай', 'kaz' => 'Қостанай'], 'frequency' => '107.0 FM'],
            ['name' => ['ru' => 'Астана', 'kaz' => 'Астана'], 'frequency' => '105.9 FM'],
            ['name' => ['ru' => 'Кызылорда', 'kaz' => 'Қызылорда'], 'frequency' => '107.7 FM'],
            ['name' => ['ru' => 'Атырау', 'kaz' => 'Атырау'], 'frequency' => '104.4 FM'],
            ['name' => ['ru' => 'Павлодар', 'kaz' => 'Павлодар'], 'frequency' => '104.6 FM'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
