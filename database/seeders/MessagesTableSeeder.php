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
    public function run(Faker $faker)
    {
        //
        for($i = 0; $i < 3 ; $i ++){
         $newMessage= new Message();
            $newMessage->email_sender='moliternitest@gmail.com';
            $newMessage->apartment_id=1;
            $newMessage->name_lastname='Casimiro Moliterni';
            $newMessage->body='Prova di test email , lorem ipsum !';
            $newMessage->save();

        }
    }
}
