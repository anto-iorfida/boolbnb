<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('it_IT'); 

        for ($i = 0; $i < 900; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), 
                'date_birth' => $faker->date($format = 'Y-m-d',$min = '1950-01-01' ,$max = '2003-01-01'), 
            ]);
        }
    }
}
