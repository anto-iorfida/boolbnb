<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Apartments_ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [1, 2, 3, 4, 5, 6],
            [7, 8, 9, 10, 11, 12],
            [1, 3, 5, 7, 9, 11],
            [2, 4, 6, 8, 10, 12],
            [1, 2, 4, 6, 9, 12],
            [3, 5, 7, 8, 10, 11],
            [1, 4, 6, 7, 10, 12],
            [2, 3, 5, 8, 9, 11],
            [1, 2, 5, 7, 8, 12],
            [3, 4, 6, 9, 10, 11],
        ];

        $apartments = [
            [1, 1, 1, 1, 1, 1],
            [2, 2, 2, 2, 2, 2],
            [3, 3, 3, 3, 3, 3],
            [4, 4, 4, 4, 4, 4],
            [5, 5, 5, 5, 5, 5],
            [6, 6, 6, 6, 6, 6],
            [7, 7, 7, 7, 7, 7],
            [8, 8, 8, 8, 8, 8],
            [9, 9, 9, 9, 9, 9],
            [10, 10, 10, 10, 10, 10],
        ];

        // 10
        foreach ($apartments as $index => $apartment) {
        //    10 * 6 
            foreach ($services[$index] as $serviceId) {
                DB::table('apartments_services')->insert([
                    'id_apartment' => $apartment[0], 
                    'id_service' => $serviceId,
                ]);
            }
        }
    }
}
