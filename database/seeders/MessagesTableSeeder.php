<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('it_IT'); // Utilizza la localizzazione italiana per nomi e frasi

        // Ciclo per 3000 appartamenti
        for ($apartmentId = 1; $apartmentId <= 3000; $apartmentId++) {
            // Ogni appartamento avrà tra 1 a 3 messaggi
            $messageCount = rand(1, 3);

            for ($i = 0; $i < $messageCount; $i++) {
                $newMessage = new Message();
                $newMessage->email_sender = $faker->unique()->safeEmail;
                $newMessage->apartment_id = $apartmentId;
                $newMessage->name_lastname = $faker->name;
                $newMessage->body = $faker->sentence($nbWords = 10, $variableNbWords = true);
                $newMessage->save();
            }
        }
    }
}