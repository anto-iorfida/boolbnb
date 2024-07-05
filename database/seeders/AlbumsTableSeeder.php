<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Generator as Faker;
class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //

         $albums = [
    
                'https://lacasamoderna.com/wp-content/uploads/2023/04/04_LCM_SLIDER_HB_2000x1333-min.jpg',
                'https://lacasamoderna.com/wp-content/uploads/2023/06/la-casa-moderna-verde-protagonista-arredo-divano-madia-02.jpg',
                'https://st2.depositphotos.com/1041088/11595/i/450/depositphotos_115954550-stock-photo-home-exterior-with-garage-and.jpg',
                'https://st3.depositphotos.com/1041088/35593/i/450/depositphotos_355930350-stock-photo-cedar-brown-mountain-home-great.jpg'
        ];

        $apartments = [
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [10],
        ];

        // 10
        foreach ($apartments as $index => $apartment) {
        //    10 * 6 
            foreach ($albums as $singleAlbums) {
                DB::table('albums')->insert([
                    'apartment_id' => $apartment[0], 
                    'image' => $singleAlbums,
                ]);
            }
        }
    }
}
