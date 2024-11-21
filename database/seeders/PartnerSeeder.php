<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'type' => "Координатор представительства города Алматы",
                'name' => "Сергей Ребров",
                'email' => "rebrov@gmail.com",
                'phone' => "87002561221",
            ],
            [
                'type' => "Координатор региональных представительств",
                'name' => "Сергей Ребров",
                'email' => "rebrov@gmail.com",
                'phone' => "87002561221",
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
