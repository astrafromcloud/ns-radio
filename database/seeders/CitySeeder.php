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
            ['name' => 'Aqtau', 'frequency' => '106.2 FM'],
            ['name' => 'Karaganda', 'frequency' => '105.6 FM'],
            ['name' => 'Aktobe', 'frequency' => '103.8 FM'],
            ['name' => 'Kokshetau', 'frequency' => '105.7 FM'],
            ['name' => 'Almaty', 'frequency' => '106.0 FM'],
            ['name' => 'Qostanai', 'frequency' => '107.0 FM'],
            ['name' => 'Astana', 'frequency' => '105.9 FM'],
            ['name' => 'Qyzylorda', 'frequency' => '107.7 FM'],
            ['name' => 'Atyrau', 'frequency' => '104.4 FM'],
            ['name' => 'Pavlodar', 'frequency' => '104.6 FM'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
