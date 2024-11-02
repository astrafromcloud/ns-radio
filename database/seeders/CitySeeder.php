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
            ['name' => 'Актау', 'frequency' => '106.2 FM'],
            ['name' => 'Караганда', 'frequency' => '105.6 FM'],
            ['name' => 'Актобе', 'frequency' => '103.8 FM'],
            ['name' => 'Кокшетау', 'frequency' => '105.7 FM'],
            ['name' => 'Алма-Ата', 'frequency' => '106.0 FM'],
            ['name' => 'Костанай', 'frequency' => '107.0 FM'],
            ['name' => 'Астана', 'frequency' => '105.9 FM'],
            ['name' => 'Кызылорда', 'frequency' => '107.7 FM'],
            ['name' => 'Атырау', 'frequency' => '104.4 FM'],
            ['name' => 'Павлодар', 'frequency' => '104.6 FM'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
