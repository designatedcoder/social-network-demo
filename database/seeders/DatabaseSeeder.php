<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        \App\Models\User::factory(200)->hasProfile()->hasPosts(5)->create();
        \App\Models\Room::factory(5)->create();
    }
}
