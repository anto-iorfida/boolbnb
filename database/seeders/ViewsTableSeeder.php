<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\View;
use Faker\Factory as Faker;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            View::create([
                'apartment_id' => $faker->numberBetween(1, 10),
                'ip_address' => $faker->ipv4,
                'date_time' => $faker->dateTime,
            ]);
        }
    }
}
