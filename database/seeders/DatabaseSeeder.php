<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Rome',
            'last_name' => 'Test User',
            'password' => 'qwerty123',
            'phone' => '77777777',
            'email' => 'rome@gmail.com',
        ]);

        $this->call([
            BroadcasterSeeder::class,
            SongSeeder::class,
            CitySeeder::class,
        ]);
    }
}
