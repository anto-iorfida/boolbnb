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
        //
        $nameServices = [
            "Wi-Fi gratuito",
            "Aria condizionata",
            "Calefazione",
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

           foreach($nameServices as $singleService){
               $newService= new Service();
               $newService->name=$singleService;
               $newService->icon=$singleService;
               $newService->save();
           }

    }
}
