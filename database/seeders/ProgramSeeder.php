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
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => 11, 'to' => 12, 'image' => 'programs/program1.webp'],
            ['name' => 'Шоу Мода',  'from' => 12, 'to' => 13, 'image' => 'programs/program2.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => 13, 'to' => 14, 'image' => 'programs/program3.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => 15, 'to' => 16, 'image' => 'programs/program4.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => 17, 'to' => 18, 'image' => 'programs/program5.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => 19, 'to' => 20, 'image' => 'programs/program6.webp'],
            ['name' => 'Утреннее шоу «Твоё утро!»',  'from' => 21, 'to' => 22, 'image' => 'programs/program7.webp'],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}
