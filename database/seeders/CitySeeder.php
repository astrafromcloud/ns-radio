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
            ['name' => ['ru' => 'Актау', 'kk' => 'Ақтау'], 'frequency' => '106.2 FM'],
            ['name' => ['ru' => 'Караганда', 'kk' => 'Қарағанды'], 'frequency' => '105.6 FM'],
            ['name' => ['ru' => 'Актобе', 'kk' => 'Ақтөбе'], 'frequency' => '103.8 FM'],
            ['name' => ['ru' => 'Кокшетау', 'kk' => 'Көкшетау'], 'frequency' => '105.7 FM'],
            ['name' => ['ru' => 'Алматы', 'kk' => 'Алматы'], 'frequency' => '106.0 FM'],
            ['name' => ['ru' => 'Костанай', 'kk' => 'Қостанай'], 'frequency' => '107.0 FM'],
            ['name' => ['ru' => 'Астана', 'kk' => 'Астана'], 'frequency' => '105.9 FM'],
            ['name' => ['ru' => 'Кызылорда', 'kk' => 'Қызылорда'], 'frequency' => '107.7 FM'],
            ['name' => ['ru' => 'Атырау', 'kk' => 'Атырау'], 'frequency' => '104.4 FM'],
            ['name' => ['ru' => 'Павлодар', 'kk' => 'Павлодар'], 'frequency' => '104.6 FM'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
