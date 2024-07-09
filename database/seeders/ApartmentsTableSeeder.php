<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\Apartment;
use App\Models\User;

class ApartmentsTableSeeder extends Seeder
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

        $thumbs = [
            "https://www.ledrohouse.it/clientfiles/topslide/20230125105511_ledrohouse_c2560.jpg",
            "https://cdn.hometogo.net/medium/v1/700/68b/78d2d05b1028e87a3aa74b3107.jpg",
            "https://cdn.hometogo.net/large/v1/1cb/251/91577f0ce0d7216dd29396e568.jpg",
            "https://cdn.hometogo.net/large/e_v5/0b4/f09/a68898ba8eb39b7b795f549e03.jpg",
            "https://www.newyorkfacile.it/wp-content/uploads/appartamenti-new-york.jpg",
            "https://pic.le-cdn.com/thumbs/520x390/04/1/properties/Property-e79900000000055400015ec8cf50-89430503.jpg",
            "https://static2-viaggi.corriereobjects.it/wp-content/uploads/2015/11/HudsonFoto1.jpg?v=1446649105",
            "https://c8.alamy.com/compit/2g9pg6k/case-cittadine-di-new-york-con-fughe-di-ferro-colore-applicato-tonificante-stati-uniti-2g9pg6k.jpg",
            "https://media-assets.ad-italia.it/photos/61bb3f5262236c86545c1d22/16:9/w_2560%2Cc_limit/1.jpg",
            "https://www.newyorkfacile.it/wp-content/uploads/casa-friends-new-york.jpg",
        ];

        $descriptions = [
            "Ampio appartamento con 3 camere da letto e 2 bagni in zona centrale, perfetto per famiglie.",
            "Grazioso monolocale con vista sul mare, ideale per una coppia in cerca di relax.",
            "Elegante attico con terrazza panoramica, situato in un prestigioso quartiere.",
            "Moderno bilocale con giardino privato, perfetto per chi ama stare all'aria aperta.",
            "Confortevole appartamento con posto auto, situato in una zona ben servita.",
            "Luminoso trilocale con cantina e solaio, in una palazzina appena ristrutturata.",
            "Funzionale bilocale con cucina attrezzata, ideale per studenti o lavoratori fuori sede.",
            "Accogliente monolocale con balcone, situato in un condominio tranquillo.",
            "Spazioso appartamento con 4 camere da letto e 3 bagni, perfetto per gruppi di amici o famiglie numerose.",
            "Elegante duplex con finiture di pregio, situato in un edificio storico.",
        ];

        for ($i = 0; $i < 2000; $i++) {
            $title = $titles[$i % count($titles)];
            $description = $descriptions[$i % count($descriptions)];
            $thumb = $thumbs[$i % count($thumbs)];

            // Genera un identificatore univoco per lo slug
            $slug = Str::slug($title) . '-' . Str::random(5);

            // definisce i limiti di latitudine e longitudine per l'Italia
            $minLatitude = 36.0;
            $maxLatitude = 47.0;
            $minLongitude = 6.0;
            $maxLongitude = 18.0;

            // genera latitudine e longitudine all'interno dei limiti italiani
            $latitude = $faker->latitude($minLatitude, $maxLatitude);
            $longitude = $faker->longitude($minLongitude, $maxLongitude);

            Apartment::create([
                'id_user' => $faker->numberBetween(1, 900),
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'number_rooms' => $faker->numberBetween(1, 5),
                'number_beds' => $faker->numberBetween(1, 5),
                'number_baths' => $faker->optional()->numberBetween(1, 3),
                'square_meters' => $faker->optional()->numberBetween(20, 200),
                'thumb' => $thumb,
                'address' => $faker->address,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'visibility' => $faker->boolean,
            ]);
        }
    }
}
