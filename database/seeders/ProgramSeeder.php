<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => '11:00', 'to' => '12:00', 'image' => 'programs/program1.webp'],
            ['name' => 'Шоу Мода',  'from' => '12:00', 'to' => '13:00', 'image' => 'programs/program2.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => '13:00', 'to' => '14:00', 'image' => 'programs/program3.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => '15:00', 'to' => '16:00', 'image' => 'programs/program4.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => '17:00', 'to' => '18:00', 'image' => 'programs/program5.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => '19:00', 'to' => '20:00', 'image' => 'programs/program6.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => '21:00', 'to' => '22:00', 'image' => 'programs/program7.webp'],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
