<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Apartaments_SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $apartments = range(1, 16);

        foreach ($apartments as $apartment_id) {
            // Genera una data start_time casuale negli ultimi 10 giorni
            $start_time = $faker->dateTimeBetween('-10 days', 'now');

            // Genera una data end_time casuale nei prossimi 10 giorni a partire da oggi
            $end_time = $faker->dateTimeBetween('now', '+10 days');

            DB::table('apartments_sponsors')->insert([
                'id_apartment' => $apartment_id, 
                'id_sponsor' => rand(1, 3), 
                'start_time' => $start_time, 
                'end_time' => $end_time,
            ]);
        }
    }
}
