<?php

namespace Database\Seeders;

use App\Models\Broadcaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BroadcasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Broadcaster::factory()->count(100)->create();
    }
}
