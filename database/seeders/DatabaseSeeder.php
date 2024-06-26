<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;
use App\Models\View;
use App\Models\User;
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
            ViewTableSeeder::class,


        ]);
    }
}
