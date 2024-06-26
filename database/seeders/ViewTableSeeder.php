<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\View;
use Faker\Factory as Faker;

class ViewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); //.

        for($i = 0; $i < 10; $i++) {
            $newView = new View();
            $newView->apartment_id= $faker->numberBetween(1,10);
            $newView->ip_address = $faker->ipv4;
            $newView->date_time = $faker->dateTime;
            $newView->save();
        }
    }
}
