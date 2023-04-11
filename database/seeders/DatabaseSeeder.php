<?php

use Illuminate\Database\Seeder;
use  Database\Seeders\DaySeeder;
use  Database\Seeders\SymptomSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(SymptomSeeder::class);
    }
}
