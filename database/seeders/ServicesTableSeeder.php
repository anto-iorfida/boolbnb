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
        // $nameServices = [
        //     "Wi-Fi",
        //     "Aria condizionata",
        //     "Colazione",
        //     "TV a schermo piatto",
        //     "Cucina attrezzata",
        //     "Lavatrice",
        //     "Asciugatrice",
        //     "Posto auto",
        //     "Piscina",
        //     "Palestra",
        //     "Vista sul mare",
        //     "Portiere",
        //     "Animali domestici ammessi"
        // ];
        // $iconServices=[
        //     '<i class="fa-solid fa-wifi"></i>',
        //     '<i class="fi fi-rs-snowflakes"></i>',
        //     ' <i class="fi fi-rs-croissant"></i>',
        //     '<i class="fi fi-rs-screen"></i>',
        //     ' <i class="fa-solid fa-kitchen-set"></i>',
        //     '<i class="fi fi-rs-washer"></i>',
        //     ' <i class="fi fi-rs-dryer-alt"></i>',
        //     '<i class="fi fi-rs-parking-circle"></i>',
        //     '<i class="fi fi-rs-swimmer"></i>',
        //     ' <i class="fi fi-rs-gym"></i>',
        //     ' <i class="fi fi-rs-house-tsunami"></i>',
        //     ' <i class="fi fi-rs-user"></i>',
        //     ' <i class="fi fi-rs-paw-heart"></i>'
        // ]; 
        
        // foreach ($iconServices as $singleIconService) {
        //     $newService = new Service();
        //     $newService->icon =$singleIconService;
        //     $newService->save();
        // }

        // foreach ($nameServices as $singleService) {
        //     $newService = new Service();
        //     $newService->name = $singleService;
        //     $newService->save();
        // }



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
