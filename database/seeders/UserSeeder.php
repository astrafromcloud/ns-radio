<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $userAdmin = User::factory()->create([
            'name' => 'Admin',
            'last_name' => 'Admin',
            'password' => 'qwerty123',
            'phone' => '877777777777',
            'email' => 'admin@gmail.com',
        ]);

        $userAdmin->assignRole('admin');
    }
}
