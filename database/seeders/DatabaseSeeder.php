<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ApartmentsTableSeeder;
use Database\Seeders\ServicesTableSeeder;
use Database\Seeders\MessagesTableSeeder;
use Database\Seeders\AlbumsTableSeeder;
use Database\Seeders\Apartments_ServicesTableSeeder;
use Database\Seeders\SponsorsTableSeederTableSeeder;
use Database\Seeders\ViewTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\View\ViewServiceProvider;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UsersTableSeeder::class,
            ApartmentsTableSeeder::class,
            ServicesTableSeeder::class,
            MessagesTableSeeder::class,
            // ViewsTableSeeder::class,
            SponsorsTableSeeder::class,
            AlbumsTableSeeder::class,
            Apartments_ServicesTableSeeder::class

        ]);
    }
}
