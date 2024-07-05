<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      

        $iconServices = [
                'fa-solid fa-wifi',
                'fi fi-rs-snowflakes',
                ' fi fi-rs-croissant',
                'fi fi-rs-screen',
                ' fa-solid fa-kitchen-set',
                'fi fi-rs-washer',
                ' fi fi-rs-dryer-alt',
                'fi fi-rs-parking-circle',
                'fi fi-rs-swimmer',
                ' fi fi-rs-gym',
                ' fi fi-rs-house-tsunami',
                ' fi fi-rs-user',
                ' fi fi-rs-paw-heart'
        ];
        
        $nameServices = [
             "Wi-Fi",
            "Aria condizionata",
            "Colazione",
            "TV a schermo piatto",
            "Cucina attrezzata",
            "Lavatrice",
            "Asciugatrice",
            "Posto auto",
            "Piscina",
            "Palestra",
            "Vista sul mare",
            "Portiere",
            "Animali domestici ammessi"
        ];
        
        foreach (array_keys($nameServices) as $index) {
            $newService = new Service();
            $newService->icon = $iconServices[$index];
            $newService->name = $nameServices[$index];
            $newService->save();
        }
    }
}
