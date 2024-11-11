<?php

namespace Database\Seeders;

use App\Models\BroadcasterViewType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BroadcasterViewTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BroadcasterViewType::create([
            'type' => '0'
        ]);
    }
}
