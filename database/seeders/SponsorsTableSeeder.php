<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    public function run()
    {
        $sponsors = [
            ['name' => 'Platinum', 'price' => 9.99, 'duration' => 144],
            ['name' => 'Gold', 'price' => 5.99, 'duration' => 72],
            ['name' => 'Silver', 'price' => 2.99, 'duration' => 24],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create($sponsor);
        }
    }
}
