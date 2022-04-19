<?php

namespace Database\Seeders;

use App\Models\Reservation;

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
        //  \App\Models\User::factory(10)->count(10)->create
         Reservation::factory(10)->count(10)->create();
    }
}

