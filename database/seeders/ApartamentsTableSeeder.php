<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\Apartment;

class ApartamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('it_IT'); 

        $titles = [
            "Affascinante Appartamento in Centro",
            "Accogliente Monolocale vicino al Parco",
            "Ampia Casa per Famiglie in Periferia",
            "Moderno Loft con Vista sulla Città",
            "Elegante Condominio nel Quartiere Storico",
            "Attico di Lusso con Vista sul Fiume",
            "Luminoso Appartamento con Accesso al Giardino",
            "Appartamento alla Moda nel Quartiere Trendy",
            "Rifugio Tranquillo Vicino alle Spiagge",
            "Bellissimo Duplex con Patio Privato"
        ];

        for ($i = 0; $i < 10; $i++) {
            $title = $titles[$i];
            $apartament = Apartment::create([
                'id_user' => $faker->numberBetween(1, 6), 
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $faker->paragraph, 
                'number_rooms' => $faker->numberBetween(1, 5),
                'number_beds' => $faker->numberBetween(1, 5),
                'number_baths' => $faker->optional()->numberBetween(1, 3),
                'square_meters' => $faker->optional()->numberBetween(20, 200),
                'thumb' => $faker->imageUrl($width = 640, $height = 480, 'apartments'),
                'address' => $faker->address, 
                'longitude' => $faker->longitude,
                'latitude' => $faker->latitude,
                'price' => $faker->randomFloat(2, 50, 500),
                'visibility' => $faker->boolean,
            ]);
        }
    }
}
