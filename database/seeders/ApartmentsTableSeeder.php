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
            "Bellissimo Duplex con Patio Privato",
            "Appartamento Spazioso in Zona Residenziale",
            "Monolocale Arredato con Cura",
            "Casa Moderna con Ampio Soggiorno",
            "Loft di Design in Centro Storico",
            "Elegante Bilocale con Parcheggio",
            "Condominio con Palestra e Piscina",
            "Attico con Terrazza Panoramica",
            "Appartamento con Vista Mare",
            "Bilocale Vicino alla Stazione",
            "Monolocale con Cucina Attrezzata",
            "Trilocale con Giardino Privato",
            "Appartamento con Garage",
            "Casa con Cortile Interno",
            "Loft Industrial in Zona Artistica",
            "Bilocale in Quartiere Tranquillo",
            "Monolocale con Wi-Fi Incluso",
            "Appartamento con Caminetto",
            "Casa con Ampia Cantina",
            "Loft con Finestre Panoramiche",
            "Bilocale con Balcone Privato"
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
            "https://www.avantgardeconstruct.it/wp-content/uploads/2019/06/Gallery-case-prefabbricate-in-legno.jpg",
            "https://www.lidimare.com/images/00950/venditacaselidiferraresi_large.jpeg",
            "https://i.pinimg.com/736x/b9/1a/ca/b91aca7ab95315233e1b7c1582259cbd.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRM6RX5ZtgPzfmptwrGQ4jwLdGTjUdOOwa21A&s",
            "https://i.pinimg.com/736x/20/fe/9c/20fe9ca091423be52c1cdbe191695f1d.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSOqlW6KIBJ2Cn_op6Kbh2cEKWg-Qow5pwXA&s",
            "https://www.viaggi-usa.it/wp-content/uploads/2016/12/copertina-opt-1.jpg",
            "https://hips.hearstapps.com/hmg-prod/images/ej-central-park-tower-brooke-goldberg-salon-blanco-1624135435.jpg",
            "https://a3.cdn.japantravel.com/photo/59506-200798/738x553.5!/japanese-homes-200798.jpg"
        ];
        
        $descriptions = [
            "Spazioso appartamento situato in una zona centrale, comodo per spostamenti e servizi.",
            "Monolocale accogliente perfetto per giovani coppie o studenti.",
            "Casa ampia e luminosa, ideale per famiglie numerose.",
            "Loft moderno con dettagli di design e finiture di pregio.",
            "Condominio elegante in un quartiere storico e tranquillo.",
            "Attico lussuoso con vista mozzafiato sul panorama cittadino.",
            "Appartamento luminoso con accesso diretto a spazi verdi.",
            "Alloggio trendy in una zona ricca di vita e attrazioni.",
            "Rifugio tranquillo per chi cerca pace e relax.",
            "Duplex con patio per piacevoli serate all'aperto.",
            "Appartamento spazioso ideale per una vita comoda e rilassata.",
            "Monolocale arredato con cura e attenzione ai dettagli.",
            "Casa moderna con ampio soggiorno per una vita confortevole.",
            "Loft di design in una posizione centrale e ben collegata.",
            "Bilocale elegante con parcheggio riservato.",
            "Condominio con servizi esclusivi per i residenti.",
            "Attico con terrazza per momenti di relax e divertimento.",
            "Appartamento con vista mare per vacanze indimenticabili.",
            "Bilocale comodo e funzionale vicino ai mezzi di trasporto.",
            "Monolocale con cucina attrezzata e spazi ben organizzati.",
            "Trilocale con giardino privato per una vita serena.",
            "Appartamento con garage per una maggiore comodità.",
            "Casa con cortile interno per momenti di tranquillità.",
            "Loft industrial in una zona artistica e vibrante.",
            "Bilocale in un quartiere tranquillo e sicuro.",
            "Monolocale con connessione internet inclusa.",
            "Appartamento con camino per serate accoglienti.",
            "Casa con ampia cantina per maggiori spazi di archiviazione.",
            "Loft con grandi finestre panoramiche.",
            "Bilocale con balcone privato per godersi l'aria aperta."
        ];

        for ($i = 0; $i < 4000; $i++) {
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
