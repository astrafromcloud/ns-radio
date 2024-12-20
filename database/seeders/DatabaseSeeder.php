<?php

namespace Database\Seeders;

use App\Models\BroadcasterViewType;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            BroadcasterSeeder::class,
            CitySeeder::class,
            ProgramSeeder::class,
            UserSeeder::class,
            BroadcasterProgramSeeder::class,
            GuestSeeder::class,
            ContactSeeder::class,
            BannerSeeder::class,
            LiveTranslationSeeder::class,
            LeadSeeder::class,
            BroadcasterViewTypeSeeder::class,
            PartnerSeeder::class
        ]);
    }
}
