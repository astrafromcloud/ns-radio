<?php

namespace Database\Seeders;

use App\Models\Broadcaster;
use App\Models\BroadcasterProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BroadcasterProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $broadcaster = Broadcaster::find(1);
        $broadcaster->programs()->attach([1, 2]);
        $broadcaster2 = Broadcaster::find(1);
        $broadcaster2->programs()->attach([2, 3]);
//        BroadcasterProgram::find(1);
    }
}
