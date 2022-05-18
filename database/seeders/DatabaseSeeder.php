<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            MembertypeSeeder::class,
            PaymenttypeSeeder::class,
            UserSeeder::class,
            UserTypeSeeder::class
        ]);



        // User::factory(50)->hasUserTypes(50)->create();
    }
}
